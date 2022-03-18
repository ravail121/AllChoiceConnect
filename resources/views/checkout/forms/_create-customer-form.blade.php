{!! Form::open(['route' => 'create.customer', 'class' => 'create-customer-form']) !!}

	<div class="panel-group section-one" id="accordionOne" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne">
				<h4 class="panel-title" id='panel-tile-1'>
					<a role="button" class="collapse-trigger" id='trigger-1' data-toggle="collapse" href="#coll" aria-expanded="true" aria-controls="collapseOne">
						<span>1.</span> {{ session('id') ? 'Shipping Info': ' Customer Info' }}
					</a>
					<ul class="pull-right d-flex vertical-align flex-content-center">
                        @if (!session('id'))
                            <li>
                                <a href="#" class="f16"><i class="fa fa-pencil customer-info-edit"></i></a>
                            </li>
                        @endif
                        @if (session('id') && session('new_customer'))
                            <li>
                                <i class="fa fa-check f16"></i>
                            </li>
                        @endif
                        {{-- @if (session('id'))
                            <li>
                                <a href="#" class="t-violet-2"><i id='collapse-button-2' class="fa f16 caret-btn fa-caret-right"></i></a>
                            </li>
                        @endisset --}}
                    </ul>

				</h4>
            </div>
            @if (session('id'))
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            @else
                @if (session('id') && session('new_customer'))
                    @if (session('cart')['customer']['shipping_fname'] != 'N/A')
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    @endif
                @else
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                @endif
            @endif
				<div class="panel-body">
                    @if(!session('id'))
                        <div class="row {{ session('id') ? 'd-none' : '' }}">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {!! Form::hidden('id', isset(session('cart')['customer_id']) ? session('cart')['customer_id'] : null,['class' => 'form-control', 'id' => 'customer-id']) !!}
                                    {!! Html::decode(Form::label('business-fname', 'First Name<span class="text-danger"> *</span>')) !!}
                                    {!! Form::text('business_fname', isset(session('cart')['customer']['fname']) && session('cart')['customer']['fname'] ? session('cart')['customer']['fname'] : session('cart')['business_verification']['fname'], ['class' => 'form-control customer-info', 'id' => 'business-fname']) !!}
                                    <small class="form-text text-muted text-danger"></small>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('business-lname', 'Last Name<span class="text-danger"> *</span>')) !!}

                                    {!! Form::text('business_lname', isset(session('cart')['customer']['lname']) && session('cart')['customer']['lname'] ? session('cart')['customer']['lname'] : session('cart')['business_verification']['lname'], ['class' => 'form-control customer-info', 'id' => 'business-lname']) !!}
                                    <small class="form-text text-muted text-danger"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row {{ session('id') ? 'd-none' : '' }}">
                            @if (session('cart')['company']['business_verification'] == 1)
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('email', 'Email<span class="text-danger"> *</span>')) !!}

                                        {!! Form::email('email', isset(session('cart')['business_verification']['email']) ? session('cart')['business_verification']['email'] : null, ['class' => 'form-control', 'id' => 'email', 'readonly']) !!}
                                        <small class="form-text text-muted text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('company-name', 'Business Name<span class="text-danger"> *</span>')) !!}

                                        {!! Form::text('company_name', isset(session('cart')['customer']['company_name']) ? session('cart')['customer']['company_name'] : session('cart')['business_verification']['business_name'], ['class' => 'form-control customer-info', 'id' => 'company-name']) !!}

                                        <small class="form-text text-muted text-danger"></small>
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('email', 'Email<span class="text-danger"> *</span>')) !!}

                                        {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                                        <small class="form-text text-muted text-danger"></small>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="row {{ session('id') ? 'd-none' : '' }}">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('primary-contact', 'Phone<span class="text-danger"> *</span>')) !!}

                                    {!! Form::text('primary_contact', isset(session('cart')['customer']['phone']) ? session('cart')['customer']['phone'] : null, ['class' => 'form-control phone', 'id' => 'primary-contact', 'autofocus', 'placeholder' => '000-000-0000']) !!}
                                    <small class="form-text text-muted text-danger"></small>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('secondary-contact', 'Alternate Phone') !!}

                                    {!! Form::text('secondary_contact', isset(session('cart')['customer']['alternate_phone']) ? session('cart')['customer']['alternate_phone'] : null, ['class' => 'form-control phone', 'id' => 'secondary-contact', 'placeholder' => '000-000-0000']) !!}
                                    <small class="form-text text-muted text-danger"></small>
                                </div>
                            </div>

                        </div>
                        <div class="row {{ session('id') ? 'd-none' : '' }}">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('password', 'Password<span class="text-danger"> *</span>')) !!}

                                    {!! Form::text('password', null, ['class' => 'form-control', 'id' => 'password', 'placeholder' => '******']) !!}
                                    <small class="form-text text-muted text-danger"></small>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('confirm-password', 'Confirm Password<span class="text-danger"> *</span>')) !!}

                                    {!! Form::text('password_confirmation', null, ['class' => 'form-control', 'id' => 'confirm-password', 'placeholder' => '******']) !!}
                                    <small class="form-text text-muted text-danger"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row {{ session('id') ? 'd-none' : '' }}">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('digitPin', 'Create a 4 digit pin<span class="text-danger"> *</span>')) !!}

                                    {!! Form::text('pin', isset(session('cart')['customer']['pin']) ? session('cart')['customer']['pin'] : null, ['class' => 'form-control', 'id' => 'digitPin', 'maxlength' => 4, 'placeholder' => '0000']) !!}
                                    <small class="form-text text-muted text-danger"></small>
                                </div>
                            </div>
                        </div>


                    	<hr>
                    @endif
					<div class="row">
						@if (!session('id'))
							<h4 class="text-left bold t-black-1 pad-left-15 pad-bottom-2">Shipping Info</h4>
                        @endif
						<div class="col-sm-6 col-xs-12">
							<div class="form-group add-bottom">
                                {!! Html::decode(Form::label('shipping-fname', 'First Name<span class="text-danger"> *</span>')) !!}
                                @if (!session('id'))
                                    {!! Form::text('shipping_fname',isset(session('cart')['customer']['shipping_fname']) ? session('cart')['customer']['shipping_fname'] : null, ['class' => 'form-control customer-info', 'id' => 'shipping-fname']) !!}
                                @else
                                    {!! Form::text('shipping_fname',session('cart')['business_verification']['shipping_fname'] ?: null, ['class' => 'form-control customer-info', 'id' => 'shipping-fname']) !!}
                                @endif
								<small class="form-text text-muted text-danger"></small>
							</div>
						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="form-group add-bottom">
                                {!! Html::decode(Form::label('shipping-lname', 'Last Name<span class="text-danger"> *</span>')) !!}
                                @if (!session('id'))
                                    {!! Form::text('shipping_lname', isset(session('cart')['customer']['shipping_lname']) ? session('cart')['customer']['shipping_lname'] : null, ['class' => 'form-control customer-info', 'id' => 'shipping-lname']) !!}
                                @else
                                    {!! Form::text('shipping_lname', session('cart')['business_verification']['shipping_lname'] ?: null, ['class' => 'form-control customer-info', 'id' => 'shipping-lname']) !!}
                                @endif
								<small class="form-text text-muted text-danger"></small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="form-group add-bottom">
                                {!! Html::decode(Form::label('shipping-address1', 'Address 1<span class="text-danger"> *</span>')) !!}
                                @if (!session('id'))
                                    {!! Form::text('shipping_address1', isset(session('cart')['customer']['shipping_address1']) ? session('cart')['customer']['shipping_address1'] : null, ['class' => 'form-control customer-info', 'id' => 'shipping-address1']) !!}
                                @else
                                    {!! Form::text('shipping_address1', isset(session('cart')['business_verification']['shipping_address1']) ? session('cart')['business_verification']['shipping_address1'] : null, ['class' => 'form-control customer-info', 'id' => 'shipping-address1']) !!}
                                @endif
								<small class="form-text text-muted text-danger"></small>
							</div>
						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="form-group add-bottom">
                                {!! Form::label('shipping-address2', 'Address 2') !!}
                                @if (!session('id'))
                                    {!! Form::text('shipping_address2', isset(session('cart')['customer']['shipping_address2']) ? session('cart')['customer']['shipping_address2'] : null, ['class' => 'form-control customer-info', 'id' => 'shipping-address2']) !!}
                                @else
                                    {!! Form::text('shipping_address2', isset(session('cart')['business_verification']['shipping_address2']) ? session('cart')['business_verification']['shipping_address2'] : null, ['class' => 'form-control customer-info', 'id' => 'shipping-address2']) !!}
                                @endif
								<small class="form-text text-muted text-danger"></small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="form-group add-bottom">
                                {!! Html::decode(Form::label('shipping-city', 'City<span class="text-danger"> *</span>')) !!}
                                @if (!session('id'))
                                    {!! Form::text('shipping_city', isset(session('cart')['customer']['shipping_city']) ? session('cart')['customer']['shipping_city'] : null, ['class' => 'form-control customer-info', 'id' => 'shipping-city']) !!}
                                @else
                                    {!! Form::text('shipping_city', isset(session('cart')['business_verification']['shipping_city']) ? session('cart')['business_verification']['shipping_city'] : null, ['class' => 'form-control customer-info', 'id' => 'shipping-city']) !!}
                                @endif
								<small class="form-text text-muted text-danger"></small>
							</div>
						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="form-group add-bottom">
                                {!! Html::decode(Form::label('shipping-state', 'State<span class="text-danger"> *</span>')) !!}
                                @if (!session('id'))
                                    {!! Form::select('shipping_state_id', $states, isset(session('cart')['customer']['shipping_state_id']) ? session('cart')['customer']['shipping_state_id'] : null, ['class' => 'form-control', 'id' => 'shipping-state', 'placeholder' => '--Select Your State--']) !!}
                                @else
                                    {!! Form::select('shipping_state_id', $states, isset(session('cart')['business_verification']['shipping_state_id']) ? session('cart')['business_verification']['shipping_state_id'] : null, ['class' => 'form-control', 'id' => 'shipping-state', 'placeholder' => '--Select Your State--']) !!}
                                @endif
								<small class="form-text text-muted text-danger"></small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="form-group add-bottom">
                                {!! Html::decode(Form::label('shipping-zip', 'Zip<span class="text-danger"> *</span>')) !!}
                                @if (!session('id'))
                                    {!! Form::text('shipping_zip', isset(session('cart')['customer']['shipping_zip']) ? session('cart')['customer']['shipping_zip'] : null, ['class' => 'form-control customer-info', 'id' => 'shipping-zip']) !!}
                                @else
                                    {!! Form::text('shipping_zip', isset(session('cart')['business_verification']['shipping_zip']) ? session('cart')['business_verification']['shipping_zip'] : null, ['class' => 'form-control customer-info', 'id' => 'shipping-zip']) !!}
                                @endif
								<small class="form-text text-muted text-danger"></small>
							</div>
						</div>
                    </div>

                    {!! Form::button(session('id') ? 'Update' : 'Save & Login', ['class' => session('id') ? 'add-top-2 btn style2 add-bottom-2 update-customer' : 'add-top-2 btn style2 add-bottom-2 create-customer', 'type' => 'submit', 'id' => 'create-customer-button']) !!}
				</div>
			</div>
		</div>
	</div>
{!! Form::close() !!}
