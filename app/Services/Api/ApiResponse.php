<?php

namespace App\Services\Api;

use App\Services\Cart\CartResponse;
use App\Support\Utilities\ApiConnect;

class ApiResponse
{
    use ApiConnect;


    /**
     * Model Binding
     * 
     * @param CartResponse $cartResponse
     */
    public function __construct(CartResponse $cartResponse)
    {
        $this->cartItem = $cartResponse;
    }



    /**
     * This function if particular plan supports porting and area code
     * 
     * @param  integer       $deviceId
     * @param  integer       $planId   
     * @return array
     */
    public function checkPortingAndAreaCode($request)
    {
        $plan = $this->plansWithSimsAndAddons($request->planId, $request->plan_type);

        // $plan['porting'] = $this->requestConnection('porting/check?plan_id='.$request->planId.'&order_hash='.session('hash')['order_hash']);

        // $plan['area_code'] = $this->requestConnection('plans/check-area-code?plan_id='.$request->planId.'&order_hash='.session('hash')['order_hash']);
        $plan['device_id'] = $request->deviceId;
        $plan['plan_id'] = $request->planId;
        
        return $plan;
    }



    /**
     * This function returns Data of Sims & addons of particular plan
     * 
     * @param  array       $plans
     * @return array
     */
    public function plansWithSimsAndAddons($planId, $planType)
    {
        if (!session('hash')) {
            $data = $this->requestConnection('order', 'post');
            session(['hash' => $data]);

        } 
        // else {
        //     if (session('cart')) {
        //         $this->requestConnection('order', 'post', [
        //             'plan_id'     => $planId,
        //             'order_hash' => session('hash')['order_hash']
        //         ]);

        //     }

        // }
             

        $imei = $this->requestConnection('default-imei', 'get', [
            'api_key'   => env('API_KEY'),
            'plan_type' => $planType,
        ]);
        $plan['default_imei'] = $imei;


        $plan['sims'] = $this->requestConnection('sims?plan_id='.$planId.'&order_hash='.session('hash')['order_hash']);
        $plan['addons'] = $this->requestConnection('addons?plan_id='.$planId.'&order_hash='.session('hash')['order_hash']);

        return $plan;
    }
}