<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\Cart\CartResponse;

/**
 * Class DeviceController
 *
 * @package App\Http\Controllers
 */
class DeviceController extends Controller
{

    /**
     *
     */
    const ACCOUNT = [
        'active'    => 0,
        'suspended' => 1
    ];

    /**
     * @var CartResponse
     */
    protected $cartItem;

    /**
     * DeviceController constructor.
     *
     * @param CartResponse $cartResponse
     */
    public function __construct(CartResponse $cartResponse)
    {
        $this->middleware('get.devices');
        $this->cartItem = $cartResponse;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data          = session('deviceData') ?: $this->requestConnection('devices');
        $checkSession  = $this->cartItem->checkDeviceExists();

        $sessionCart    = session('cart') ?: [];

        if (session('id')) {
            $customer = $this->requestConnectionForCustomer('customer', 'get');
            session('cart')['business_verification'] = $customer->toArray();
        }
        $this->processCoupons();
        return view('devices.index', compact('data', 'checkSession', 'sessionCart'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!session('hash')) {
            $orderHash = $this->requestConnection('order', 'post', [
                'device_id'     => 0,
                'customer_hash' => session('customer_hash') ?: null,
                'paid_monthly_invoice' => session('paid_monthly_invoice'),

            ]);
            session(['hash' => $orderHash]);

        } else {

            $this->requestConnection('order', 'post', [
                'device_id'     => 0,
                'order_hash'    => session('hash')['order_hash'],
                'customer_hash' => session('customer_hash') ?: null,
                'paid_monthly_invoice' => session('paid_monthly_invoice'),
            ]);
        }

        return redirect()->route('plans.create')->with(['deviceName' => 'Device', 'deviceId' => 0]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->postData($request);

        if ($response) {
            return false;
        }
        $deviceName = $request->device_name ?: 'Device';

        if ($request->own_device) {
            $this->closeOrderGroup();
            return 'true';

        } else {
            $this->updateSessionWithPlan();

        }
        return redirect()->route('plans.index')->with([
            'deviceId'     => $request->device_id,
            'deviceName'   => $deviceName,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $request
     *
     * @return false
     */
    protected function postData($request)
    {
        if (!session('hash')) {
            $orderHash = $this->requestConnection('order', 'post', [
                'device_id'     => $request->device_id,
                'customer_hash' => session('customer_hash') ?: null,
                'paid_monthly_invoice' => session('paid_monthly_invoice'),
            ]);
            session(['hash' => $orderHash]);

        } else {
            $this->requestConnection('order', 'post', [
                'device_id'     => $request->device_id,
                'order_hash'    => session('hash')['order_hash'],
                'customer_hash' => session('customer_hash') ?: null,
                'paid_monthly_invoice' => session('paid_monthly_invoice'),
            ]);
        }
        return false;
    }

    /**
     * @return bool
     */
    protected function closeOrderGroup()
    {
        $this->requestConnection('order-group', 'put', [
            'action'     => 1,
            'order_hash' => session('hash')['order_hash'],
        ]);
        session()->forget(['deviceData', 'planData']);
        return true;

    }

    /**
     * @return bool
     */
    protected function updateSessionWithPlan()
    {
        $order = $this->requestConnection('order?order_hash='.session('hash')['order_hash'].'&paid_monthly_invoice='.session('paid_monthly_invoice'));
        session(['cart' => $order]);
        return true;
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
}
