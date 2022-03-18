<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

/**
 * Class SignOnController
 *
 * @package App\Http\Controllers
 */
class SignOnController extends Controller
{

    /**
     * Sign-in user
     *
     * @param  Request   $request
     * @return Response
     */
    public function signOn(Request $request)
    {
        $data = $request->validate([
            'identifier' => 'required',
            'password'   => 'required',
        ]);
        $response = $this->signOnApi($data);

        if($response != ''){
            return redirect()->back()->with('login-status', $response);
        }

        return redirect()->route('account');
    }




    /**
     * Runs `sign-on` api and sets session
     *
     * @param  array   $data
     * @return string
     */
    protected function signOnApi($data)
    {
        $message = '';

        $customer = $this->requestConnection('sign-on', 'post', $data);

        if(!isset($customer['id'])){
            $message = 'Please Provide correct username & password' ;

        } else {
            session()->forget(['cart', 'hash', 'couponAmount', 'couponCodes', 'changePlanStatus', 'taxrate', 'new_customer']);
            $this->populateOrder($customer);
            session(['id' => $customer['id']]);
            session(['account_suspended' => $customer['account_suspended']]);
            session(['customer_hash' => $customer['hash']]);
            session(['paid_monthly_invoice' => $customer['paid_monthly_invoice']]);
        }

        return $message;

    }

    /**
     * @param Request $request
     *
     * @return \App\Support\Utilities\Collection
     */
    public function signOnWithoutRedirect(Request $request)
    {
        $data = $request->validate([
            'identifier' => 'required',
            'password'   => 'required',
        ]);
        $customer = $this->requestConnection('sign-on', 'post', $data);
        if(isset($customer['id'])){
            $this->populateOrder($customer);
        }

        session(['id' => $customer['id']]);
        session(['customer_hash' => $customer['hash']]);
        session(['new_customer' => 1]);
        session(['paid_monthly_invoice' => $customer['paid_monthly_invoice']]);
        return $customer;
    }

    /**
     * @param $IdHash
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signOnWithoutPassword($IdHash)
    {
        $decryptedId = pack("H*", $IdHash);
        session()->flush();
        $data = [
            'hash' => $decryptedId,
            'paid_monthly_invoice' => 1
        ];
        try {
            $customer = $this->requestConnection('customer', 'get', $data);
            if(!isset($customer['error'])){
                $this->populateOrder($customer);
                session(['id' => $customer['id']]);
                session(['account_suspended' => $customer['account_suspended']]);
                session(['customer_hash' => $customer['hash']]);
                session(['paid_monthly_invoice' => $customer['paid_monthly_invoice']]);
            }
        } catch (\Exception  $e){
            \Log::error('Error on the signOnWithoutPassword');
            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());
        }

        return redirect()->route('plans.details');

    }

    /**
     * Logs out the user
     *
     * @return Redirect
     */
    public function signOut()
    {
        session()->flush();
        return redirect('/');
    }

    /**
     * Populate Orders
     * @param $customer
     */
    protected function populateOrder($customer)
    {
        $order = $this->requestConnection('order?customer_id='.$customer['id'].'&paid_monthly_invoice='.$customer['paid_monthly_invoice']);
        if(isset($order['order_hash'])) {
            $orderHash['order_hash'] = $order['order_hash'];
            session(['hash' => $orderHash]);
        }
        if(count($order) > 0) {
            session(['cart' => $order]);

            if(isset($order['couponDetails'])) {
                session(['couponAmount' => $order['couponDetails']]);
                foreach($order['couponDetails'] as $coupon) {
                    $couponCodes = session('couponCodes') ?: [];
                    if(!isset($coupon['error']) && isset($coupon['code']) && !in_array($coupon['code'], $couponCodes, true)){
                        session()->push('couponCodes', $coupon['code']);
                    }
                }
            }
            if(isset($order['totalPrice'])) {
                session( [ 'total_price' => $order[ 'totalPrice' ] ] );
            }
            $stateId = session('tax_id');
            if(!$stateId) {
                if ( isset($order[ 'business_verification' ]) && isset( $order[ 'business_verification' ][ 'billing_state_id' ] ) ) {
                    session( [ 'tax_id' => $order[ 'business_verification' ][ 'billing_state_id' ] ] );
                } elseif ( isset($order[ 'customer' ]) && isset( $order[ 'customer' ][ 'billing_state_id' ] ) ) {
                    session( [ 'tax_id' => $order[ 'customer' ][ 'billing_state_id' ] ] );
                }
            }
            if($stateId) {
                $taxRate = $this->requestConnection( 'customer', 'get', $stateId );
                if ( ! session( 'taxrate' ) || session( 'taxrate' ) && isset( $taxRate[ 'tax_rate' ] ) && session( 'taxrate' ) != $taxRate[ 'tax_rate' ] ) {
                    $taxRate = $this->requestConnection( 'customer', 'get', $stateId );
                    session( [ 'taxrate' => $taxRate[ 'tax_rate' ] ?? 0 ] );
                }
            }
        }
    }
}
