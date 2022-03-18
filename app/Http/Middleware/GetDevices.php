<?php

namespace App\Http\Middleware;

use Closure;
use App\Support\Utilities\ApiConnect;
use App\Support\Responses\FlashAndRedirectResponse;

class GetDevices
{
    use ApiConnect;
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
        $accountSuspended  = session('account_suspended');
        if (session()->has('id') && $accountSuspended) {
            return $this->failRedirect('account','Account is suspended, pay past due or contact us.');
        } else {
            if (session('hash')) {
                $order = $this->requestConnection('order?order_hash='.session('hash')['order_hash'].'&paid_monthly_invoice='.session('paid_monthly_invoice'));
                if (count($order['order_groups'])) {
                    session(['cart' => $order]);
                    $activeId = session('cart')['active_group_id'];

                    foreach (session('cart')['order_groups'] as $cart) {
                        if ($activeId == $cart['id']) {
                            if ($cart['device'] == null && $cart['plan'] != null) {

                                $deviceData = $this->requestConnection('devices?plan_id='.$cart['plan']['id'].'&carrier_id='.$cart['plan']['carrier_id']);
                                session(['deviceData' => $deviceData]);

                            } elseif ($cart['device'] != null && $cart['plan'] == null) {
                                $planData = $this->requestConnection('plans?device_id='.$cart['device']['id']);
                                session(['planData' => $planData]);

                            } elseif ($cart['device'] != null && $cart['plan'] != null) {
                                $planData = $this->requestConnection('plans?device_id='.$cart['device']['id']);
                                session(['planData' => $planData]);

                            } else {
                                session()->forget(['deviceData', 'planData']);
                            }
                        } else {
                            session()->forget(['deviceData', 'planData']);

                        }
                    }
                } else {
                    session()->forget(['deviceData', 'planData']);

                }
            }
            if (session('cart')) {
                if (count(session('cart')['order_groups'])) {
                    foreach (session('cart')['order_groups'] as $cart) {

                        if ($cart['device'] === null && $cart['plan'] == null && $cart['sim'] == null) {
                            session()->forget('cart');
                        }
                    }
                }
            }
            return $next($request);
        }
    }
}
