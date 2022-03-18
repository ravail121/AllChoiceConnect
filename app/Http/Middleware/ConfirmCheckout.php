<?php

namespace App\Http\Middleware;

use Closure;

class ConfirmCheckout
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
        // if (!session('checkout')) {
        //     return redirect()->back()->with(['notification' => [
        //         'status'  => 'danger',
        //         'message' => 'Please do checkout first',
        //     ]]);
        // }
        return $next($request);
    }
}
