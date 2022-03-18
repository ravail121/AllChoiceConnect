{!! Form::open(['route' => 'checkout.store', 'class' => 'customer-billing-form']) !!}
    {{--@if (session('id'))
        <div class="panel-group d-none" id="accordion" role="tablist" aria-multiselectable="true">
    @else--}}
    <div class="panel-group" id="accordionTwo" role="tablist" aria-multiselectable="true">
   {{-- @endif --}}
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title" id='panel-tile-2'>
                    <a class="collapse-trigger" role="button" id='trigger-2' data-toggle="collapse"  href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" id='collapse-2-trigger'>
                        <span>2.</span> Billing Info
                    </a>
                    <ul class="pull-right d-flex vertical-align flex-content-center">
                        @if (!session('id'))
                            @if (isset(session('cart')['customer']['billing_state_id']) && session('cart')['customer']['billing_state_id'] != 'N/A')
                                <li>
                                    <i class="fa fa-check f16"></i>
                                </li>
                                <li>
                                    <a href="#" class="t-violet-2"><i id='collapse-button-2' class="fa f16 caret-btn fa-caret-right"></i></a>
                                </li>
                            @endif
                        @else
                            @if (isset(session('cart')['business_verification']['billing_state_id']) && session('cart')['business_verification']['billing_state_id'] != 'N/A')
                                @if (session('new_customer'))
                                    <li><i class="fa fa-check f16"></i></li>
                                @endif
                                <li>
                                    <a href="#" class="t-violet-2"><i id='collapse-button-2' class="fa f16 caret-btn fa-caret-right"></i></a>
                                </li>
                            @endif
                        @endif
                        @if (session('id') && session('new_customer') && !isset(session('cart')['business_verification']['billing_state_id']))
                            <li><a href="#" class="f16"><i class="fa fa-pencil customer-info-edit"></i></a></li>
                        @endif
                    </ul>
                </h4>
            </div>
            @if (session('id'))
                @if (session('cart')['business_verification']['billing_state_id'])
                    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                @else
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                @endif
            @else
            <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
            @endif
                <div class="panel-body billing-fields">
                    <div class="row">
                        <div class="col-xs-12">
                            <h6 class="text-left bold f14 t-black-1 add-bottom-3">Billing Information</h6>

                            <div class="form-check add-bottom-3">

                                {!! Form::checkbox('exampleCheckbox', 'option1', false, ['class' => 'form-check-input', 'id' => 'exampleCheckbox1']) !!}

                                {!! Form::label('exampleCheckbox1', 'Use my shipping address for my billing address', ['class' => 'form-check-label']) !!}
                            </div>

                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Html::decode(Form::label('billing-fname', 'First Name<span class="text-danger"> *</span>')) !!}

                                {!! Form::text('billing_fname', null, ['class' => 'form-control customer-info', 'id' => 'billing-fname']) !!}

                                <small class="form-text text-muted text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Html::decode(Form::label('billing-lname', 'Last Name<span class="text-danger"> *</span>')) !!}

                                {!! Form::text('billing_lname', null, ['class' => 'form-control customer-info', 'id' => 'billing-lname']) !!}

                                <small class="form-text text-muted text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Html::decode(Form::label('billing-address1', 'Address 1<span class="text-danger"> *</span>')) !!}

                                {!! Form::text('billing_address1', null,['class' => 'form-control customer-info', 'id' => 'billing-address1']) !!}

                                <small class="form-text text-muted text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('billing-address2', 'Address 2') !!}
                                {!! Form::text('billing_address2', null,['class' => 'form-control customer-info', 'id' => 'billing-address2']) !!}

                                <small class="form-text text-muted text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Html::decode(Form::label('billing-city', 'City<span class="text-danger"> *</span>')) !!}

                                {!! Form::text('billing_city', null,['class' => 'form-control customer-info', 'id' => 'billing-city']) !!}
                                {{-- <select class="form-control" id="payment-city" name="payment-city">
                                    <option value="0">-- select city --</option>
                                </select> --}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">

                                {!! Html::decode(Form::label('billing-state', 'State<span class="text-danger"> *</span>')) !!}

                                {!! Form::select('billing_state_id', $states, null, ['class' => 'form-control', 'id' => 'billing-state', 'placeholder' => '--Select Your State--']) !!}

                                {{-- <select class="form-control" id="payment-state" name="payment-state">
                                    <option value="0">-- select state --</option>
                                </select> --}}
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Html::decode(Form::label('billing-zip', 'Zip<span class="text-danger"> *</span>')) !!}
                                {!! Form::text('billing_zip', null,['class' => 'form-control', 'id' => 'billing-zip']) !!}

                                <small class="form-text text-muted text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <button type='button' id='save-tax' class='add-top-2 btn style2 add-bottom-2'>
                        @if (isset(session('cart')['customer']['billing_state_id']) && session('cart')['customer']['billing_state_id'] || isset(session('cart')['business_verification']['billing_state_id']) && session('cart')['business_verification']['billing_state_id'])
                            Update
                        @else
                            Save & Continue
                        @endif
                    </button>


                    {{-- <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <h6 class="text-left bold f14 t-black-1 add-bottom-3">Never Miss A Payment</h6>
                            <div class="form-check add-bottom-3">
                                {!! Form::checkbox('exampleCheckbox2', 'option2', false, ['class' => 'form-check-input', 'id' => 'exampleCheckbox2']) !!}


                                {!! Form::label('exampleCheckbox2', 'Enroll in Auto Pay', ['class' => 'form-check-label t-black-1']) !!}

                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <h6 class="text-left bold f14 t-black-1 add-bottom-3">Discount Code</h6>
                            <div class="input-group">
                                {!! Form::text('coupon', null, ['class' => 'form-control', 'id' => 'coupon']) !!}

                                <span class="input-group-btn">
                                    {!! Form::button('Apply', ['class' => 'btn style1']) !!}

                                </span>
                            </div><!-- /input-group -->
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-xs-12 hide-this-con">
                @include('checkout.cart._cart')
            </div>

        </div>
    </div>

    <div class="panel-group" id="accordionThree" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title" id = 'panel-tile-3'>
                    <a role="button" class="collapse-trigger" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <span>3.</span> Payment Info
                    </a>
                    <ul class="pull-right d-flex vertical-align flex-content-center three-controls">
                        @if (!session('id'))
                            @if (session('new_customer'))
                                @if (isset(session('cart')['customer']['billing_state_id']) && session('cart')['customer']['billing_state_id'] != 'N/A' )
                                    <li>
                                        <a href="#" class="f16"><i class="fa fa-pencil customer-info-edit"></i></a>
                                    </li>
                                @endif
                                @if (isset(session('cart')['customer']['billing_state_id']) && session('cart')['customer']['billing_state_id'] != 'N/A' && !session('new_customer'))
                                    <li>
                                        <a href="#" class="t-violet-2"><i id='collapse-button-3' class="fa f16 caret-btn fa-caret-right"></i></a>
                                    </li>
                                @endif
                            @endif
                        @endif
                    </ul>
                </h4>
            </div>
                @if (!session('id') || session('new_customer'))
                    @if (isset(session('cart')['customer']['billing_state_id']) && session('cart')['customer']['billing_state_id'] != 'N/A')
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    @else
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                    @endif
                @else
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                @endif
                @if (session('id'))
                    <div class="panel-body">
                        {{-- @if (!session('changePlanStatus')) --}}
                        @if (session('id'))
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <h6 class="text-left bold f14 t-black-1 add-bottom-2">Apply Coupon</h6>
                                    <div class="input-group add-bottom-3 mt-20">
                                        {!! Form::text('coupon', null, ['class' => 'form-control', 'id' => 'coupon']) !!}
                                        <span id='coupon-buttons' class="input-group-btn c-buttons">
                                            {!! Form::button('Apply', ['class' => 'btn style1', 'id' => 'coupon-apply']) !!}
                                        </span>
                                    </div>
                                    <div id='coupon-list-message' class="add-bottom-3 mt-20">
                                        @if (session('couponCodes'))
                                            @foreach(session('couponCodes') as $couponCode)
                                                <div class="coupon-code-text-wrapper text-left mb-5">
                                                    <div class="coupon-code-cart">
                                                        {{ $couponCode }}
                                                        <a class="remove-coupon-button cursor-pointer" title="Remove coupon {{ $couponCode }}">
                                                            <i class="fa fa-trash remove-coupon" aria-hidden="true" data-coupon-id="{{ $couponCode }}"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- @endif --}}
                        @isset ($customerCards)
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <h4 class="text-left bold f14 t-black-1 add-bottom-2">Select Card</h4>

                                </div>
                            </div>
                            @foreach ($customerCards as $card)
                                <div class="form-check add-bottom-3">
                                    {!! Form::radio('customer_card', $card['id'], ($loop->first) ? true : false, ['class' => 'form-check-input', 'id' => 'card-'.$loop->index]) !!}

                                    {!! Form::label('card-'.$loop->index, $card['card_type'].' ending with '.$card['last4'], ['class' => 'form-check-label']) !!}
                                </div>
                            @endforeach
                            <div class="form-check add-bottom-3 {{ session('new_customer') || !count($customerCards) ? 'd-none' : '' }}">
                                {!! Form::radio('customer_card', null, session('new_customer') || !count($customerCards) ?: false, ['class' => 'form-check-input', 'id' => 'new-card']) !!}

                                {!! Form::label('new-card', 'Use New Card', ['class' => 'form-check-label', 'id' => 'new-card-label']) !!}
                            </div>
                        @endisset

                        @if (session('id'))
                            <div class='payment-fields d-none'>
                        @else
                            <div class='payment-fields'>
                        @endif
                        <div class="form-check add-bottom-3">

                            {!! Form::checkbox('auto_pay',1, true, ['class' => '', 'id' => 'auto_pay']) !!}

                            {!! Form::label('auto_pay', 'Enable Autopay', ['class' => 'form-check-label']) !!}

                        </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="payment-card-no" class="d-block">
                                            Credit Card No.<span class="text-danger"> *</span>
                                            {{-- <span class="t-gray-2 f12 bold pull-right">Pay with Visa, Mastercard, Maestro &amp; Amex</span> --}}
                                            <img  class="pull-right padding-b-5" src="{{ asset('theme/images/visa-card-icon-10.jpg') }}">
                                        </label>

                                        {!! Form::text('payment_card_no', null, ['class' => 'form-control', 'id' => 'payment-card-no', 'autocomplete' => 'off']) !!}

                                        <small class="form-text text-muted text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('payment-card-holder', 'Card Holder<span class="text-danger"> *</span>')) !!}

                                        {!! Form::text('payment_card_holder', null, ['class' => 'form-control customer-info card-deatils', 'id' => 'payment-card-holder']) !!}

                                        <small class="form-text text-muted text-danger"></small>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">

                                        {!! Html::decode(Form::label('month', 'Exp. Month<span class="text-danger"> *</span>')) !!}

                                        {!! Form::select('payment_expired', array_combine(range(1,12), range(1,12)), null, ['id' => 'month', 'class' => 'form-control']) !!}


                                        <small class="form-text text-muted text-danger"></small>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('expires-mmyy', 'Expiration Date mm/yy<span class="text-danger"> *</span>')) !!}
                                        {!! Form::text('expires_mmyy', null, ['class' => 'form-control card-deatils', 'id' => 'expires-mmyy']) !!}
                                        <small class="form-text text-muted text-danger"></small>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">

                                        {!! Html::decode(Form::label('year', 'Exp. Year<span class="text-danger"> *</span>')) !!}

                                        {!! Form::select('payment_expired', array_combine(range(date('Y'), date('Y') + 30), range(date('Y'), date('Y') + 30)), null, ['id' => 'year', 'class' => 'form-control']) !!}


                                        <small class="form-text text-muted text-danger"></small>
                                    </div>
                                </div> --}}
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('payment-cvc', 'CVV<span class="text-danger"> *</span>')) !!}
                                        {!! Form::text('payment_cvc', null, ['class' => 'form-control card-deatils', 'id' => 'payment-cvc', 'maxlength' => 4]) !!}

                                        <small class="form-text text-muted text-danger"></small>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="" style='text-align:left'>
        <span style='font-size: 15px;'>Click <a href='terms' style='cursor:pointer' id='terms-alert' target='_blank'>here</a> to read the terms of service.</span>
        <p style='font-style: italic' class='agreement-message'></p>
    </div>
    <div class="form-check" style='margin-top: 5px;'>
        {!! Form::checkbox('',1, false, ['class' => '', 'id' => 'terms']) !!}
        {!! Form::label('terms', 'I accept the terms of service.', ['class' => 'form-check-label']) !!}
    </div>
	<div class="form-notif">
		<div class="form-notif-wrap d-flex vertical-align flex-content-spacebetween">
			 {{-- {!! Form::button('Place Order', ['class' => 'btn place-order', 'type' => 'submit']) !!} --}}
			<div style='color:white' class="fonts-phones">
                <strong>Total Due Today: </strong>

                <span class='total-due-cart'>
                    @isset($totalPrice)
                        @convert($totalPrice)
                    @else
                        0.00
                    @endisset
                </span>
            </div>
            @if (session('id'))
                @if (isset(session('cart')['business_verification']['billing_state_id']) && session('cart')['business_verification']['billing_state_id'])
                    <div id='place-order' class=''>
                        <span class="tooltips agreement-tip" tooltip="" tooltip-position="left" style='border:transparent; color:black;'>
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </span>
                        {!! Form::button('Place Order', ['class' => 'btn ', 'type' => 'submit', 'id' => 'place-order-button']) !!}
                    </div>
                @else
                    <div id='place-order' class='d-none'>
                        <span class="tooltips agreement-tip" tooltip="" tooltip-position="left" style='border:transparent; color:black'>
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </span>
                        {!! Form::button('Place Order', ['class' => 'btn ', 'type' => 'submit', 'id' => 'place-order-button']) !!}
                    </div>
                    <span id='place-order-tip' class='' style='color:white'>Please enter your billing details</span>
                @endif
            @else
                <div>
                    @if(!session('id') && session('cart') && !session('changePlanStatus') == 'Upgrade' && isset(session('cart')['business_verification']) && session('cart')['business_verification'] != null)
                        <a href='{{ route('clear.order') }}' class='btn' id='clear-order' onclick="return confirm('Are you sure?')">Cancel Order</a>
                    @endif
                </div>
            @endif
		</div>
    </div>
{!! Form::close() !!}
