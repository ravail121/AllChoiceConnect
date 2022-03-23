<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;
use App\Services\Cart\CartResponse;

class CartComposer
{
    protected $cart;

    public function __construct(CartResponse $response)
    {
        $this->cart = $response;
    }

    public function compose(View $view)
    {
        $view->with([
            'totalPrice'    => session('cart')['totalPrice'],
            'subtotalPrice' => session('cart')['subtotalPrice'],
            'activeGroupId' => session('cart')['activeGroupId'],
            'monthlyCharge' => session('cart')['monthlyCharge'],
            'taxes'         => session('cart')['taxes'],
            'regulatory'    => session('cart')['regulatory'],
            'shippingFee'   => session('cart')['shippingFee'],
            'coupons'       => isset($this->cart->coupon()['total']) ? $this->cart->coupon()['total'] : 0,
        ]);

    }

}
