<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

abstract class VerifyBussinessRequest extends FormRequest
{
    protected static $rules = [
        'fname'          => 'required|string|max:255',
        'lname'          => 'required|string|max:255',
        'email'          => 'required|string|email|max:255',
        'bussiness_name' => 'required|string|max:255',
        //'tax_id'         => 'sometimes|string|max:255',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function baseRules()
    {

        $rules = self::$rules;
        // $rules['country_code'] .= "|in:{$countries->keys()->implode(',')}";

        return $rules;
    }
}
