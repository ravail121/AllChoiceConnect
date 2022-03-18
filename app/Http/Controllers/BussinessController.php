<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Cart\CartResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Customer\VerifyBussinessRequest;

class BussinessController extends Controller
{
    protected $cartItem;

    public function __construct(CartResponse $cartResponse)
    {
        $this->middleware('check.sessions');
        $this->middleware('check.plans');
        $this->cartItem = $cartResponse;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('cart') && session('cart')['company']) {
            if (session('cart')['company']['business_verification'] == 1 && !session('id')) {
                return view('verify-bussiness.index');

            } else {
                return redirect('checkout?order_hash='.session('cart')['order_hash']);

            }

        }
        return false;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $validation = $this->validator($request->all());

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $response = $this->postBusinessDocuments($request);
        // return $response;
        return $request->email;

        // if ($request['file']) {
        //     $this->postBusinessDocuments($request);
        //     return 'true';
        // } else {

        //     $this->postBusinessData($request);
        // }

        // return $this->successRedirect('verify-bussiness', 'Please click on the link which is mailed to you at <span class="text-primary">'.$request->email.'</span>');
        // return view('verify-bussiness.check-mail')->with(['email' => $request->email]);
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


    public function sendEmail(Request $request)
    {
        session()->forget(['cart', 'hash']);
        return view('verify-bussiness.check-mail')->with(['email' => $request->email]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = VerifyBussinessRequest::baseRules();

        return Validator::make($data, $rules);
    }

    // protected function postBusinessData($request)
    // {
    //     $this->requestConnection('biz-verification', 'post', [
    //         [
    //             'name'     => 'order_hash',
    //             'contents' => session('hash')['order_hash']
    //         ],
    //         [
    //             'name'     => 'fname',
    //             'contents' => $request->fname
    //         ],
    //         [
    //             'name'     => 'lname',
    //             'contents' => $request->lname
    //         ],
    //         [
    //             'name'     => 'email',
    //             'contents' => $request->email
    //         ],
    //         [
    //             'name'     => 'business_name',
    //             'contents' => $request->bussiness_name
    //         ],
    //         [
    //             'name'     => 'tax_id',
    //             'contents' => $request->tax_id
    //         ],
    //     ]);

    //     return true;
    // }

    protected function postBusinessDocuments($request)
    {

        if ($request->file('file')) {
            $filename = $request->file('file');
            foreach ($filename as $n => $file) {
                $data = $this->requestConnection('biz-verification', 'postWithFile', [
                    [
                        'name'     => 'order_hash',
                        'contents' => session('hash')['order_hash']
                    ],
                    [
                        'name'     => 'fname',
                        'contents' => $request->fname
                    ],
                    [
                        'name'     => 'lname',
                        'contents' => $request->lname
                    ],
                    [
                        'name'     => 'email',
                        'contents' => $request->email
                    ],
                    [
                        'name'     => 'business_name',
                        'contents' => $request->bussiness_name
                    ],
                    [
                        'name'     => 'tax_id',
                        'contents' => str_replace('-', '', $request->tax_id)
                    ],
                    [
                        'name'     => 'doc_file',
                        'contents' => File::get($file),
                        'filename' => $filename[$n]->getClientOriginalName(),
                    ],
                ]);
            }
            return $data;
        } else {

            $data = $this->requestConnection('biz-verification', 'post', [

                    'order_hash'    => session('hash')['order_hash'],
                    'fname'         => $request->fname,
                    'lname'         => $request->lname,
                    'email'         => $request->email,
                    'business_name' => $request->bussiness_name,
                    'tax_id'        => str_replace('-', '', $request->tax_id)

            ]);

            return $data;

        }
    }
}
