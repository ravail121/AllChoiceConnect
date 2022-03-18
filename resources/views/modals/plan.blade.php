<div id="choosePlan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="choosePlan">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">

				<div class="row">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        	<span aria-hidden="true">×</span>
			        </button>

                    <div class="col-md-8 col-sm-7 col-xs-12 left-con">
                        <div class="bold t-black-1 f18 text-left add-bottom-3">{{-- PLAN HEADING HERE --}}</div>
                        {!! Form::hidden('plan_area_code', null, ['class' => "plan_area_code"]) !!}
                            {!! Form::open(['route' => 'plans.store', 'id' => 'form-with-plan']) !!}

                                {!! Form::hidden('plan_id', null) !!}
                                {!! Form::hidden('plan_carrier_id', null) !!}
                                {!! Form::hidden('plan_type', null) !!}
                                {!! Form::hidden('device_id', null) !!}
                                {!! Form::hidden('device_name', null) !!}
                                {!! Form::hidden('device_amount', null) !!}
                                {!! Form::hidden('sim_name', null) !!}
                                {!! Form::hidden('sim_required', null, ['id' => 'simRequired']) !!}
                                {!! Form::hidden('associate_with_device', null) !!}

                                <section class="sim-section">
                                    <div class="bold t-black-1 f16 text-left add-bottom-15">+ Select Your Sim <span class="text-danger"> *</span></div>
                                    <div class="row">
                                        <div class="col-xs-12 own-sim-card-option">

                                            <div class="form-check add-bottom-15">
                                                {!! Form::radio('buy_sim', 'no', false, ['class' => 'form-check-input', 'id' => 'exampleRadios1']) !!}

                                                {!! Form::label('exampleRadios1', 'I will bring my own Sim Card', ['class' => 'form-check-label', 'id' => 'buy-sim-no']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="form-check add-bottom-15">
                                                {!! Form::radio('buy_sim', 'yes', false, ['class' => 'form-check-input', 'id' => 'exampleRadios2']) !!}

                                                {!! Form::label('exampleRadios2', 'I want to buy one', ['class' => 'form-check-label', 'id' => 'buy-sim-yes']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 sim-selection d-none" id='sim-selection'>
                                            {{-- Sim Radio Buttons will be displayed here --}}
                                        </div>

                                        <div class="col-xs-4 d-none">
                                            {!! Html::decode(Form::label('sim-number', 'Sim Number<span class="text-danger"> *</span>', ['class' => 'form-sim-label'])) !!}
                                        </div>
                                        <div class="col-xs-8 d-none">
                                            <div class="form-group">
                                                {!! Form::text('sim_number', null, ['class' => 'form-control', 'id' => 'sim-number', 'aria-describedby' => 'sim-number', 'style' => 'max-width: 290px', 'placeholder' => 'Enter sim number']) !!}
                                            </div>
                                        </div>
									</div>
								</section>

                                <section class="port-section">
                                    <div class="bold t-black-1 f16 text-left add-bottom port-message-1">Will you be porting in your number from your current carrier?<span class="text-danger"> *</span></div>
                                    <p class="add-bottom-15 italic f12 port-message-2">Please keep in mind, you can not port an existing T-mobile number to our service.</p>
                                    <div class="port-number-change">
                                        <div class="form-check add-bottom-15 d-inline add-right-3 porting-yes">
                                            {!! Form::radio('porting', 'yes', false, ['class' => 'form-check-input', 'id' => 'porting1']) !!}
                                            {!! Form::label('porting1', 'Yes', ['class' => 'form-check-label', 'id' => 'label-porting-1']) !!}
                                        </div>
                                        <div class="form-check add-bottom-15 d-inline porting-no">
                                            {!! Form::radio('porting', 'no', false, ['class' => 'form-check-input', 'id' => 'porting2']) !!}
                                            {!! Form::label('porting2', 'No', ['class' => 'form-check-label', 'id' => 'label-porting-2']) !!}
                                        </div>
                                    </div>

                                    <div class="bold f12 t-gray-2 add-bottom-15 d-none port-message-3">Please enter the number you would like to port</div>

                                    <div class="port-number d-none">
                                        <div class="form-group">
                                            {!! Form::text('port_number', null, ['class' => 'form-control porting-number', 'id' => 'port-number', 'aria-describedby' => 'port-number', 'style' => 'max-width: 290px', 'placeholder' => '000-000-0000']) !!}
                                        </div>
                                    </div>
                                    <div class="area-code d-none">
                                        <div class="bold f12 t-gray-2 add-bottom-15 area-code-note">If you would like to be assigned a new number, please enter desired area code</div>

                                        <div class="form-group">
                                            {!! Form::text('area_code', null, ['class' => 'form-control area', 'id' => 'area-code', 'aria-describedby' => 'area-code', 'style' => 'max-width: 90px', 'placeholder' => '000']) !!}
                                        </div>
                                    </div>
                                </section>

                                <section class="own-device-section">
                                    <div class="bold t-black-1 f16 text-left add-bottom">Bringing your own device ?<span class="text-danger mandatory-star"> *</span></div>
                                    <div class="bringing-own-device">
                                        <div class="form-check add-bottom-15 d-inline add-right-3">
                                            {!! Form::radio('bringing_own_device', 'yes', false, ['class' => 'form-check-input', 'id' => 'own-device']) !!}
                                            {!! Form::label('own-device', 'Yes', ['class' => 'form-check-label']) !!}
                                        </div>
                                        <div class="form-check add-bottom-15 d-inline">
                                            {!! Form::radio('bringing_own_device', 'no', false, ['class' => 'form-check-input', 'id' => 'select-device']) !!}
                                            {!! Form::label('select-device', 'No', ['class' => 'form-check-label']) !!}
                                        </div>
                                    </div>

                                </section>

                                <section class="device-info-section d-none">
                                    <div class="bold t-black-1 f16 text-left add-bottom">Your Device Info: <span class="text-danger"> *</span></div>

                                    <div class="col-xs-4">
                                        {!! Html::decode(Form::label('operating-system', 'Operating System<span class="text-danger"> *</span>', ['class' => 'bold f12 t-gray-2 add-bottom-15'])) !!}
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            {!! Form::select('operating_system',['' => '-- Select Your Operating System --'], null, ['class' => 'form-control', 'id' => 'operating-system', 'aria-describedby' => 'operating-system', 'style' => 'max-width: 290px']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        {!! Html::decode(Form::label('imei-number', 'IMEI<span class="text-danger"> *</span>', ['class' => 'bold f12 t-gray-2 add-bottom-15'])) !!}
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            {!! Form::text('imei', null, ['class' => 'form-control no-input-spinners', 'id' => 'imei-number', 'aria-describedby' => 'imei-number', 'style' => 'max-width: 290px', 'placeholder' => '################', 'maxlength' => '15', 'pattern' => '\d*']) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class='form-check add-bottom-15 d-inline add-right-3'>
                                            <input type='checkbox' class='form-check-input imei-info' id='no-imei' name='get_imei' value='yes'>
                                            <label class='form-check-label imei-info' for='no-imei'>I don't know my device 's IMEI number</label> <br><br>
                                            <p class="add-bottom-2 t-gray-2 f12">
                                                Dial <span class="t-violet-2">*#06#</span> from your device to locate your IMEI number.
                                            </p>

                                        </div>
                                    </div>

                                </section>

								<section class="addon-section">
									<div class="bold t-black-1 f16 text-left add-bottom-2">Add-on Features <span class="f12 italic normal t-gray-1">(Optional)</span></div>

                                    {{-- ADDON CHECKBOXES WILL APPEAR HERE --}}

								</section>
							{!! Form::close() !!}

					</div>
					<div class="col-md-4 col-sm-5 col-xs-12 right-con text-center no-pad-left pad-right xs-pad-left-15 xs-pad-right-15">
						<div class="right-con-wrap">
							<div class="price-wrap">
								<span class="sign">$</span>
								<span class="price">{{-- PLAN PRICE HERE --}}</span>
								<span class="month">
									<i>per</i>
									<i>MONTH</i>
								</span>
							</div>

							<ul>
                                {{-- PLAN DESCRIPTION HERE --}}
							</ul>

                            <div class="add-to-cart">

    							<div class="add-top-4">
    								<a href="#" class="btn style3 run-ajax">Add To Cart</a>
    							</div>
                            </div>

                            <div class="add-to-cart-with-options d-none">

    							<div class="add-top-4">
                                    <a href="#" class="btn style3 run-ajax add-without-device">Add To Cart w/o Device</a>
                                </div>
                                <div class="add-top-2">
                                    <a href="#" class="btn style4 choose-device">Add To Cart & Choose Device</a>
                                </div>
                            </div>

							<div class="separator add-top-5">
							</div>

					</div>

				</div>
			</div>
		</div>
	</div>
</div>
</div>
@include('modals.additional-popup')

