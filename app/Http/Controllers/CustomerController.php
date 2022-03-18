<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Api\ApiResponse;
use App\Support\DataProviders\StatesProvider;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states   = $this->states();
        $customer = $this->requestConnectionForCustomer('customer');
        $currentYear = $this->currentYear();
        $daysUntilAutoPay = Carbon::today()->diffInDays(Carbon::parse($customer['billing_end'])->subDays(1));
        return view('customer.account', compact('customer','states','currentYear', 'daysUntilAutoPay'));
    }

    private function states()
    {
        return StatesProvider::data();
    }

    public function update(Request $request)
    {
        $data = $this->validateUpdate($request);

        if(isset($data['phone'])){
            $data['phone']= preg_replace('/[^\dxX]/', '', $data['phone']);
        }

        if(isset($data['alternate_phone'])){
            $data['alternate_phone'] = preg_replace('/[^\dxX]/', '', $data['alternate_phone']);
        }
        return $this->requestConnection('update-customer', 'post', $data);
    }

    public function proratedRemainingDays(Request $request)
    {

        $startDate      = Carbon::parse($request->start_date);
        $endDate        = Carbon::parse($request->end_date);
        $totalDays      = $startDate->diffInDays($endDate, false);
        $today          = Carbon::today();
        $remainingDays  = $today->diffInDays($endDate);
        return [
            'remaining_days'  =>  $remainingDays,
            'total_days'      =>  $totalDays
        ];
    }

    protected function validateUpdate($request)
    {
        $id   =  session('id');
        $data =  $request->validate([
            'fname'             => 'sometimes|required',
            'lname'             => 'sometimes|required',
            'email'             => 'sometimes|required',
            'billing_fname'     => 'sometimes|required',
            'billing_lname'     => 'sometimes|required',
            'billing_address1'  => 'sometimes|required',
            'billing_city'      => 'sometimes|required',
            'password'          => 'sometimes|required|min:6|confirmed',
            'old_password'      => 'sometimes|required',
            'shipping_address1' => 'sometimes|required',
            'shipping_fname'    => 'sometimes|required',
            'shipping_lname'    => 'sometimes|required',
            'shipping_city'     => 'sometimes|required',
            'shipping_zip'      => 'sometimes|required',
            'phone'             => 'sometimes|required',
            'pin'               => 'sometimes|required',
            'shipping_state_id' => 'sometimes|required',
            'billing_state_id'  => 'sometimes|required',
            'auto_pay'          => 'sometimes|required',
            'company_name'      => 'sometimes|required',
            'billing_zip'       => 'sometimes|required',
        ]);
        return $this->addAdditionalData($data, $request);
    }

    private function addAdditionalData($data,$request)
    {
        $additionalData = $request->all();
        if(array_key_exists("alternate_phone",$additionalData)){
            if($additionalData['alternate_phone'] == null){
                $data['alternate_phone']   = 'replace_with_null';
            }else{
                $data['alternate_phone']   = $additionalData['alternate_phone'];
            }
        }

        if(array_key_exists("billing_address2",$additionalData)){
            if($additionalData['billing_address2'] == null){
                $data['billing_address2']   = 'replace_with_null';
            }else{
                $data['billing_address2']   = $additionalData['billing_address2'];
            }
        }
        if(array_key_exists("shipping_address2",$additionalData)){
            if($additionalData['shipping_address2'] == null){
                $data['shipping_address2']   = 'replace_with_null';
            }else{
                $data['shipping_address2']   = $additionalData['shipping_address2'];
            }
        }
        $data['id']                = session('id');
        $data['hash']              = session('customer_hash');

        return $data;
    }

    public function email(Request $request)
    {
        $count = $this->requestConnectionForCustomer('check-email', 'get', [
            'newEmail' => $request->email,
        ]);
        return ($count['emailCount'] > 0 ) ? 'false' : 'true';
    }

    public function password(Request $request)
    {
        $password = $this->requestConnectionForCustomer('check-password', 'get', [
            'password' => $request->old_password,
        ]);
        return ($password['status'] == 1) ? 'false' : 'true';
    }

    public function currentYear()
    {
        $now  = Carbon::today();
        $year = $now->format('y');

        for ($i = 0; $i < 11; $i++, $year++) {
            $currentYear[$year] = $year;
        }

        return $currentYear;
    }

    public function makePayment(Request $request)
    {
        $data=$request->validate([
            'amount'            => 'required',
            'credit_card_id'    => 'required',
        ]);
        $data['customer_id'] = session('id');
        $data['without_order'] = true;
        $responses = $this->requestConnection('charge-card', 'post', $data);

        return $responses;
    }
}
