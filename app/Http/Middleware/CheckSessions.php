<?php

namespace App\Http\Middleware;

use Closure;
use App\Support\Responses\FlashAndRedirectResponse;

class CheckSessions
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
        if (!session('cart')) {
            return $this->failRedirect('devices', 'Please select devices first');

        } elseif (session('cart')) {
            if (session('cart')['order_groups'] == null) {
                return $this->failRedirect('devices', 'Please select devices first');
            }

        }
        return $next($request);
    }
}
