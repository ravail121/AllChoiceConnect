<?php

namespace App\Http\Middleware;

use Closure;
use App\Support\Utilities\ApiConnect;
use App\Support\Responses\FlashAndRedirectResponse;

class CheckPlans
{
    use FlashAndRedirectResponse, ApiConnect;


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session('hash')) {

            $order = $this->requestConnection('order?order_hash='.session('hash')['order_hash'].'&paid_monthly_invoice='.session('paid_monthly_invoice'));

            if (count($order['order_groups'])) {
                session(['cart' => $order]);
            }
        }

        if (session('cart')) {
            $orderGroupId = isset(session('cart')['active_group_id']) ? session('cart')['active_group_id'] : null;
            if (isset(session('cart')['order_groups'])) {
                foreach (session('cart')['order_groups'] as $cart) {
                    if ($cart['id'] == $orderGroupId) {
                        if ($cart['device'] == null && $cart['plan'] == null) {

                            session(['deviceName' => 'Device']);
                            return $this->failRedirect('plans/create', 'Please select plans for your active <span class="add-color-price">'.session('deviceName').'</span>');

                        } elseif ($cart['device'] != null && $cart['plan'] == null) {

                            session(['deviceId'     => $cart['device']['id']]);
                            session(['deviceName'   => $cart['device']['name']]);
                            return $this->failRedirect('plans', 'Please select plans for your active <span class="add-color-price">'.session('deviceName').'</span>');

                        } elseif ($cart['device'] == null && $cart['plan'] != null) {
                            return $this->failRedirect('devices', 'Please select device for your active <span class="add-color-price">'.$cart['plan']['name'].'</span>');
                        }
                    }
                }
            }
        }

        return $next($request);
    }
}
