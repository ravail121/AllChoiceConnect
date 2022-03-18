<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Support\DataProviders\StatesProvider;

/**
 * Class CustomerPlanController
 *
 * @package App\Http\Controllers
 */
class CustomerPlanController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function get()
    {
        $states   = $this->states();
        $customer     = $this->requestConnectionForCustomer('customer');
        $slug = array_column($customer['company']['carrier'], 'slug');
        $subcriptions = $this->requestConnectionForCustomer('customer-subscriptions');
        if($subcriptions === 'Failed'){
            $subcriptions = null;
            $usages = null;
        }else{
            $usages = $this->getUsages($subcriptions['customer-plans']);
            if($usages === 'Failed'){
                $usages = null;
            }
        }
        $daysUntilAutoPay = Carbon::today()->diffInDays(Carbon::parse($customer['billing_end'])->subDays(1));
        return view('customer.plan-details', compact('subcriptions', 'customer', 'states',
            'daysUntilAutoPay', 'usages', 'slug'));
    }

    /**
     * @param $id
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function compatiblePlans($id)
    {
        $data['subscription_id'] = $id;
        $data['customer_id']     = session('id');
        $customer     = $this->requestConnectionForCustomer('customer');
        $compatiblePlans = $this->requestConnection('compatible-plans', 'get', $data);
        if(is_string ($compatiblePlans[0])){
            return $this->failRedirect('/customer-plans', $compatiblePlans[0]);
        }


        return view('customer.compatible-plans', compact('compatiblePlans','customer','id'));
    }

    /**
     * @param Request $request
     *
     * @return \App\Support\Utilities\Collection
     */
    public function compatibleAddons(Request $request)
    {
        $data = $request->all();
        $compatibleAddons = $this->requestConnection('compatible-addons', 'get', $data);

        return $compatibleAddons;
    }

    /**
     * @return \App\Support\DataProviders\Collection
     */
    private function states()
    {
        return StatesProvider::data();
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function updatePort(Request $request)
    {
        $data =  $request->validate([
            'authorized_name'               => 'required|max:20',
            'address_line1'                 => 'required',
            'city'                          => 'required|max:20',
            'zip'                           => 'numeric|required',
            'state'                         => 'required',
            'number_to_port'                => 'numeric|required',
            'company_porting_from'          => 'required',
            'account_number_porting_from'   => 'required',
            'account_pin_porting_from'      => 'required',

        ]);
        $data['id'] = $request->id;
        $data['sim_card_number'] = $request->sim_card_number;
        $data['subscription_id'] = $request->subscription_id;
        $data['ssn_taxid'] = $request->ssn_taxid;
        $data['address_line2'] = $request->address_line2;
        $data['status'] = '1';

        $compatibleAddons = $this->requestConnection('update-port', 'post', $data);
        if($compatibleAddons[0] =='sucessfully Updated'){
            return $data;
        }
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function changePlan(Request $request)
    {
        $data = $request->all();
        $data['paid_monthly_invoice'] = session('paid_monthly_invoice');
        if(!empty(session('cart')['order_groups'])){
            return $this->successRedirect('checkout?order_hash='.session('hash')['order_hash'], 'Please Complete your new Order then change existing Plan');
        }
        session()->forget(['cart', 'hash', 'checkout_done', 'status', 'couponAmount', 'couponCode']);
        $order = $this->requestConnectionForCustomer('change-plan', 'post', $data);

        if($order['status'] =='upgrade'){
            session(['changePlanStatus' => 'Upgrade']);

            return $this->successRedirect('checkout?order_hash='.$order['hash'].'&change_plan='.$data['active_plans'], 'Please confirm your upgrade request');
        }elseif ($order['status'] =='sameplan') {
            session(['changePlanStatus' => 'sameplan']);

            return $this->successRedirect('checkout?order_hash='.$order['hash'].'&change_plan='.$data['active_plans'], 'Please confirm your request');
        }else{
            session(['changePlanStatus' => 'Downgrade']);
            return $this->successRedirect('checkout?order_hash='.$order['hash'].'&change_plan='.$data['active_plans'], 'Please confirm your Change Plan request');
        }
    }

    /**
     * @param Request $request
     *
     * @return \App\Support\Utilities\Collection
     */
    public function updateSubLabel(Request $request)
    {
        $data['id'] = $request->id;
        $data['label'] = $request->label;

        $responses = $this->requestConnection('update-sub-label', 'post', $data);

        return $responses;
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function checkNumber(Request $request)
    {
        $count = $this->requestConnectionForCustomer('check-number', 'get', [
            'number' => $request->number_to_port,
        ]);

        return ($count['count'] > 0 ) ? 'false' : 'true';
    }

    /**
     * Get Usage Data
     * @param $subscriptions
     *
     * @return array|\Illuminate\Support\Collection[]|\Psr\Http\Message\StreamInterface[]|string[]
     */
    private function getUsages($subscriptions)
    {
        $usages = [];
        $cycle_response = $this->requestUltraMobileConnection('cycles' , 'get');
        $current_cycle_id = null;
        foreach ($subscriptions as $subscription){
            $cycles = [];
            $subscription_id = (int)$subscription['id'];
            $current_cycle_id = null;
            if ($cycle_response!="Failed") {
                $subscription_start_date = Carbon::parse($subscription['activation_date']);
                $current_date_time = Carbon::now();
                $_cycle_data = $cycle_response['data'];
                $cycle_total = count($_cycle_data);
                for($i=0; $i < $cycle_total; $i++){
                    $start_date =Carbon::parse($_cycle_data[$i]['start_date']);
                    $end_date =Carbon::parse($_cycle_data[$i]['end_date']);
                    if($current_date_time->greaterThanOrEqualTo($start_date) && $current_date_time->lessThanOrEqualTo($end_date)){
                        $current_cycle_id = $_cycle_data[$i]['id'];
                    }
                    if($current_date_time->greaterThanOrEqualTo($start_date) && $end_date->greaterThanOrEqualTo($subscription_start_date))
                    {
                        $cycles[$_cycle_data[$i]['id']] = $start_date->format('Y-m-d') . " - " . $end_date->format('Y-m-d');
                        continue;
                    }
                    if($current_date_time->lessThan($end_date)){
                        break;
                    }
                }
            }
            $parameters = [
                'subscription_id'    => $subscription_id,
                'cycle_id'          => $current_cycle_id
            ];
            $usageData = $this->requestUltraMobileConnection('usages/' , 'post', $parameters);
            if(isset($usageData['success']) && $usageData['success']) {
                $usages[$subscription_id] = [
                    'data'      => $usageData['data']['data_log_callVolume'],
                    'voice'     => $usageData['data']['voice_log_callDuration'],
                    'text'      => $usageData['data']['phone_number_texts'],
                ];
            }
            $usages[$subscription_id]['current_cycle_id'] = $current_cycle_id;
            $usages[$subscription_id]['cycles' ]= $cycles;
        }
        return $usages;
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function downloadUsages(Request $request)
    {
        $url = bin2hex(implode(" ", $request->all()));
        return env('API_TOOL_URL').'/download-usages/'.$url;
    }

    /**
     * @param Request $request
     *
     * @return array|string
     */
    public function getUsagesData(Request $request)
    {
        $usageType = $request->get('usage_type');
        $offset  = $request->get('start');
        $limit  = $request->get('length');
        $parameters = [
            'subscription_id'   => (int) $request->get('subscription_id'),
            'cycle_id'          => (int) $request->get('cycle'),
        ];
        $usageData = $this->requestUltraMobileConnection('usages/', 'post', $parameters);
        $outputUsages = [];
        if ($usageData !== 'Failed' && isset($usageData['data'])) {
            $usages = $usageData['data']['usage'];
            foreach ($usages as $usage) {
                if ($usage[$usageType]) {
                    $outputUsages[] = (object)[
                        'date'      => Carbon::parse($usage['log_data'])->format('Y-m-d'),
                        'time'      => Carbon::parse($usage['log_data'])->format('H:i:s'),
                        $usageType  => number_format($usage[$usageType], 2)
                    ];
                }
            }
            $total_log = $usageData['data'];
            if ($usageType === 'text') {
                $summary_usage_total = $total_log['phone_number_texts'];
            } elseif ($usageType === 'voice') {
                $summary_usage_total = $total_log['voice_log_callDuration'];
            } elseif ($usageType === 'data') {
                $summary_usage_total = $total_log['data_log_callVolume'];
            } else {
                $summary_usage_total = 0;
            }
            $_outputUsages = array_slice($outputUsages,$offset, $limit);
            return [
                'data'              => $_outputUsages,
                'recordsTotal'      => count($outputUsages),
                'recordsFiltered'   => count($outputUsages),
                'total'             => $summary_usage_total
            ];
        } else {
            return 'Failed';
        }
    }

    /**
     * @param Request $request
     *
     * @return \App\Support\Utilities\Collection
     */
    public function changeSim(Request $request)
    {
        $data = $request->all();
        $data['customer_id'] = session('id');

        return $this->requestConnection('change-sim' , 'post', $data);
    }

    /**
     * Update Requested ZIP while getting new number
     * @param Request $request
     *
     * @return \App\Support\Utilities\Collection
     */
    public function updateRequestedZip(Request $request)
    {
        $data['id'] = $request->id;
        $data['requested_zip'] = $request->requested_zip;

        $response = $this->requestConnection('subscription/update-requested-zip', 'post', $data);

        return $response;

    }
}


