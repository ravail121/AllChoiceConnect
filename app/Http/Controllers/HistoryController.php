<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Services\Api\ApiResponse;
use Carbon\Carbon;

class HistoryController extends Controller
{
    /**
     * Shows Customer Orders, invoices and billing-details
     *
     * @return View
     */
    public function get()
    {
        $invoices = $this->requestConnectionForCustomer('customer-current-invoice');
        $customer = $this->requestConnectionForCustomer('customer-orders');
        $url      = env('API_BASE_URL').'/invoice/download/'.$customer["company_id"].'?order_hash=';
        $invoiceUrl = env('API_BASE_URL').'/invoice/download/'.$customer["company_id"].'?invoice_hash=';
        $daysUntilAutoPay = Carbon::today()->diffInDays(Carbon::parse($customer['billing_end'])->subDays(1));
        $billingDetails = $this->sortDetails($customer);

        return view('customer.history', compact('customer', 'invoices', 'url', 'invoiceUrl','billingDetails', 'daysUntilAutoPay'));
    }



    /**
     * Sorts Customer's Billing Details
     *
     * @param  array    $customer
     * @return array    $billingDetails
     */
    private function sortDetails($customer)
    {
        $billingDetails = array_merge($customer['invoice'], $customer['credit_amount'], isset($customer['invoice']['invoice_item']) ? $customer['invoice']['invoice_item'] : []);

        usort($billingDetails, function ($a, $b) {
            return ($a["created_at"] <= $b["created_at"]) ? 1 : -1;
        });

        return $billingDetails;
    }

}
