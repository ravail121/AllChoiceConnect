<?php

namespace App\Http\Middleware;

use Closure;
use App\Support\Responses\FlashAndRedirectResponse;

class CheckChangePlanCart
{
    use FlashAndRedirectResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = $request->path();

        if(session('changePlanStatus')){
            if(substr($path ,0,7) == "remove/"){
                session()->forget(['changePlanStatus']);

            }else if(!($path == 'checkout' || $path == 'confirmation' || $path == 'checkout/insert'|| $path == 'prorated-days' || $path == 'coupon/check' || $path == 'coupon/remove' || $path == 'sign-out')){
                 return $this->successRedirect('checkout?order_hash='.session('hash')['order_hash'], 'Please Complete your Change plan request then Place new Order');
                // session()->forget(['cart', 'hash', 'checkout_done', 'changePlanStatus', 'couponAmount', 'couponCode']);
            }
        }
        return $next($request);
    }
}
