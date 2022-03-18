<div class="checkout-item-con">
    <strong>Selected Items</strong>

	<ul class="cart-list">
		@if(session('cart'))
			@foreach(session('cart')['order_groups'] as $cart)
				<li style="background-color: {{ ($activeGroupId == $cart['id']) ? '#fff8d3' : '' }};">
                    @if ($cart['device'] != null)
                        <div class="img-wrap">
                            <img src="{{ $cart['device']['primary_image'] ?: asset('imgs/placeholders/default.png') }}" alt="">
                        </div>
                    @elseif ($cart['sim'] != null)
                        @if($cart['plan'] == null)
                            <div class="img-wrap" style="height: auto;">
                                <img src="{{ $cart['sim']['image'] ?: asset('imgs/placeholders/default-sim.png') }}" alt="">
                            </div>
                        @endif
                    @endif
                    <div class="info {{ ($cart['device'] === 0 || ($cart['device'] === null && $cart['plan'] != null)) ? 'override-width' : ''}}">
                        <table>
                            <tr>
                                @if($cart['device'] != null)
                                    <td style='text-align:left'>Device:  <a href="javascript:void;route('devices.index')"  class="item-title modify-device" {{-- data-order_group_id="{{ f$cart['id'] }}" data-active_group_id="{{ $activeGroupId }}" data-device_id="{{ $cart['device']['id'] }}" --}}>{{ $cart['device']['name'] }}{{-- <span class="tooltiptext">Edit Device</span> --}}</a></td>

                                    <td style='text-align:right'> $
                                        @if ($cart['plan'] == null)
                                            @if ($activeGroupId == $cart['id'])
                                                @convert($cart['device']['amount_w_plan'])
                                            @else
                                                @convert($cart['device']['amount'])
                                            @endif
                                        @else
                                            @convert($cart['device']['amount_w_plan'])
                                        @endif
                                    </td>
                                @elseif ($cart['device'] === 0)
                                    <td style='text-align:left'>{{-- Device:  --}}<a href="javascript:void;" class="item-title">Bringing Own Device</a></td>
                                    <td style='text-align:right'>--</td>

                                {{-- @elseif ($cart['device'] === null)
                                    <td>Device: N/A</td>
                                    <td>--</td> --}}
                                @endif
                            </tr>
                            <tr>
                                @isset($cart['plan'])
                                    <td style='text-align:left'>{{-- Plan: --}}
                                        @if($cart['subscription'] != null)
                                            @if($cart['status'] =="SamePlan")
                                                New Addon Added to
                                            @else
                                                {{ App\Http\Traits\FormattingTrait::phoneNumberFormatted(($cart['subscription']['phone_number'])) }}
                                                {{ $cart['status'] }}  to
                                            @endif
                                        @endif
                                        <a href="javascript:void;" class="item-title modify-plan"{{--  data-type="plan" data-active_group_id="{{ $activeGroupId }}" data-order_group_id="{{ $cart['id'] }}" --}}>
                                            {{  $cart['plan']['name'] }}
                                        {{-- <span class="tooltiptext">Edit Plan</span> --}}</a>
                                        @if (session('cart')['customer'] != null && $cart['plan_prorated_amt'] != null)

                                            @if($cart['subscription'] == null)
                                                <p style="font-size: 12px;">prorated through {{ dateFormat(session('cart')['customer']['billing_end']) }} </p>
                                                <p>then $@convert($cart['plan']['amount_recurring'])/mo
                                                    <span data-amount_recurring="{{ $cart['plan']['amount_recurring'] }}" data-prorated="{{ $cart['plan_prorated_amt'] }}" class="tooltips tooltip-prorated" tooltip="" tooltip-position="bottom" style='background:transparent; border:transparent; color:#1ba4d6'>
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </span>
                                                </p>
                                            @elseif($cart['status'] != 'Downgrade')
                                                <p style="font-size: 12px;"> {{ dateFormat($cart['plan']['from']  )}} through {{ dateFormat($cart['plan']['to']  )}} </p>
                                                <p>then $@convert($cart['plan']['amount_recurring'])/mo</p>
                                            @endif
                                        @elseif(isset($cart['plan']['auto_generated_plans']))
                                            <p style="font-size: 12px;">Next month Charges</p>
                                        @endif
                                    </td>
                                    <td style='text-align:right'> $
                                        @if ($cart['plan_prorated_amt'] != null)
                                            @convert($cart['plan_prorated_amt'])
                                        @else
                                            @convert($cart['plan']['amount_recurring'])/mo
                                        @endif
                                    </td>

                                @endisset
                            </tr>
                            @if($cart['sim'] != null)
                                @if($cart['plan'] != null)
                                    <tr>
                                        <td style='text-align:left'><a href="javascript:void;" class="item-title">{{-- Sim Card: --}} {{ $cart['sim']['name'] }}</a></td>
                                        <td style='text-align:right'>$
                                            @convert($cart['sim']['amount_w_plan'])

                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td style='text-align:left'><a href="javascript:void;" class="item-title">{{-- Sim Card:  --}}{{ $cart['sim']['name'] }}</a></td>
                                        <td style='text-align:right'>$
                                            @convert($cart['sim']['amount_alone'])

                                        </td>
                                    </tr>

                                @endif
                            @elseif ($cart['sim_num'] != null)
                                <tr>
                                   {{--  <td>Sim Number: <a href="#" class="item-title modify-sim" data-type="sim" data-active_group_id="{{ $activeGroupId }}" data-order_group_id="{{ $cart['id'] }}">{{ $cart['sim_num'] }}<span class="tooltiptext">Edit Number</span></a></td> --}}
                                    <td style='text-align:left'><a href="javascript:void;" class="item-title modify-sim">{{ $cart['sim_type'] }}</a><p class='sim_num_{{$cart["id"]}}' style="font-size: 12px">SIM: {{ $cart['sim_num'] }}</p></td>
                                    <td style='text-align:right'>--</td>
                                </tr>
                            @endif

                            @if($cart['addons'])
                                @foreach ($cart['addons'] as $addon)
                                    <tr style='white-space: nowrap;'>
                                        <td style='text-align:left'>{{-- {{ $loop->iteration }} Add-On: --}}
                                            @if($addon['subscription_addon_id']!= null)
                                            Remove
                                            <a href="javascript:void;" class="item-title modify-addon" {{-- data-type="addon" data-active_group_id="{{ $activeGroupId }}" data-order_group_id="{{ $cart['id'] }}" --}}>{{ $addon['name'] }}{{-- <span class="tooltiptext">Edit Addon</span> --}}</a>
                                            @elseif (session('cart')['customer'] != null && $addon['prorated_amt'] != null)
                                                <a href="javascript:void;" class="item-title modify-addon">{{ $addon['name'] }}</a>
                                                <p style="font-size: 12px;">prorated through {{ dateFormat(session('cart')['customer']['billing_end']) }}</p> <p>then $@convert($addon['amount_recurring'])/mo</p>
                                            @else
                                            <a href="javascript:void;" class="item-title modify-addon">{{ $addon['name'] }}</a>
                                            @endif
                                        </td>
                                        <td style='text-align:right'>$
                                            @if ($addon['prorated_amt'] != null)
                                                @convert($addon['prorated_amt'])
                                            @else
                                                @convert($addon['amount_recurring'])/mo
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            @isset($cart['plan'])
                                @if ($cart['plan']['amount_onetime'] > 0)
                                    <td style='text-align:left'>
                                        <a href="javascript:void;" class="item-title">
                                            Activation Fee
                                        </a>
                                    </td>
                                    <td style='text-align:right'>$ @convert($cart['plan']['amount_onetime'] )</td>
                                @endif
                            @endisset
                        </table>
                    </div>
                    <div class="clearfix"></div>

                    <div class="btn-set-action">
                        {{-- <div class="text-right">
                            @if (array_key_exists('plan', $cart) && array_key_exists('sim', $cart) && array_key_exists('add-om', $cart))
                                <a href="{{ route('devices.index') }}">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </a>
                            @endif
                        </div> --}}

                        {{-- <div class="text-left">
                            <a href="{{ route('cart.destroy', $cart['id']) }}" data-method="delete" data-token="{{ csrf_token() }}" data-confirm="Are you sure?">

                                <i class="fa fa-trash-alt"></i>
                                Remove
                            </a>
                        </div> --}}

                        @if (!isset($cart['plan']['auto_generated_plans']))
                            <div class="text-center">
                                @if (session('id') || session('id') || isset(session('cart')['business_verification']) && session('cart')['business_verification'] == null)
                                    <a href="{{ route('cart.destroy', $cart['id']) }}" data-method="delete" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class='remove-cartItem'>

                                        <i class="fa fa-trash-alt"></i>
                                        Remove
                                    </a>
                                @endif
                                @if (!session('id') && isset(session('cart')['business_verification']) && session('cart')['business_verification'] != null)
                                    <a style='cursor:pointer' onclick="swal('Please enter your details to edit cart.')" class='remove-dummy'>

                                        <i class="fa fa-trash-alt"></i>
                                        Remove
                                    </a>
                                @endif
                                @if (isset($cart['plan']) && $cart['sim_num'])
                                <a data-toggle="modal" data-target="#simEditModal" class='edit-sim' data-internalid-{{$cart['id']}}="{{$cart['sim_num']}}" data-id="{{$cart['id']}}" data-carrier-id-{{$cart['id']}}="{{ $cart['plan']['carrier_id'] }}">

                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </li>
			@endforeach
		@endif
	</ul>

	<div class="summary">
        <table>
            <tr>
                <td>Subtotal:</td>
                <td>$
                    <span class='cart-subtotal'>
                        @if(isset($subtotalPrice) && $subtotalPrice)
                            @convert($subtotalPrice)
                        @else
                            0
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td>Coupons
                    <span class="cart-coupon-wrapper">
                        @if(session('couponAmount') && session('couponCodes'))
                            @foreach (session('couponAmount') as $coupon)
                                @if(in_array($coupon['code'], session('couponCodes')))
                                    <span class="coupon-code-cart-wrapper" id="coupon-code-cart-wrapper-{{ $coupon['code'] }}">
                                        <b class='coupon-code-cart'>{{ $coupon['code'] }}</b>
                                        <span class="tooltips tooltip-coupon" tooltip="{{ $coupon['coupon_amount_details']['details'] }}" tooltip-position="bottom" class="footer-mobile-coupon-code-tooltip">
                                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                                        </span>
                                    </span>
                                @endif
                            @endforeach
                        @else
                            <span class="tooltips tooltip-coupon no-coupon-applied" tooltip="No coupon applied" tooltip-position="bottom" class="footer-mobile-coupon-code-tooltip">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                            </span>
                        @endif
                    </span>
                </td>
                {{-- <ul class='cart-list'>
                        <li>
                            <div class="btn-set-action">
                                <div class="text-center">                                                                                        </div>
                            </div>
                        </li>
                    </ul> --}}
                <td>- $
                    <span class='coupon-amount-cart' id='couponAmount'>
                        @if(session('couponAmount'))
                            @convert(getCouponTotal(session('couponAmount')))
                        @else
                            0
                        @endisset
                    </span>
                </td>
            </tr>
            <tr>
                <td>Shipping Fee:</td>
                <td>+ $
                    <span class='cart-shipping'>
                        @if(isset($shippingFee) && $shippingFee)
                            @convert($shippingFee)
                        @else
                            0
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td>State Tax:</td>
                <td>+ $
                    <span class='tax-cart'>
                        @if(isset($taxes) && $taxes)
                            @convert($taxes)
                        @else
                            0
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td>Regulatory Fee:</td>
                <td>+ $
                    <span class='cart-regulatory'>
                        @if(isset($regulatory) && $regulatory)
                            @convert($regulatory)
                        @else
                            0
                        @endif
                    </span>
                </td>
            </tr>
        </table>
    </div>


    <div class="total">
        <table>
            <tr>
                <td><strong>Total Due Today</strong></td>
                <td><strong>$
                        <span class='total-due-cart'>
                            @if(isset($totalPrice) && $totalPrice)
                                @convert($totalPrice)
                            @else
                                0
                            @endif
                        </span>
                    </strong>
                </td>
            </tr>
            <tr>
                <td>Monthly Charge</td>
                <td>$
                    @if(isset($monthlyCharge) && $monthlyCharge)
                        @convert($monthlyCharge)
                    @else
                        0
                    @endisset
                </td>
            </tr>
        </table>
    </div>
</div>

