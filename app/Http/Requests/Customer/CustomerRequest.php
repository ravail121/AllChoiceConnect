<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

abstract class CustomerRequest extends FormRequest
{
    protected static $rules = [
        'billing_fname'       => 'required',
        'billing_lname'       => 'required',
        'billing_address1'    => 'required|max:5000',
        'billing_address2'    => 'nullable|max:5000',
        'billing_city'        => 'required|max:50',
        'billing_state_id'    => 'required|string|max:2',
        'billing_zip'         => 'required|digits:5',
        'payment_card_no'     => 'required|min:12|max:19',
        'payment_card_holder' => 'required',
        'expires_mmyy'        => 'required',
        'payment_cvc'         => 'required|max:4',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function baseRules()
    {

        $rules = self::$rules;
        return $rules;
    }
}
