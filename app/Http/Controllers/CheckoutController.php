<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Services\Cart\CartResponse;
use Illuminate\Support\Facades\Validator;
use App\Support\DataProviders\StatesProvider;
use App\Http\Requests\Customer\CustomerRequest;

/**
 * Class CheckoutController
 *
 * @package App\Http\Controllers
 */
class CheckoutController extends Controller
{

    /**
     * @var CartResponse
     */
    protected $cartItem;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var array[]
     */
    protected $res;

    /**
     * @var
     */
    protected $newAddon;

    /**
     * CheckoutController constructor.
     *
     * @param CartResponse $cartResponse
     */
    public function __construct(CartResponse $cartResponse)
    {
        $this->middleware('check.sessions')->except('index');
        $this->middleware('check.plans');

        $this->cartItem = $cartResponse;
        $this->data = ['api_key' => env('API_KEY')];
        $this->res = [
            'subscription_id'               => [],
            'same_subscription_id'          => [],
            'subscription_addon_id'         => [],
            'new_subscription_addon_id'     => [],
            'customer_standalone_device_id' => [],
            'customer_standalone_sim_id'    => [],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->processCoupons();
        $response = $this->getCartOrder($request);
        $states = StatesProvider::data();
        $this->logInCustomer($request->verification_hash);

        if ($response != '') {
            return $this->failRedirect('devices', $response);
        }

        $subtotalPrice = $this->cartItem->totalPrice();
        $activeGroupId = $this->cartItem->getActiveGroupId();
        $customerCards = $this->customerCardsApi();

        return view('checkout.index', compact('subtotalPrice', 'activeGroupId', 'states', 'customerCards'));
    }

    /**
     * @param $verificationHash
     */
    protected function logInCustomer($verificationHash)
    {
        if (session('id')) {
            $customer = $this->requestConnectionForCustomer('customer', 'get');
            session('cart')['business_verification'] = $customer->toArray();
        }else if(isset(session('cart')['customer']['id']) && $verificationHash){
            session(['id' => session('cart')['customer']['id']]);
            session(['account_suspended' => session('cart')['customer']["account_suspended"]]);
            session(['customer_hash' => session('cart')['customer']['hash']]);
            session(['paid_monthly_invoice' => "0"]);
            session(['new_customer' => 1]);
            $customer = $this->requestConnectionForCustomer('customer', 'get');
            session('cart')['business_verification'] = $customer->toArray();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->customer_card == 'customer_card' || !$request->customer_card){

            $validation = $this->validator($request);

            if ($validation->fails()) {
                return redirect()->back()->with(['notification' => [
                    'status'  => 'danger',
                    'message' => 'Please complete all the fields',
                ]
                ]);
            } else {
                session()->forget(['new_customer']);
            }
        }
        $order = $this->requestConnection('order?order_hash='.session('hash')['order_hash'].'&paid_monthly_invoice='.session('paid_monthly_invoice'));

        if (count($order['order_groups'])) {
            session(['cart' => $order]);
        }

        $paid_monthly_invoice = $this->requestConnectionForCustomer('check-monthly-invoice');

        if(session('paid_monthly_invoice') != $paid_monthly_invoice['0']){
            session()->flush();
            return $this->failRedirect('/', "Session Expired!!! Payment NOT processed, Please try again");
        }

        if(session('changePlanStatus') == "Downgrade"){
            $this->updateSubscription();
            $this->generateInvoice();

            return redirect()->route('confirmation.index');
        }else{
            $response = $this->creditCardApi($request);
            $message = '';

            if(!$response){
                return redirect()->route('confirmation.index');
            }
            if (isset($response['message'])) {
                $message = is_array($response['message']) ? $response['message'][0] : $response['message'];
                return redirect()->back()->with(['notification' => [
                    'status'  => 'danger',
                    'message' => 'Payment Decline Due to '. $message,
                ]
                ]);
            } elseif (isset($response['invoice'])) {
                return redirect()->back()->with(['notification' => [
                    'status'  => 'success',
                    'message' => 'Your payment was successfull but we failed to generate your invoice.'
                ]
                ]);
            } elseif(!isset($response['success'])){
                $value = $this->requestConnectionForCustomer('payment-failed', 'post', [ 'cart' => session('cart')]);
                session()->forget(['cart', 'hash', 'couponAmount', 'couponCodes', 'changePlanStatus', 'taxrate']);
                return redirect('account')->with(['notification' => [
                    'status'  => 'danger',
                    'message' => 'Order NOT Placed, Any charged Amount will be Credited back to your account',
                ]
                ]);
            }
        }
        $this->subscriptionApi();
        $this->standalonesApi();
        $invoiceItem = [
            'data_to_invoice'       => $this->res,
            'customer_id'           => session('id'),
            'hash'                  => session('hash')['order_hash'],
            // 'order_id'              => session('cart')['id'],
            'auto_generated_order'  => session('paid_monthly_invoice'),
            'coupon'                => json_encode(session('couponAmount') ?? [])
        ];

        $api = $this->requestConnection('generate-one-time-invoice', 'post', $invoiceItem);
        if (isset($api['order_num']))  {
            session(['order_num' => $api['order_num']]);
        }
        session(['checkout_done' => true]);

        return redirect()->route('confirmation.index');
    }

    /**
     * @param string $type
     */
    private function generateInvoice($type = 'downgrade-scheduled')
    {
        $invoiceData = [
            'customer_id'   => session('id'),
            'order_hash'    => session('hash')['order_hash'],
            'status'        => "Without Payment",
            'order_groups'  => session('cart')['order_groups'],
            'type'          => $type,
        ];

        $api = $this->requestConnection('generate-one-time-invoice', 'post', $invoiceData);
        if (isset($api['order_num']))  {
            session(['order_num' => $api['order_num']]);
        }
        session(['checkout_done' => true]);
    }


    /**
     * @param string $status
     */
    private function updateSubscription($status = 'downgrade-scheduled')
    {
        foreach (session('cart')['order_groups'] as $cart) {
            if ($cart['plan']['id'] != null) {
                $data = [
                    'order_hash'                => session('hash')['order_hash'],
                    'id'                        => $cart['subscription']['id'],
                    'new_plan_id'               => $cart['plan']['id'],
                    'upgrade_downgrade_status'  => $status,
                    'order_group'               => session('cart')['order_groups'][0]['id'],
                ];
                $subscription = $this->requestConnection('update-subscription', 'post', $data);
                if($status == 'for-upgrade'){
                    break;
                }
            }
        }
    }

    /**
     * Creates Customer
     *
     * @param  Request $request
     * @return string
     */
    public function createCustomer(Request $request)
    {
        $data = array_merge($request->all(), [
            'order_hash' => session('hash')['order_hash']
        ]);

        $this->orderUpdateShipping($request);

        $response = $this->requestConnection('create-customer', 'post', $data);

        return $response;
    }

    /**
     * Update Order Shipping Values
     *
     * @param  Request $request
     * @return string
     */
    public function orderUpdateShipping($customer)
    {
        $data = array_merge($customer->only('shipping_fname',
            'shipping_lname',
            'shipping_address1',
            'shipping_address2',
            'shipping_city',
            'shipping_state_id',
            'shipping_zip'
        ), [
            'hash' => session('hash')['order_hash']
        ]);
        $response = $this->requestConnection('order/update-shipping', 'post', $data);

        return $response;
    }

    /**
     * Validates the order_hash
     *
     * @param  Request   $request
     * @return string    $message
     */
    protected function getCartOrder($request)
    {
        $message = '';
        if ($request->order_hash) {
            $getOrder = $this->requestConnection('order?order_hash='.$request->order_hash.'&paid_monthly_invoice='.session('paid_monthly_invoice'));

            if (!count($getOrder['order_groups'])) {
                $message = 'Oops! Something is incorrect, please check your mail again or contact us if the problem still persists.';

            } else {
                session(['hash' => ['order_hash' => $request->order_hash]]);
                session(['cart' => $getOrder]);
                /**
                 * Adding the coupon details to the session
                 */
                if(isset($getOrder['couponDetails'])){
                    session(['couponAmount' => $getOrder['couponDetails']]);
                    foreach($getOrder['couponDetails'] as $coupon) {
                        $couponCodes = session('couponCodes') ?: [];
                        if(!isset($coupon['error']) && !in_array($coupon['code'], $couponCodes, true)){
                            session()->push('couponCodes', $coupon['code']);
                        }
                    }
                }

                if (session('cart')['company']['business_verification'] == 1 && session('id') == null) {
                    if (!$request->verification_hash) {
                        $message = 'Please check your mail to proceed further';
                    }elseif (isset(session('cart')['business_verification']['approved']) && session('cart')['business_verification']['approved'] != '1') {
                        $message = 'Your Business is not approved Yet';
                        session()->flush();
                    }
                }
                if (session('cart')['status'] == 1) {
                    $message = 'You have already placed your order.';
                    session()->flush();
                }
            }
        } else {
            $message = 'Oops! Something is incorrect, please <b>Verify Your Business</b> first.';

        }
        return $message;
    }

    /**
     * Runs Credit Card Api with data
     *
     * @param  Request      $request
     * @return Response     response from api
     */
    protected function creditCardApi($request)
    {
        if (session('id')) {
            $this->requestConnection('create-customer', 'post', [
                'customer_id'   => session('id'),
                'order_hash'    => session('hash')['order_hash'],
            ]);
        }
        $subtotalPrice = $this->cartItem->totalPrice();

        $data = array_merge($request->all(), [
            'amount'     => $subtotalPrice,
            'order_hash' => session('cart')['order_hash']
        ]);

        if (session('id')) {
            $data ['customer_id'] = session('id');
        } elseif (session('cart')) {
            $data ['customer_id'] = session('cart')['customer_id'];
        }

        if($subtotalPrice > 0){
            $chargeNewCard = $this->requestConnection('charge-new-card', 'post', $data);
        }else if(session('changePlanStatus') == "sameplan"){
            $this->updateSubscription("sameplan");
            $this->generateInvoice("sameplan");
            $chargeNewCard = null;
        }else if(session('changePlanStatus') == "Upgrade"){
            $this->updateSubscription("for-upgrade");
            $this->generateInvoice("for-upgrade");

            $chargeNewCard = null;
        } else {
            $validatedData     = $this->validateData($request);
            $response = $this->validateMonth($validatedData);
            if (isset($response)) {
                return $response;
            }
            $validatedData  = $this->addAdditionalData($validatedData);
            $chargeNewCard = $this->requestConnection('add-card', 'post', $validatedData);
        }
        return $chargeNewCard;
    }

    /**
     * Runs create_device_record and create_sim_record
     *
     * @return Response     response from api
     */
    protected function standalonesApi()
    {
        $this->setDataValue();

        if (session('id')) {
            $data = array_merge($this->data, [
                'customer_id' => session('id'),
            ]);
        } elseif (session('cart')) {
            $data = array_merge($this->data, [
                'customer_id' => session('cart')['customer_id'],
            ]);
        }

        foreach (session('cart')['order_groups'] as $cart) {

            if ($cart['plan'] == null && $cart['device'] != null) {
                $deviceCoupons = $this->getCouponData($cart['id']);
                $couponData = [];

                foreach($deviceCoupons as $deviceCoupon){
                    $couponData[] = [
                        'code'          => $deviceCoupon['code'],
                        'amount'        => $deviceCoupon['amount'],
                        'description'   => $deviceCoupon['code']
                    ];
                }

                $data['coupon_data'] = json_encode($couponData);

                $deviceRecord = $this->requestConnection('create-device-record', 'post', array_merge($data, ['device_id' => $cart['device']['id']]));

                array_push($this->res['customer_standalone_device_id'], $deviceRecord['device_id']);
            }


            if ($cart['plan'] == null && $cart['sim'] != null) {
                $simCoupons = $this->getCouponData($cart['id']);
                $couponData = [];

                foreach($simCoupons as $simCoupon){
                    $couponData[] = [
                        'code'          => $simCoupon['code'],
                        'amount'        => $simCoupon['amount'],
                        'description'   => $simCoupon['code']
                    ];
                }

                $data['coupon_data'] = json_encode($couponData);

                $simRecord = $this->requestConnection('create-sim-record', 'post', array_merge($data, ['sim_id' => $cart['sim']['id']]));
                array_push($this->res['customer_standalone_sim_id'], $simRecord['sim_id']);
            }
        }

        return $this->res;
    }

    /**
     * Fetches customer_cards if logged in
     *
     * @return Api response
     */
    protected function customerCardsApi()
    {
        $api = null;

        if (session('customer_hash')) {
            $api = $this->requestConnection('customer-cards', 'get', array_merge($this->data, [
                'hash'     => session('customer_hash'),
            ]));
        } elseif (session('id')) {
            $api = $this->requestConnection('customer-cards', 'get', array_merge($this->data, [
                'customer_id' => session('id'),
            ]));

        }
        return $api;
    }

    /**
     * Runs create subscription api
     *
     * @return Response     response from api
     */
    protected function subscriptionApi()
    {
        foreach (session('cart')['order_groups'] as $cart) {
            if ($cart['plan']['id'] != null && !isset($cart['plan']['auto_generated_plans'])) {
                $data = [
                    'api_key'          => env('API_KEY'),
                    'order_id'         => session('cart')['id'],
                    'device_id'        => isset($cart['device']['id']) ? $cart['device']['id'] : $cart['device'],
                    'plan_id'          => $cart['plan']['id'],
                    'sim_id'           => $cart['sim']['id'],
                    'sim_num'          => $cart['sim_num'],
                    'sim_type'         => $cart['sim_type'],
                    'porting_number'   => $cart['porting_number'],
                    'area_code'        => $cart['area_code'],
                    'operating_system' => session('cart')['operating_system'],
                    'imei_number'      => session('cart')['imei_number'],
                    'subscription'     => $cart['subscription'],
                    'status'           => isset($cart['status'])? $cart['status']: null,
                ];

                $subscriptionCoupons = $this->getCouponData($cart['id']);

                $couponData = [];

                foreach($subscriptionCoupons as $subscriptionCoupon){
                    $couponData[] = [
                        'code'          => $subscriptionCoupon['code'],
                        'amount'        => $subscriptionCoupon['amount'],
                        'description'   => $subscriptionCoupon['code']
                    ];
                }

                $data['coupon_data'] = json_encode($couponData);

                $subscription = $this->requestConnection('create-subscription', 'post', $data);

                if (isset($subscription['subscription_id'])) {
                    array_push($this->res['subscription_id'], $subscription['subscription_id']);
                    foreach ($cart['addons'] as $addon) {
                        $subscriptionAddon = $this->subscriptionAddonApi($subscription['subscription_id'], $addon['id'], $addon['subscription_addon_id'], $addon['subscription_id'], $cart['plan']['id']);
                        if ($subscriptionAddon) {
                            if(isset($subscriptionAddon['subscription_addon_id'])){
                                array_push($this->res['subscription_addon_id'], $subscriptionAddon['subscription_addon_id']);
                            }
                        }
                    }
                } elseif (isset($subscription['same_subscription_id'])) {
                    array_push($this->res['same_subscription_id'], $subscription['same_subscription_id']);
                    foreach ($cart['addons'] as $addon) {
                        $subscriptionAddon = $this->subscriptionAddonApi($subscription['same_subscription_id'], $addon['id'], $addon['subscription_addon_id'], $addon['subscription_addon_id'], $cart['plan']['id']);
                        if ($subscriptionAddon) {
                            if(isset($subscriptionAddon['subscription_addon_id'])){
                                array_push($this->res['subscription_addon_id'], $subscriptionAddon['subscription_addon_id']);
                            }
                        }
                    }
                }
                if(isset($cart['status'])){
                    break;
                }
            }
        }
        return $this->res;
    }

    /**
     * Runs create subscription addon api
     *
     * @return Response     response from api
     */
    protected function subscriptionAddonApi($subscriptionId,
        $addonId,
        $subscriptionAddonId,
        $addonSubscriptionId,
        $planId = 0)
    {
        $this->setDataValue();

        $data = array_merge($this->data, [
            'subscription_id'       => $subscriptionId,
            'addon_id'              => $addonId,
            'subscription_addon_id' => $subscriptionAddonId,
            'addon_subscription_id' => $addonSubscriptionId,
            'plan_id'               => $planId,
        ]);

        $response = $this->requestConnection('create-subscription-addon', 'post', $data);
        return $response;
    }

    /**
     * Sets the default values of api_key and order_id
     */
    protected function setDataValue()
    {
        if (session('cart')) {
            $this->data = array_merge($this->data, [
                'order_id' => session('cart')['id'],
            ]);
        }
        return $this->data;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator($data)
    {
        $rules  = '';

        // if (session('id')) {
        //     $rules  = CustomerRequest::rulesForReturningCustomer();
        // } else {
        $rules  = CustomerRequest::baseRules();
        //}

        return Validator::make($data->all(), $rules);
    }

    /**
     * List of states
     * @return Illuminate\Support\Collection
     */
    private function states()
    {
        return StatesProvider::data();
    }

    /**
     * @param Request $request
     *
     * @return \App\Support\Utilities\Collection
     */
    public function saveTaxDetails(Request $request)
    {
        $data = $request->validate(
            [
                'billing_state_id'   => 'required|string',
                'billing_fname'      => 'required|string',
                'billing_lname'      => 'required|string',
                'billing_address1'   => 'required|string',
                'billing_address2'   => 'nullable|string',
                'billing_city'       => 'required|string',
                'billing_zip'		 => 'required|string',
            ]
        );
        return $this->requestConnection('create-customer', 'post', array_merge($data, ['id' => session('id') ?: session('cart')['customer_id']]));
    }

    /**
     * @param CartResponse $cart
     * @param Request      $request
     *
     * @return float|int
     */
    public function calculateTax(CartResponse $cart, Request $request)
    {
        return $cart->calTaxes($request->tax_id);
    }

    /**
     * @param $cartId
     *
     * @return array
     */
    protected function getCouponData($cartId)
    {
        $couponData   = session('couponAmount') ?? [];
        $productDiscount = [];

        foreach($couponData as $coupon) {
            $tempAmount = [];
            if ( ! empty( $coupon[ 'applied_to' ][ 'applied_to_all' ] ) ) {
                $types = $coupon[ 'applied_to' ][ 'applied_to_all' ];
                foreach ( $types as $type ) {
                    if ( isset( $type[ 'order_group_id' ] ) && $type[ 'order_group_id' ] == $cartId ) {
                        $tempAmount[] = $type[ 'discount' ];
                    }
                }
            } elseif ( ! empty( $coupon[ 'applied_to' ][ 'applied_to_types' ] ) ) {
                $types = $coupon[ 'applied_to' ][ 'applied_to_types' ];
                foreach ( $types as $type ) {
                    if ( isset( $type[ 'order_group_id' ] ) && $type[ 'order_group_id' ] == $cartId ) {
                        $tempAmount[] = $type[ 'discount' ];
                    }
                }
            } elseif ( ! empty( $coupon[ 'applied_to' ][ 'applied_to_products' ] ) ) {
                $types = $coupon[ 'applied_to' ][ 'applied_to_products' ];
                foreach ( $types as $type ) {
                    if ( isset( $type[ 'order_group_id' ] ) && $type[ 'order_group_id' ] == $cartId ) {
                        $tempAmount[] = $type[ 'discount' ];
                    }
                }
            }
            $productDiscount[] = [
                'amount' => $tempAmount ? array_sum( $tempAmount ) : 0,
                'code'   => $coupon[ 'code' ]
            ];
        }
        return $productDiscount;
    }

    /**
     * Process coupon after an item is removed from cart
     */
    protected function processCoupons()
    {
        $couponCodes = session( 'couponCodes' ) ?: [];
        if($couponCodes) {
            session()->forget( [
                'couponAmount'
            ] );
            foreach ( $couponCodes as $couponCode ) {
                if ( $couponCode ) {
                    $removeCoupon = $this->requestConnection( 'coupon/remove-coupon', 'post', [
                        'order_id'    => session( 'cart' )[ 'id' ],
                        'coupon_code' => $couponCode
                    ] );

                    $couponAmount = $this->requestConnection( 'coupon/add-coupon', 'post',
                        [
                            'code'        => $couponCode,
                            'order_id'    => session( 'cart' )[ 'id' ],
                            'customer_id' => session( 'id' )
                        ]
                    );
                    if ( ! isset( $couponAmount[ 'error' ] ) ) {
                        session()->push( 'couponAmount', $couponAmount );
                    }
                }
            }
        }
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    protected function validateData($request)
    {
        $data = $request->validate([
            'payment_card_no'        => 'required|min:12|max:19',
            'expires_mmyy'           => 'required',
            'payment_cvc'            => 'required|max:4',
            'payment_card_holder'    => 'required',
            'billing_fname'          => 'required',
            'billing_lname'          => 'required',
            'billing_address1'       => 'required',
            'billing_city'           => 'required',
            'billing_state_id'       => 'required',
            'billing_zip'            => 'required',
        ]);

        return $data;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    private function addAdditionalData($data)
    {
        $data['api_key']       =  env('API_KEY');
        if (session('id')) {
            $data ['customer_id'] = session('id');
        } elseif (session('cart')) {
            $data ['customer_id'] = session('cart')['customer_id'];
        }

        return $data;
    }

    /**
     * @param $data
     *
     * @return string[]
     */
    private function validateMonth($data)
    {
        $now   = new DateTime('now');
        $month = $now->format('m');
        $year  = $now->format('y');
        $cardExpiryDateMonth = $data['expires_mmyy'];
        $cardExpiryDateMonth = explode('/', $cardExpiryDateMonth);
        if ($year === $cardExpiryDateMonth[1] && $cardExpiryDateMonth[0] < $month) {
            return [
                'message' => "New Card Can't be added due to Invalid Expiration Month"
            ];
        }
    }
}
