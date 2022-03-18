<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataProviderController extends Controller
{
    public function compose($view)
    {
        // if(session('verification_status')){
            $company = $compatiblePlans = $this->requestConnection('order/company', 'post');
            session(['verification_status' => $company['business_verification']]);
        // }
        $view->with('verificationStatus', session('verification_status'));
    }
}
