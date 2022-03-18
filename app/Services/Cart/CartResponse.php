<?php
namespace App\Services\Cart;

use App\Http\Controllers\CustomerController;

/**
 * Class CartResponse
 *
 * @package App\Services\Cart
 */
class CartResponse extends CustomerController
{
    /**
     * $cartItems
     *
     * @var array
     */
    protected $cartItems;

    /**
     * $prices
     *
     * @var array
     */
    protected $prices;

    /**
     * $regulatory
     *
     * @var array
     */
    protected $regulatory;

    /**
     * $taxes
     *
     * @var array
     */
    protected $taxes;

    /**
     * $shippingFee
     *
     * @var array
     */
    protected $shippingFee;

    /**
     * $activation
     *
     * @var array
     */
    protected $activation;

    /**
     * $coupons
     *
     * @var array
     */
    protected $coupons;

    /**
     * Order Groups
     */
    const ORDER_GROUP = [
        'PLAN'      =>  'plan',
        'DEVICE'    =>  'device',
        'SIM'       =>  'sim',
        'ADDON'     =>  'addons'
    ];

    /**
     * @return array|\Illuminate\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function getSession()
    {
        return $this->cartItems = session('cart') ?: [];
    }

    /**
     * @return int
     */
    public function coupon()
    {
        $couponAmount = 0;
        if(session('couponAmount')){
            foreach(session('couponAmount') as $coupon){
                if(isset($coupon['total'])){
                    $couponAmount -= (float) $coupon['total'];
                }
            }
        }
        $this->couponAmount = $couponAmount;
        return $this->couponAmount;
    }

    /**
     * Collects id of all devices from session('cart')
     *
     * @return Array
     */
    public function checkDeviceExists()
    {
        $deviceId = [];
        $this->getSession();
        $activeGroupId = $this->getActiveGroupId();
        if ($this->cartItems != null) {
            if (count($this->cartItems['order_groups'])) {
                foreach ($this->cartItems['order_groups'] as $cart) {
                    if ($cart['device'] != null) {
                        $deviceId[] = ($cart['id'] == $activeGroupId) ? $cart['device']['id'] : [];
                    }
                }
            }
        }
        return $deviceId;
    }

    /**
     * Collects id of all plans from session('cart')
     *
     * @return Array
     */
    public function checkPlanExists()
    {
        $planId = [];
        $this->getSession();
        $activeGroupId = $this->getActiveGroupId();
        if ($this->cartItems != null) {
            if (count($this->cartItems['order_groups'])) {
                foreach ($this->cartItems['order_groups'] as $cart) {
                    if ($cart['plan'] != null) {
                        $planId[] = ($cart['id'] == $activeGroupId) ? $cart['plan']['id'] : [];
                    }
                }
            }
        }
        return $planId;
    }

    /**
     * Returns the active-group-id
     *
     * @return int
     */
    public function getActiveGroupId()
    {
        $this->getSession();
        return (isset($this->cartItems['active_group_id'])) ? $this->cartItems['active_group_id'] : null;
    }

    /**
     * Calculates the monthly charge of Cart (plans + addons)
     *
     * @return float  $monthlyCharge
     */
    public function calMonthlyCharge()
    {
        $this->prices = [];
        $this->getOriginalPlanPrice();
        $this->getOriginalAddonPrice();
        $price = ($this->prices) ? array_sum($this->prices) : 0;
        if(isset(session('cart')['paid_invoice'])){
            $price /= 2;
        }
        return $price;
    }

    /**
     * Calculates the Sub-Total Price of Cart
     *
     * @return float  $subtotalPrice
     */
    public function totalPrice()
    {
        if (session('total_price')) {
            session(['total_price' => 0]);
        }
        $this->getSession();
        $this->calDevicePrices();
        $this->getPlanPrices();
        $this->getSimPrices();
        $this->getAddonPrices();
        $this->getShippingFee();
        $this->calRegulatory();
        $this->coupon();
        $this->calTaxes();
        $price[] = ($this->prices) ? array_sum($this->prices) : 0;
        $price[] = ($this->regulatory) ? array_sum($this->regulatory) : 0;
        $price[] = ($this->couponAmount);
        if (session('tax_total') === 0) {
            $price[] = ($this->taxes) ? number_format(array_sum($this->taxes), 2) : 0;
        } else {
            $price[] = number_format(session('tax_total'), 2);
        }
        $price[] = ($this->activation) ? array_sum($this->activation) : 0;
        $price[] = ($this->shippingFee) ? array_sum($this->shippingFee) : 0;
        $totalPrice = array_sum($price);
        session(['total_price' => $totalPrice]);
        return $totalPrice;
    }

    /**
     * Calculates the Sub-Total Price of Cart
     *
     * @return float  $subtotalPrice
     */
    public function subTotalPrice()
    {
        $this->calDevicePrices();
        $this->getPlanPrices();
        $this->getSimPrices();
        $this->getAddonPrices();
        $price[] = ($this->prices) ? array_sum($this->prices) : 0;
        $price[] = ($this->activation) ? array_sum($this->activation) : 0;
        $subtotalPrice = array_sum($price);
        return $subtotalPrice;
    }

    /**
     * It returns the array of Device-prices from an array
     *
     * @param   array  $type
     * @return  array
     */
    protected function calDevicePrices()
    {
        $this->prices = [];
        $activeGroupId = $this->getActiveGroupId();
        if ($this->cartItems != null) {
            if (count($this->cartItems['order_groups'])) {
                foreach ($this->cartItems['order_groups'] as $cart) {
                    if ($cart['device'] != null) {
                        if ($cart['plan'] == null) {
                            if ($cart['id'] == $activeGroupId) {
                                $this->prices[] = $cart['device']['amount_w_plan'];
                            } else {
                                $this->prices[] = $cart['device']['amount'];
                            }
                        } else {
                            $this->prices[] = $cart['device']['amount_w_plan'];
                        }
                    }
                }
            }
        }
        return true;
    }

    /**
     * It returns the array of Plan-prices from an array
     *
     * @param   array  $type
     * @return  array
     */
    protected function getPlanPrices()
    {
        $this->activation = [];
        $this->getSession();
        if ($this->cartItems != null) {
            if (count($this->cartItems['order_groups'])) {
                foreach ($this->cartItems['order_groups'] as $cart) {
                    if ($cart['plan']['amount_onetime'] > 0) {
                        $this->activation[] = $cart['plan']['amount_onetime'];
                    }
                    if ($cart['plan_prorated_amt']) {
                        $this->prices[] = $cart['plan_prorated_amt'];
                    } else {
                        $this->prices[] = ($cart['plan'] != null) ? $cart['plan']['amount_recurring'] : [];
                    }
                }
            }
        }
        return true;
    }

    /**
     * Gets Shipping fee
     *
     * @return float  $shippingFee
     */
    public function getShippingFee()
    {
        $this->shippingFee = [];
        $this->getSession();
        if ($this->cartItems != null) {
            if (count($this->cartItems['order_groups'])) {
                foreach ($this->cartItems['order_groups'] as $cart) {
                    if ($cart['device'] != null) {
                        if ($cart['device']['shipping_fee'] != null) {
                            $this->shippingFee[] = $cart['device']['shipping_fee'];
                        }
                    } if ($cart['sim'] != null) {
                        if ($cart['sim']['shipping_fee'] != null) {
                            $this->shippingFee[] = $cart['sim']['shipping_fee'];
                        }
                    }
                }
            }
        }
        $shippingFee = ($this->shippingFee) ? array_sum($this->shippingFee) : 0;
        return $shippingFee;
    }

    /**
     * @return mixed
     */
    public function orderId()
    {
        return $this->cartItems['id'];
    }

    /**
     * @return float|int
     */
    public function calRegulatory()
    {
        $this->regulatory = [];
        $this->getSession();
        if ($this->cartItems != null) {
            if (count($this->cartItems['order_groups'])) {
                foreach ($this->cartItems['order_groups'] as $cart) {
                    if($cart['plan'] != null && !isset($cart['status'])){
                        if ($cart['plan']['regulatory_fee_type'] == 1) {
                            $this->regulatory[] = $cart['plan']['regulatory_fee_amount'];
                        }elseif ($cart['plan']['regulatory_fee_type'] == 2) {
                            if($cart['plan_prorated_amt'] != null){
                                $this->regulatory[] = number_format($cart['plan']['regulatory_fee_amount']*$cart['plan_prorated_amt']/100, 2);
                            }else{
                                $this->regulatory[] = number_format($cart['plan']['regulatory_fee_amount']*$cart['plan']['amount_recurring']/100, 2);
                            }
                        }
                    }
                }
            }
        }
        $regulatory = ($this->regulatory) ? array_sum($this->regulatory) : 0;
        return $regulatory;
    }

    /**
     * @param null $taxId
     *
     * @return float|int
     */
    public function calTaxes($taxId = null)
    {
        $this->taxes = [];
        $this->getSession();
        if ($this->cartItems != null) {
            if (count($this->cartItems['order_groups'])) {
                foreach ($this->cartItems['order_groups'] as $cart) {
                    $this->taxes[] = number_format($this->calTaxableItems($cart, $taxId), 2);
                }
            }
        }
        $taxes = ($this->taxes) ? array_sum($this->taxes) : 0;
        $taxId ? session(['tax_total' => $taxes]) : session(['tax_total' => 0]);
        $taxId ? $this->totalPrice() : null; // to add tax to total without refresh
        return $taxes;
    }

    /**
     * @param $stateId
     *
     * @return \App\Support\Utilities\Collection
     */
    public function taxrate($stateId)
    {
        return $this->requestConnection('customer', 'get', $stateId);
    }

    /**
     * @param $cart
     * @param $taxId
     *
     * @return float|int
     */
    public function calTaxableItems($cart, $taxId)
    {
        $stateId = '';
        if (!$taxId) {
            if (session('cart')['business_verification'] && isset(session('cart')['business_verification']['billing_state_id'])) {
                session(['tax_id' => session('cart')['business_verification']['billing_state_id']]);
            } elseif (session('cart')['customer'] && isset(session('cart')['customer']['billing_state_id'])) {
                session(['tax_id' => session('cart')['customer']['billing_state_id']]);
            }
        } else {
            session(['tax_id' => $taxId]);
        }
        $stateId = ['tax_id' => session('tax_id')];
        $taxRate    = $this->taxrate($stateId);
        if (!session('taxrate') || session('taxrate') && isset($taxRate['tax_rate']) && session('taxrate') != $taxRate['tax_rate']) {
            $taxRate    = $this->taxrate($stateId);
            session(['taxrate' => isset($taxRate['tax_rate']) ? $taxRate['tax_rate'] : 0]);
        }
        $taxPercentage  = session('taxrate') / 100;
        if(isset($cart['status']) && $cart['status'] == "SamePlan"){
            //Addon
            $addons = $this->addTaxesToAddons($cart, $taxPercentage);
            return $addons;
        }
        if(isset($cart['status']) && $cart['status'] == "Upgrade"){
            //Plans
            $plans = $this->addTaxesToPlans($cart, $cart['plan'], $taxPercentage);
            //Addons
            $addons = $this->addTaxesToAddons($cart, $taxPercentage);
            return $plans + $addons;
        }
        //Devices
        $devices        = $this->addTaxesDevices($cart, $cart['device'], $taxPercentage);
        //Sims
        $sims           = $this->addTaxesSims($cart, $cart['sim'], $taxPercentage);
        //Plans
        $plans          = $this->addTaxesToPlans($cart, $cart['plan'], $taxPercentage);

        //Addons
        $addons         = $this->addTaxesToAddons($cart, $taxPercentage);
        return $devices + $sims + $plans + $addons;
    }

    /**
     * @param $cart
     * @param $item
     * @param $taxPercentage
     *
     * @return float|int
     */
    public function addTaxesSims($cart, $item, $taxPercentage)
    {
        $itemTax = [];
        if ($item && $item['taxable']) {
            $amount = $cart['plan'] != null ? $item['amount_w_plan'] : $item['amount_alone'];
            if (session('couponAmount')) {
                $discounted = $this->getCouponPrice(session('couponAmount'), $item, 3);
                $amount = $discounted > 0 && $amount > $discounted ? $amount - $discounted : 0;
            }
            $itemTax[] = $taxPercentage * $amount;
        }
        return !empty($itemTax) ? array_sum($itemTax) : 0;
    }

    /**
     * @param $cart
     * @param $item
     * @param $taxPercentage
     *
     * @return float|int
     */
    public function addTaxesDevices($cart, $item, $taxPercentage)
    {
        $itemTax = [];
        if ($item && $item['taxable']) {
            $amount = $cart['plan'] != null ? $item['amount_w_plan'] : $item['amount'];
            if (session('couponAmount')) {
                $discounted = $this->getCouponPrice(session('couponAmount'), $item, 2);
                $amount = $discounted > 0 && $amount > $discounted ? $amount - $discounted : 0;
            }
            $itemTax[] = $taxPercentage * $amount;
        }
        return !empty($itemTax) ? array_sum($itemTax) : 0;
    }

    /**
     * @param $cart
     * @param $item
     * @param $taxPercentage
     *
     * @return float|int
     */
    public function addTaxesToPlans($cart, $item, $taxPercentage)
    {
        $planTax = [];
        if ($item != null && $item['taxable']) {
            $amount = $cart['plan_prorated_amt'] != null ? $cart['plan_prorated_amt'] : $item['amount_recurring'];
            $amount = $item['amount_onetime'] != null ? $amount + $item['amount_onetime'] : $amount;
            if (session('couponAmount')) {
                $discounted = $this->getCouponPrice(session('couponAmount'), $item, 1);
                $amount = $discounted > 0 && $amount > $discounted ? $amount - $discounted : 0;
            }
            $planTax[] = $taxPercentage * $amount;
        }
        return !empty($planTax) ? array_sum($planTax) : 0;
    }

    /**
     * @param $cart
     * @param $taxPercentage
     *
     * @return float|int
     */
    public function addTaxesToAddons($cart, $taxPercentage)
    {
        $addonTax = [];
        if ($cart['addons'] != null) {
            foreach ($cart['addons'] as $addon) {
                if ($addon['taxable'] == 1) {
                    $amount = $addon['prorated_amt'] != null ? $addon['prorated_amt'] : $addon['amount_recurring'];
                    if (session('couponAmount')) {
                        $discounted = $this->getCouponPrice(session('couponAmount'), $addon, 4);
                        $amount = $discounted > 0 && $amount > $discounted ? $amount - $discounted : 0;
                    }
                    $addonTax[] = $taxPercentage * $amount;
                }
            }
        }
        return !empty($addonTax) ? array_sum($addonTax) : 0;
    }

    /**
     * It returns the array of Plan-prices from an array
     *
     * @param   array  $type
     * @return  array
     */
    protected function getOriginalPlanPrice()
    {
        $this->getSession();
        if ($this->cartItems != null) {
            if (count($this->cartItems['order_groups'])) {
                foreach ($this->cartItems['order_groups'] as $cart) {
                    $this->prices[] = ($cart['plan'] != null) ? $cart['plan']['amount_recurring'] : [];
                }
            }
        }
        return true;
    }

    /**
     * It returns the array of Sim-prices from an array
     *
     * @param   array  $type
     * @return  array
     */
    protected function getSimPrices()
    {
        $this->getSession();
        if ($this->cartItems != null) {
            if (count($this->cartItems['order_groups'])) {
                foreach ($this->cartItems['order_groups'] as $cart) {
                    if ($cart['sim'] != null && $cart['plan'] != null) {
                        $this->prices[] = $cart['sim']['amount_w_plan'];
                    } elseif ($cart['sim'] != null && $cart['plan'] == null) {
                        $this->prices[] = $cart['sim']['amount_alone'];
                    }
                }
            }
        }
        return true;
    }

    /**
     * It returns the array of Addon-prices from an array
     *
     * @param   array  $type
     * @return  array
     */
    protected function getAddonPrices()
    {
        $this->getSession();
        if ($this->cartItems != null) {
            if (count($this->cartItems['order_groups'])) {
                foreach ($this->cartItems['order_groups'] as $cart) {
                    if ($cart['addons'] != null) {
                        foreach ($cart['addons'] as $addon) {
                            if ($addon['prorated_amt'] != null) {
                                $this->prices[] = $addon['prorated_amt'];
                            } else {
                                $this->prices[] = $addon['amount_recurring'];
                            }
                        }
                    }
                }
            }
        }
        return true;
    }

    /**
     * It returns the array of Addon-prices from an array
     *
     * @param   array  $type
     * @return  array
     */
    protected function getOriginalAddonPrice()
    {
        $this->getSession();
        if ($this->cartItems != null) {
            if (count($this->cartItems['order_groups'])) {
                foreach ($this->cartItems['order_groups'] as $cart) {
                    if ($cart['addons'] != null) {
                        foreach ($cart['addons'] as $addon) {
                            if($addon['subscription_addon_id']!= null){
                                $this->prices[] = [];
                            }else{
                                $this->prices[] = $addon['amount_recurring'];
                            }
                        }
                    }
                }
            }
        }
        return true;
    }

    /**
     * @param $couponData
     * @param $item
     * @param $itemType
     *
     * @return int|mixed
     */
    protected function getCouponPrice($couponData, $item, $itemType)
    {
        $productDiscount = 0;
        foreach($couponData as $coupon) {
            $type = $coupon[ 'coupon_type' ];
            if ( $type == 1 ) { // Applied to all
                $appliedTo = $coupon[ 'applied_to' ][ 'applied_to_all' ];
            } elseif ( $type == 2 ) { // Applied to types
                $appliedTo = $coupon[ 'applied_to' ][ 'applied_to_types' ];
            } elseif ( $type == 3 ) { // Applied to products
                $appliedTo = $coupon[ 'applied_to' ][ 'applied_to_products' ];
            }
            if ( count( $appliedTo ) ) {
                foreach ( $appliedTo as $product ) {
                    if ( $product[ 'order_product_type' ] == $itemType && $product[ 'order_product_id' ] == $item[ 'id' ] ) {
                        $productDiscount += $product[ 'discount' ];
                    }
                }
            }

        }
        return $productDiscount;
    }
}
