<?php

namespace App\Http\Middleware;

use Closure;

class NewCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session('id') && \Request::route()->getName() != 'confirmation.index' && isset(session('cart')['business_verification']) && session('cart')['business_verification'] != null || session()->has('new_customer') && !session('id')) {
            return redirect('checkout?verification_hash='.session('cart')['business_verification']['hash'].'&order_hash='.session('cart')['order_hash'])
                    ->with('error', 'Please enter your details to edit cart.');
        }
        return $next($request);
    }
}
