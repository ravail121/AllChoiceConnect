<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceDataProviderController extends Controller
{
    public function compose($view)
    {
    	$invoices = $this->requestConnectionForCustomer('customer-current-invoice');
	    $cards    = $this->requestConnectionForCustomer('customer-cards', 'get', [
	        'api_key' => env('API_KEY'),
	    ]);
        $nextPrimary = $cards->where('default', '0')->last();
        
        $view->with('customercard', $cards->sortByDesc('default')->pluck('info', 'id'));
        $view->with('invoices', $invoices);
        $view->with('cards', $cards);
        $view->with('nextPrimary', $nextPrimary);
    }
}
