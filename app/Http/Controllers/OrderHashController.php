<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Api\ApiResponse;

class OrderHashController extends Controller
{

    /**
     * ApiResponse object
     * 
     * @var $api
     */
    protected $api;



    /**
     * Creating object
     * 
     * @param ApiResponse $apiResponse
     */
    public function __construct(ApiResponse $apiResponse)
    {
        $this->api  = $apiResponse;
    }


    /**
     * Fetches Plans with Sims, addons and areacode
     * 
     * @param  int $deviceId
     * @param  int $planId
     * @return Response
     */
    public function getPlanSims(Request $request)
    {
        $response = $this->api->checkPortingAndAreaCode($request);
        return $response;
    }


    public function insertDevice(Request $request)
    {
        if ($request->device_id != null) {
            if (!session('hash')) {
                $orderHash = $this->requestConnection('order', 'post', [
                    'device_id' => $request->device_id,
                    'paid_monthly_invoice' => session('paid_monthly_invoice'),
                ]);
                session(['hash' => $orderHash]);

            } else {
                $this->requestConnection('order', 'post', [
                    'device_id'  => $request->device_id,
                    'order_hash' => session('hash')['order_hash'],
                    'paid_monthly_invoice' => session('paid_monthly_invoice'),
                ]);

            }

            $this->requestConnection('order-group', 'put', [
                'action'     => 1,
                'order_hash' => session('hash')['order_hash'],
            ]);
            $order = $this->requestConnection('order?order_hash='.session('hash')['order_hash'].'&paid_monthly_invoice='.session('paid_monthly_invoice'));

            session(['cart' => $order]);

        } elseif ($request->sim_id != null) {
            if (!session('hash')) {
                $orderHash = $this->requestConnection('order', 'post', [
                    'sim_id' => $request->sim_id,
                    'paid_monthly_invoice' => session('paid_monthly_invoice'),
                ]);

     
                session(['hash' => $orderHash]);

            } else {
                $this->requestConnection('order', 'post', [
                    'sim_id'  => $request->sim_id,
                    'order_hash' => session('hash')['order_hash'],
                    'paid_monthly_invoice' => session('paid_monthly_invoice'),
                ]);

            }

            $this->requestConnection('order-group', 'put', [
                'action'     => 1,
                'order_hash' => session('hash')['order_hash'],
            ]);
            $order = $this->requestConnection('order?order_hash='.session('hash')['order_hash'].'&paid_monthly_invoice='.session('paid_monthly_invoice'));

            session(['cart' => $order]);

        }
        return $order;
    }



    /**
     * Fetch Plans
     * 
     * @param  int $id
     * @return Response
     */
    public function getPlans($id)
    {
        $res = $this->requestConnection('plans?device_id='.$id);
        return $res;
    }


    public function editCart(Request $request)
    {
        $data = $this->requestConnection('order-group/edit', 'post', ['order_group_id' => $request->order_group_id]);
        return $data;
    }



    /**
     * Re-sends Email for Business-verification
     * 
     * @return boolean
     */
    public function resendEmail()
    {
        $bizNotVerified = $this->requestConnection('biz-verification/resend-email?order_hash='.session('hash')['order_hash'], 'post');

        if (!isset($bizNotVerified['email'])) {
            return $this->failRedirect('verify-bussiness', 'Oops! Something went wrong. Please try again later');

        } else {
            return view('verify-bussiness.check-mail')->with([
                'email'   => $bizNotVerified['email'], 
                'message' => 'resend done', 
            ]);
        }

        return false;
    }

}
