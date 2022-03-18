<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleInvoiceController extends Controller
{
    public function getInvoice()
    {
    	$invoiceUrl   = env('API_BASE_URL').'/sample-invoice';
    	$statementUrl = env('API_BASE_URL').'/sample-statement-invoice';
        return view('test-invoice', compact( 'invoiceUrl', 'statementUrl'));
    }

}
