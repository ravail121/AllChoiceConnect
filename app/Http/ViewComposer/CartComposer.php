<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;
use App\Services\Cart\CartResponse;

class CartComposer
{
    protected $cart;
    static $cartData;

    public function __construct(CartResponse $response)
    {
        $this->cart = $response;
    }

    public function compose(View $view)
    {
        if(static::$cartData)
        {
            return $view->with(static::$cartData);
        }

        static::$cartData = [
            'totalPrice'    => $this->cart->totalPrice(),
            'subtotalPrice' => $this->cart->subTotalPrice(),
            'activeGroupId' => $this->cart->getActiveGroupId(),
            'monthlyCharge' => $this->cart->calMonthlyCharge(),
            'taxes'         => $this->cart->calTaxes(),
            'regulatory'    => $this->cart->calRegulatory(),
            'shippingFee'   => $this->cart->getShippingFee(),
            'coupons'       => isset($this->cart->coupon()['total']) ? $this->cart->coupon()['total'] : 0,
        ];

         //dd(static::$cartData);

        $view->with(static::$cartData);
    }

}
