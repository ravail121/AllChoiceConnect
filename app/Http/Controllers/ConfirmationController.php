<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Cart\CartResponse;

class ConfirmationController extends Controller
{

    protected $cartItem;

    public function __construct(CartResponse $cartResponse)
    {
        $this->middleware('check.sessions')->except('store');
        $this->middleware('check.plans')->except('store');
        $this->middleware('checkout.confirmed')->except('store');
        $this->cartItem = $cartResponse;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalAmount    = session('total_price');
        $subtotalAmount = $this->cartItem->subTotalPrice();
        $activeGroupID  = $this->cartItem->getActiveGroupId();
        $monthlyCharges = $this->cartItem->calMonthlyCharge();
        $tax            = $this->cartItem->calTaxes();
        $regulatoryFees = $this->cartItem->calRegulatory();
        $discount       = session('couponAmount') ? getCouponTotal(session('couponAmount')) : 0;
        $shipping       = $this->cartItem->getShippingFee();

        $cart = session()->pull('cart');
        $url = env('API_BASE_URL').'/invoice/download/'.$cart['customer']['company_id'].'?order_hash='.session('hash')['order_hash'];

        session()->forget(['cart', 'checkout_done', 'hash', 'couponAmount', 'couponCodes', 'changePlanStatus', 'taxrate', 'new_customer', 'total_price', 'deviceData']);

        return view('confirmation', compact('cart', 'totalAmount', 'activeGroupID', 'monthlyCharges', 'url', 'tax', 'subtotalAmount', 'discount', 'regulatoryFees', 'shipping'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->select_devices) {
            return $this->successRedirect('devices', 'The <span style="color: #1ba4d6;">Device/Plan</span> was added successfully.');
        }
        if ($request->checkout) {

            if (session('cart')['business_verification'] != null) {
                return $this->successRedirect('checkout?order_hash='.session('hash')['order_hash'], 'The <span style="color: #1ba4d6;">Device/Plan</span> was added successfully.');

            } else {

                if (session('id')) {
                    return $this->successRedirect('checkout?order_hash='.session('hash')['order_hash'], 'The <span style="color: #1ba4d6;">Device/Plan</span> was added successfully.');

                }

                return $this->successRedirect('verify-bussiness', 'The <span style="color: #1ba4d6;">Device/Plan</span> was added successfully.');
            }

        }
        if ($request->select_plans) {
            return redirect()->route('plans.index')->with(['notification' => [
                'status' => 'success',
                'message' => 'The <span style="color: #1ba4d6;">Device/Plan</span> was added successfully.',
            ]]);
        }
        return false;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
