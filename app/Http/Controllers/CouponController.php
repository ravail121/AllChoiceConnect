<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class CouponController
 *
 * @package App\Http\Controllers
 */
class CouponController extends Controller
{

    /**
     * Coupon Classes
     */
    const COUPON_CLASS = [
        'APPLIES_TO_ALL'                => 1,
        'APPLIES_TO_SPECIFIC_TYPES'     => 2,
        'APPLIES_TO_SPECIFIC_PRODUCT'   => 3
    ];

    /**
     * Specific Types
     */
    const SPECIFIC_TYPES = [
        'PLAN'      =>  1,
        'DEVICE'    =>  2,
        'SIM'       =>  3,
        'ADDON'     =>  4
    ];

    /**
     * Sub Types
     */
    const SUB_TYPES = [
        'NOT_LIMITED'   => 0,
        'VOICE'         => 1,
        'DATA'          => 2,
        'WEARABLE'      => 3,
        'MEMBERSHIP'    => 4,
        'DIGITS'        => 5,
        'CLOUD'         => 6
    ];

    /**
     * Order Groups
     */
    const ORDER_GROUP = [
        'PLAN'      =>  'plan',
        'DEVICE'    =>  'device',
        'SIM'       =>  'sim',
        'ADDON'     =>  'addons'
    ];


    /**
     * @param Request $request
     *
     * @return \App\Support\Utilities\Collection|array|\Illuminate\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|int|mixed|null
     */
    public function get(Request $request)
    {
//        !$request->only_details && !$request->for_plans ? session()->forget([ 'couponAmount', 'couponCodes' ]) : null;
        $requestCode = $request->input('code');
        if ($requestCode || $request->for_plans) {
            $couponAmount = $this->requestConnection('coupon/add-coupon', 'post',
                [
                    'code'              => $requestCode,
                    'order_id'          => session('cart')['id'],
                    'customer_id'       => session('id'),
                    'only_details'      => $request->only_details ?: false,
                    'for_plans'         => $request->for_plans ?: false,
                    'data_for_plans'    => $request->data,
                ]
            );
        }
        if (!$request->only_details && !$request->for_plans) {
            if (!isset($couponAmount['error'])) {
                $couponCodes = session('couponCodes') ?: [];
                $couponAmounts = session('couponAmount') ?: [];

                if(!in_array($couponAmount['code'], $couponCodes, true)){
                    session()->push('couponCodes', $couponAmount['code']);
                }

                $couponAmountAlreadyExists = false;
                $tempCouponAmount = [];
                foreach($couponAmounts as $coupon){
                    if($coupon['code'] === $couponAmount['code']){
                        $couponAmountAlreadyExists = true;
                        $tempCouponAmount[] = $couponAmount;
                    } else {
                        $tempCouponAmount[] = $coupon;
                    }
                }
                if(!$couponAmountAlreadyExists){
                    session()->push('couponAmount', $couponAmount);
                } else {
                    session()->put('couponAmount', $tempCouponAmount);
                }

                return $couponAmount;
            } else {
                return ['error' => $couponAmount['error']];
            }
        }
        return $couponAmount ?? null;
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request)
    {
        $totalCouponAmount = getCouponTotal(session('couponAmount'));
        try {
            $requestCouponCode = $request->get( 'coupon_code' );
            $removeCoupon      = $this->requestConnection( 'coupon/remove-coupon', 'post', [
                'order_id'    => session( 'cart' )[ 'id' ],
                'coupon_code' => $request->input( 'coupon_code' )
            ] );
            $couponCodes       = session( 'couponCodes' ) ?: [];
            $couponAmounts     = session( 'couponAmount' ) ?: [];

            $filteredCouponCode = Arr::where( $couponCodes, function ( $value, $key ) use ( $requestCouponCode ) {
                return $value !== $requestCouponCode;
            } );
            $filteredCouponAmount = [];

            foreach ($couponAmounts as $couponAmount) {
                if($couponAmount['code'] !== $requestCouponCode) {
                    $filteredCouponAmount[] = $couponAmount;
                } else {
                    if(isset($couponAmount['total'])) {
                        $totalCouponAmount -= $couponAmount[ 'total' ];
                    }
                }
            }

            session()->put( 'couponCodes', $filteredCouponCode );
            session()->put( 'couponAmount', $filteredCouponAmount );
            return ['total' => number_format($totalCouponAmount, 2)];
        } catch(\Exception $e) {
            Log::info('Error on removing coupon: ' . $e->getMessage());
            return ['error', 'Coupon cant be removed', 'total' => $totalCouponAmount];

        }
    }

}
