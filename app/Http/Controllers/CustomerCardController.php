<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Services\Api\ApiResponse;

class CustomerCardController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data     = $this->validateData($request);
        $response = $this->validateMonth($data);
        if (isset($response)) {
            return $this->failRedirect('account', $response);
        }
        $data  = $this->addAdditionalData($data);
        $cards = $this->requestConnection('add-card', 'post', $data);

        if(isset($cards['success'])){
            return $this->successRedirect('account', 'New Card Added successfully.');
        }else if(isset($cards['message'])) {
            if (is_array($cards['message'])) {
                $cards['message'] = $cards['message'][0];
            }
            return $this->failRedirect('account', 'Card Declined Due to '.$cards['message']);
        }else{
            return $this->failRedirect('account', 'Card Declined Please  Try again after some time');
        }
    }

    protected function validateData($request)
    {
        $data=$request->validate([
            'payment_card_no'        => 'required|min:12|max:19',
            'month'                  => 'required',
            'year'                   => 'required',
            'payment_cvc'            => 'required|max:4',
            'payment_card_holder'    => 'required',
            'billing_address1'       => 'required',
            'billing_city'           => 'required',
            'billing_state_id'       => 'required',
            'billing_zip'            => 'required',
        ]);

        return $data;
    }

    private function addAdditionalData($data)
    {
        $data['api_key']       =  env('API_KEY');
        $data['customer_id']   =  session('id');
        $data['expires_mmyy']  =  [$data['month'], $data['year']];
        $data['expires_mmyy']  =  implode("/",$data['expires_mmyy']);
        $data['billing_fname'] =  "Test fname";
        $data['billing_lname'] =  "Test lname";

        return $data;
    }

    private function validateMonth($data)
    {
        $now   = new DateTime('now');
        $month = $now->format('m');
        $year  = $now->format('y');
        if ($year == $data['year'] && $data['month'] < $month) {
            return "New Card Can't be added due to Invalid Expiration Month";
        }
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'customer_credit_card_id'  => 'required'
        ]);
        return $this->requestConnectionForCustomer('remove-card', 'post', $data);
    }

    public function primaryCard(Request $request)
    {
        $data = $request->validate([
            'customer_credit_card_id'  => 'required'
        ]);
        return $this->requestConnectionForCustomer('primary-card', 'post', $data);
    }
}
