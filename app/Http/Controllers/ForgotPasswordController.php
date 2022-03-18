<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{

    /**
     * Hits forgot-password api to send mail to reset it
     * 
     * @param  Request  $request
     * @return View
     */
    public function password(Request $request)
    {
        $data = $request->validate([
            'identifier' => 'required'
        ]);
        
    	$response = $this->requestConnection('forgot-password', 'get', $data);

        if(isset($response[0])){
            return $this->failRedirect('/', $response[0]);
        }
        return $this->successRedirect('/', 'Please Check your mail and follow the instruction to reset password');
    }


    /**
     * Displays Reset Password Form
     * 
     * @param  Request  $request
     * @return View
     */
    public function resetPassword(Request $request)
    {
        $token = $request->token;
    	return view('customer.reset-password', compact('token'));
    }


    /**
     * Updates the newly set password
     * 
     * @param  Request    $request
     * @return Response
     */
    public function update(Request $request){
        $data = $request->validate([
	        'token'   	=> 'required',
	        'password'  => 'required|confirmed|min:6',
        ]);

        $response = $this->requestConnection('reset-password', 'get', $data);
        if(isset($response[0])){
            return $this->failRedirect('/', $response[0]);
        }
        return $this->successRedirect('/', 'Password reset sucessfully, please login with your new password');
    }
    
}