<?php

namespace App\Http\Middleware;

use Closure;

class CheckoutDone
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
        if (!session('cart')) {
            return redirect()->action('HomeController@index');

        } elseif (!session('checkout_done')) {
            return redirect()->back()->with([ 'notification' => 
                [
                    'status'  => 'danger',
                    'message' => 'Please do checkout first',
                ]
            ]);
        }
        return $next($request);
    }
}
