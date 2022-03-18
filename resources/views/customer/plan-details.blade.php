@extends('layouts.app')
<!-- end header -->

<!-- content -->
@section('content')
    <section class="cp">
        <div class="wrapper">

            @include('customer._sidebar')

            <div class="cp-sections">
                <section class="billGlance cp-section">
                    <h1>Your Bill</h1>
                    <p>
                        Charges for {{ $invoices['billing_start'] }} to {{ $invoices['billing_end'] }}
                        <span>You are {{ $customer['auto_pay'] ? '' : 'not' }} enrolled in auto-pay. <a href="{{ route('account') }}#payment">Edit</a></span>
                    </p>

                    <ul>
                        <li>
                            <h4>Charges</h4>
                            ${{ $invoices['charges'][0] }}<sup>.{{ $invoices['charges'][1] }}</sup>
                        </li>

                        <li>
                            <h4>Payments/Credits</h4>
                            ${{ $invoices['payment'][0] }}<sup>.{{ $invoices['payment'][1] }}</sup>
                        </li>

                        <li>
                            <h4>Past Due</h4>
                            ${{ $invoices['past_due'][0] }}<sup>.{{ $invoices['past_due'][1] }}</sup>
                        </li>

                        <li>
                            <h4>Total Due</h4>
                            ${{ $invoices['total'][0] }}<sup>.{{ $invoices['total'][1] }}</sup>
                            <span>{{ $invoices['due_date'] }}</span>
                        </li>
                    </ul>
                </section>

                <section class="billPlans cp-section" id='billPlans-section'>
                    <h1>My Plans</h1>
                    @if ($subcriptions)
                        <ul class="billPlans-lines">
                            @foreach($subcriptions['customer-plans'] as $key => $subcription)
                                <li class="billPlans-line">
                                    <ul class="billPlans-details">
                                        @if(isset ($subcription['device']['primary_image']))
                                            <li>
                                                <figure>
                                                    @if($subcription['device']['primary_image'])
                                                        <img class="detail-device-img" src= "{{ $subcription['device']['primary_image'] }}" alt="">
                                                    @else
                                                        <img class="detail-device-img" src= "{{ asset("theme/images/alternate_phone_image.png") }}" alt="photo">
                                                    @endif
                                                </figure>

                                                <dl class ="sub-details">
                                                    <dt class="billPlans-name">{{ $subcription['device']['name'] }}</dt>
                                                    <dd><strong>{{ $subcription['phone_number_formatted'] }}</strong></dd>
                                        @else
                                            <li class="firstli">
                                                <figure>
                                                    <img src="theme/images/bill-phone3.jpg" alt="phone">
                                                </figure>

                                                <dl class ="sub-details">
                                                    <dt>NA</dt>
                                                    <dd><strong>{{ $subcription['phone_number_formatted'] }}</strong></dd>
                                                    @endif

                                                    <dt class="billPlans-name">Label</dt>
                                                    <dd>{{ $subcription['label'] ?: 'NA' }} <a class="label-edit-btn">Edit</a></dd>
                                                    <div class="edit-label display-none">
                                                        <dd><input data-id="{{ $subcription['id'] }}" class="label-input" type="text" name="" value="{{ $subcription['label'] }}"></dd>
                                                        <div class="label-btn">
                                                            <a href="#" class="label-save-btn">Save</a>
                                                            <a href="#" class="label-cancel-btn">Cancel</a>
                                                        </div>
                                                    </div>
                                                </dl>
                                                @if($subcription['phone_number'])
                                                    <dl>
                                                        <table class="usages">
                                                            <tr>
                                                                <th>Data Usage</th>
                                                                <th class="voice-usage">Voice Usage</th>
                                                                <th>Text Usage</th>
                                                            </tr>
                                                            @if ($usages && array_key_exists('id', $subcription) && array_key_exists($subcription['id'], $usages ))
                                                                <tr>
                                                                    <th>{{ number_format($usages[$subcription['id']]['data'], 2) }}</th>
                                                                    <th>{{ number_format($usages[$subcription['id']]['voice'], 2) }}</th>
                                                                    <th>{{ number_format($usages[$subcription['id']]['text']) }}</th>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <th>NA</th>
                                                                    <th>NA</th>
                                                                    <th>NA</th>
                                                                </tr>
                                                            @endif
                                                        </table>
                                                    </dl>
                                                @else
                                                    <dl>
                                                        <table class="usages">
                                                            <tr>
                                                                <th>Data Usage</th>
                                                                <th class="voice-usage">Voice Usage</th>
                                                                <th>Text Usage</th>
                                                            </tr>
                                                            <tr>
                                                                <th>NA</th>
                                                                <th>NA</th>
                                                                <th>NA</th>
                                                            </tr>
                                                        </table>
                                                    </dl>
                                                @endif
                                                <div class="text-center show-usages-btn">
                                                    <button type="button" class="btn style2 show-usages" data-toggle="modal" data-target="#usageModal" data-phone="{{ $subcription['phone_number'] }}" data-subscription="{{ $subcription['id'] }}">View Usage</button>
                                                </div>
                                            </li>

                                            <li>

                                                <dl>
                                                    <dt class="billPlans-name">Plan</dt>
                                                    <dd>{{ $subcription['plan']['name'] }}</dd>

                                                    <?php
                                                    $orderAddon = array_column($subcription['subscription_addon_not_removed'], 'addons');
                                                    $addonName  = array_column($orderAddon, 'name');

                                                    ?>
                                                    @if(implode(",",$addonName))
                                                        <dt class="billPlans-name">Features</dt>
                                                        <dd>
                                                            {{ implode(',', $addonName) }}
                                                        </dd> <br>
                                                    @endif
                                                    <?php
                                                    $planCharges = $subcription['plan']['amount_recurring'];
                                                    $addonCharges = array_sum(array_column(array_column($subcription['subscription_addon_not_removed'], 'addons'), 'amount_recurring'));
                                                    ?>

                                                    <dt>Monthly Charges</dt>
                                                    <dd style='margin-top: 10px;'>$ @convert($planCharges + $addonCharges)</dd>
                                                </dl>
                                                @if($subcription['plan']['subsequent_zip'] == '1' && $subcription['status'] === 'for-activation' && !$subcription['requested_zip'])
                                                    <div class="text-center activate-now-btn">
                                                        @isset($subcription['port']['status'])
                                                            @if($subcription['port']['status'] == '0' && $customer['account_suspended'] != "1")
                                                                <button type="button" class="btn style2 activate-number" data-toggle="modal" data-target="#myModal_neworexisting" class="activate-number" data-id="{{ $subcription['port']['id'] }}" data-row="{{ $subcription['sim_card_num'] }}" data-number_to_port="{{ $subcription['port']['number_to_port'] }}">Activate Now</button>
                                                            @endif
                                                        @else
                                                            @if($customer['account_suspended'] != "1")
                                                                <button type="button" class="btn style2 activate-number" data-toggle="modal" data-target="#myModal_neworexisting" class="activate-number" data-id="" data-sub-id ="{{ $subcription['id'] }}" data-row="{{ $subcription['sim_card_num'] }}" data-number_to_port="">Activate Now</button>
                                                            @endif
                                                        @endisset
                                                    </div>
                                                @endif

                                            </li>

                                            <li>
                                                <dl>
                                                    <dt class="billPlans-name">IMEI</dt>
                                                    <dd class="imei">
                                                        <input type="text" name="imei" value="{{ $subcription['device_imei'] ?: 'NA' }}" disabled>

                                                        <p>
                                                            <a href="#" class="savePlanOption">Save</a>
                                                            <a href="#" class="cancelPlanOption">Cancel</a>
                                                        </p>
                                                    </dd>

                                                    <dt class="billPlans-name">Sim</dt>
                                                    <dd class="sim">
                                                        <input type="text" name="sim" value="{{ $subcription['sim_card_num'] }}" disabled style='width: 200px;'>

                                                        <p>
                                                            <a href="#" class="savePlanOption">Save</a>
                                                            <a href="#" class="cancelPlanOption">Cancel</a>
                                                        </p>
                                                    </dd>
                                                </dl>
                                            </li>
                                    </ul>

                                    <div class="menu">
                                        <a href="#" class="trigger">.</a>
                                        <ul>
                                            @if($subcription['status'] == 'active' || ($subcription['plan']['subsequent_zip'] == '1' && $subcription['requested_zip']))
                                                @isset($subcription['port']['status'])
                                                    @if($subcription['port']['status'] == '0' && $customer['account_suspended'] != "1")
                                                        <li><a href="#portpopup" class="port-number" data-toggle="modal" data-target="#portpopup" data-id="{{ $subcription['port']['id'] }}" data-row="{{ $subcription['sim_card_num'] }}"  data-number_to_port="{{ $subcription['port']['number_to_port'] }}">Port My Number</a></li>
                                                    @elseif($subcription['port']['status'] == '4' && $customer['account_suspended'] != "1")
                                                        <li><a href="#portpopup" class="port-number" data-toggle="modal" data-target="#portpopup" data-id="{{ $subcription['port']['id'] }}" data-row="{{ $subcription['sim_card_num'] }}"  data-number_to_port="{{ $subcription['port']['number_to_port'] }}">Edit Port</a></li>
                                                    @endif
                                                @else
                                                    @if($subcription['plan']['subsequent_porting'] == '1' && $customer['account_suspended'] != "1")
                                                        <li><a href="#portpopup" class="port-number" data-toggle="modal" data-target="#portpopup" data-id="" data-sub-id ="{{ $subcription['id'] }}" data-row="{{ $subcription['sim_card_num'] }}"  data-number_to_port="">Port My Number</a></li>
                                                    @endif
                                                @endisset

                                                @if($subcription['upgrade_downgrade_status'] =="downgrade-scheduled")
                                                    <li><a>Downgrade Scheduled</a></li>
                                                @elseif($subcription['upgrade_downgrade_status'] == "for-upgrade")
                                                    <li><a>Plan Upgraded, Waiting for Approval</a></li>
                                                @else
                                                    <li><a href="{{ route('compatible.plans', $subcription['id']) }}">Change my plan</a></li>
                                                    @if(in_array('ultra', $slug) && $subcription['plan']['carrier']['slug'] === 'ultra')
                                                        <li><a data-toggle="modal" class="change-sim" data-sim_num="{{ $subcription['sim_card_num'] }}" data-phone_number="{{ $subcription['phone_number'] }}" data-is_ultra="1" data-target="#changeSim">Change SIM</a></li>
                                                    @elseif($customer['company']['goknows_api_key'])
                                                        <li><a data-toggle="modal" class="change-sim" data-sim_num="{{ $subcription['sim_card_num'] }}" data-phone_number="{{ $subcription['phone_number'] }}" data-is_ultra="0" data-target="#changeSim">Change SIM</a></li>
                                                    @endif
                                                @endif
                                            @elseif($subcription['status'] !== 'active' || ($subcription['plan']['subsequent_zip'] == '1' && $subcription['status'] === 'for-activation'))
                                                @if($subcription['plan']['subsequent_zip'] == '1' && !$subcription['requested_zip'])
                                                    @isset($subcription['port']['status'])
                                                        @if($subcription['port']['status'] == '0' && $customer['account_suspended'] != "1")
                                                            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_neworexisting" data-id="{{ $subcription['port']['id'] }}" data-row="{{ $subcription['sim_card_num'] }}" data-number_to_port="{{ $subcription['port']['number_to_port'] }}">Activate Now</a></li>
                                                        @elseif($subcription['port']['status'] == '4' && $customer['account_suspended'] != "1")
                                                            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_neworexisting" data-id="{{ $subcription['port']['id'] }}" data-row="{{ $subcription['sim_card_num'] }}" data-number_to_port="{{ $subcription['port']['number_to_port'] }}">Edit Port</a></li>
                                                        @endif
                                                    @else
                                                        @if($customer['account_suspended'] != "1")
                                                            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_neworexisting" data-id="" data-sub-id ="{{ $subcription['id'] }}" data-row="{{ $subcription['sim_card_num'] }}" data-number_to_port="">Activate Now</a></li>
                                                        @endif
                                                    @endisset
                                                @endif
                                                <li><a>{{ $subcription['status_formated'] }}</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        {{-- <div class="addNewLine">
                  <a href="#" class="addLine">Add a new line <i>+</i></a> Add 4 or more lines and receive a discount of $5/line per month! <strong>Use Code <em>MULTI45</em></strong>
              </div> --}}


                        <div class="totals">
                            <ul>
                                <li>
                                    <span>Subtotal</span>
                                    $@convert($subcriptions['monthlyAmountDetails']['subtotal'])
                                </li>

                                <li >
                            <span>
                                Regulatory Fee
                                {{-- <em>$3 per line</em> --}}
                            </span>
                                    $@convert($subcriptions['monthlyAmountDetails']['regulatoryFee'])
                                </li>

                                <li>
                                    <span>State Tax</span>
                                    $@convert($subcriptions['monthlyAmountDetails']['stateTax'])
                                </li>
                            </ul>

                            <div class="grandTotal"><span>Monthly Total</span> $@convert($subcriptions['monthlyAmountDetails']['monthlyTotalAmount'])</div>
                        </div>
                    @else
                        <h4>Subscriptions Details could not be fetched</h4>
                    @endif
                </section>
            </div>
        </div>
    </section>
    <!-- end content -->

    <!-- Port Popup Model modal -->
    <div class="portPopup">
        <div class="modal fade bd-example-modal-lg" id="portpopup" tabindex="-1" role="dialog" aria-labelledby="portpopup" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content editpopcontent">
                    <div class="topbx row">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <div class="col-sm-12 col-md-12">
                            <div class="">
                                <h1>Send Port Request</h1>
                            </div>
                        </div>
                    </div>
                    <div class="popvtmcont">
                        <form id="port-info" class="port-info">
                            <input type="hidden" class="port-id" id="id" name ="id" readonly>

                            <input type="hidden" class="subscription-id" id="subscription_id" name ="subscription_id" readonly>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="authorized_name">Authorized Name*</label>
                                    <input type="text" id="authorized_name" name ="authorized_name" class="form-control effect-1" aria-describedby="emailHelp" placeholder="Authorized Name">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="address_line1">Address Line 1*</label>
                                    <input type="text" id="address_line1" name="address_line1" class="form-control effect-1" aria-describedby="emailHelp" placeholder="Address Line 1">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="address_line2">Address Line 2</label>
                                    <input type="text" id ="address_line2" name="address_line2" class="form-control effect-1" aria-describedby="emailHelp" placeholder="Address Line 2">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="city">City*</label>
                                    <input type="text" id="city" name="city" class="form-control effect-1" aria-describedby="emailHelp" placeholder="City">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    {!! Form::label('state', 'State*') !!}<br>
                                    {!! Form::select('state',[null => 'Select State' ]+ $states->toArray(), null) !!}
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="zip">Zip Code*</label>
                                    <input type="text" id="zip" name="zip" class="form-control effect-1" aria-describedby="emailHelp" placeholder="Zip">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="ssn_taxid">SSN/Tax ID(Optional)</label>
                                    <input type="text" id="ssn_taxid" name="ssn_taxid" class="form-control effect-1" aria-describedby="emailHelp" placeholder="SSN/Tax ID(Optional)">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="sim_card_number">SIM Card Number</label>
                                    <input type="text" id="sim_card_number" name="sim_card_number" class="form-control effect-1" aria-describedby="emailHelp" placeholder="SIM Card Number" disabled>
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="number_to_port">Number to Port*</label>
                                    <input type="text" id ="number_to_port" name ="number_to_port" class="form-control effect-1" aria-describedby="emailHelp" placeholder="Number to Port"  maxlength="10">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="company_porting_from">Phone Company you are porting from* </label>
                                    <input type="text" id="company_porting_from" name="company_porting_from" class="form-control effect-1" aria-describedby="emailHelp" placeholder="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="account_number_porting_from">Account Number of former carrier*</label>
                                    <input type="text" id="account_number_porting_from" name="account_number_porting_from" class="form-control effect-1" aria-describedby="emailHelp" placeholder="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="account_pin_porting_from">Account Pin of former carrier* </label>
                                    <input type="text" id="account_pin_porting_from" name="account_pin_porting_from" class="form-control effect-1" aria-describedby="emailHelp" placeholder="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="form-group col-sm-12 col-md-12 mt-4 text-right">
                                    <button type="submit" class="btn lightbtn final-port-submit-btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal_neworexisting" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body mobile_vompit text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <h3>New or Existing Number </h3>

                    <p>Please enter your zip code so we can verify your coverage then choose an option below.</p>
                    <form method="post" id="get-new-number" class="get-new-number">
                        <input type="hidden" class="subscription-id" id="get-new-number-subscription_id" name="id" readonly>
                        <input type="text" class="form-control input_color" name="requested_zip" placeholder="Zip code" required>
                        <p>Transfer your number from your current carrier.</p>
                        <a href="javascript:void(0);" class="update_phoe" data-toggle="modal" data-target="#myModal_extnumberselt">Transfer an Existing  Number</a>

                        <p class="or_class">-------------------OR--------------------</p>
                        <p>Request a new phone number based on your zip code</p>
                        <button type="submit" class="update_phoe">Get A New Number</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div id="myModal_extnumberselt" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body mobile_vompit text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Transfer Details</h3>
                    <p>Please enter your account information from your current carrier below:</p>
                    <form method="post" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 transfer-plan-details" id="transfer-plan-details">
                        <input type="hidden" class="port-id" id="transfer-plan-details-port-id" name="id" readonly>
                        <input type="hidden" class="subscription-id" id="transfer-plan-details-subscription_id" name="subscription_id" readonly>
                        <div class="form-group col-sm-12 col-md-6">
                            <input type="text" id="transfer-plan-details-authorized_name" name="authorized_name" class="form-control effect-1 input_color" placeholder="Authorized Name">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <input type="text" id="transfer-plan-details-address_line1" name="address_line1" class="form-control input_color effect-1" placeholder="Address Line 1">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <input type="text" id="transfer-plan-details-address_line2" name="address_line2" class="form-control input_color effect-1" placeholder="Address Line 2">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <input type="text" id="transfer-plan-details-city" name="city" class="form-control input_color effect-1" placeholder="City">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <select id="transfer-plan-details-state" class="input_color form-control" name="state">
                                <option selected="selected">Select State</option>
                                @foreach($states->toArray() as $stateCode => $state)
                                    <option value="{{ $stateCode }}">{{ $state }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <input type="text" id="transfer-plan-details-zip" name="zip" class="form-control effect-1 input_color" placeholder="Zip">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <input type="text" id="transfer-plan-details-ssn_taxid" name="ssn_taxid" class="form-control input_color effect-1" placeholder="SSN/Tax ID(Optional)">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <input type="text" id="transfer-plan-details-sim_card_number" name="sim_card_number" class="form-control effect-1 input_color" placeholder="SIM Card Number" disabled>
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <input type="text" id="transfer-plan-details-number_to_port" name="number_to_port" class="form-control input_color effect-1" required placeholder="Number to Port" maxlength="10">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <input type="text" id="transfer-plan-details-company_porting_from" name="company_porting_from" class="form-control effect-1 input_color " required placeholder="Phone Company you are porting from*">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <input type="text" id="transfer-plan-details-account_number_porting_from" name="account_number_porting_from" class="form-control effect-1 input_color" required placeholder="Account Number of former carrier*">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <input type="text" id="transfer-plan-details-account_pin_porting_from" name="account_pin_porting_from" class="form-control effect-1 input_color" required placeholder="Account Pin of former carrier*">
                            <span class="focus-border"></span>
                        </div>

                        <div class="col-sm-12 col-md-12 mt-4">
                            <button type="submit" class="btn lightbtn final-port-submit-btn center-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('customer.partials._usage')
    @include('customer.partials._change-sim')

@endsection

@push('js')
    <script>
        $(function(){
            var validationRules = {
                authorized_name: {
                    required:  true,
                    maxlength:  20,
                },
                zip: {
                    required:   true,
                    minlength:  5,
                    maxlength:  5,
                    number:     true
                },
                address_line1: {
                    required:   true,
                },
                city: {
                    required:   true,
                    maxlength:  20,
                },
                state: {
                    required:   true,
                },
                number_to_port: {
                    required:   true,
                    minlength:  10,
                    maxlength:  10,
                    number:     true,
                    remote: {
                        url: "{{ route('check.number') }}",
                        type: "post"
                    }
                },
                company_porting_from: {
                    required:   true,
                },
                account_number_porting_from: {
                    required:   true,
                },
                account_pin_porting_from: {
                    required:   true,
                },
                sim_card_number: {
                    required:   true,
                    number:     true
                },
            };

            var validationMessages = {
                authorized_name: {
                    required:          "Please provide Authorized Name.",
                    maxlength:          "Authorized name can't be so long"
                },
                zip:{
                    required:          "Please provide Pin",
                    minlength:         "Zip must be of 5 digit",
                    maxlength:         "Zip must be of 5 digit",
                },
                address_line1:          "Please provide Address.",
                city:{
                    required:          "Please provide city.",
                    maxlength:         "City name can't be so long"
                },
                state:                  "Please provide state Name.",
                number_to_port:{
                    required:          "Please provide Number to port.",
                    number:            "Must be numeric number",
                    minlength:         "Number must be of 10 digit",
                    maxlength:         "Number must be of 10 digit",
                    remote:            "Number already Active",
                },
                sim_card_number: {
                    required:          "Please provide Sim Card Number.",
                    number:            "Must be numeric number"
                },
                company_porting_from:    "Please provide company Name.",
                account_pin_porting_from:    "Please provide Account Pin.",
                account_number_porting_from:    "Please provide Account Number.",
            };

            $('.port-info').validate({
                rules: validationRules,
                messages: validationMessages,

                errorElement: "em",

                errorPlacement: function( error, element ){
                    $(element).addClass('is-invalid');
                    error.addClass('form-text text-muted text-danger');
                    error.insertAfter(element);
                },
                success: function( label, element ){
                    $(element).removeClass("is-invalid");
                },
            });

            $('.get-new-number').validate({
                rules: {
                    requested_zip: {
                        required: true,
                        minlength: 5,
                        maxlength: 5,
                        number: true
                    }
                },

                messages: {
                    requested_zip: {
                        required:          "Please provide Pin",
                        minlength:         "Zip must be of 5 digit",
                        maxlength:         "Zip must be of 5 digit",
                    },
                },
                errorElement: "em",

                errorPlacement: function( error, element ){
                    $(element).addClass('is-invalid');
                    error.addClass('form-text text-muted text-danger');
                    error.insertAfter(element);
                },
                success: function( label, element ){
                    $(element).removeClass("is-invalid");
                },
            });

            $('.transfer-plan-details').validate({
                rules: validationRules,
                messages: validationMessages,

                errorElement: "em",

                errorPlacement: function( error, element ){
                    $(element).addClass('is-invalid');
                    error.addClass('form-text text-muted text-danger');
                    error.insertAfter(element);
                },
                success: function( label, element ){
                    $(element).removeClass("is-invalid");
                },
            });

            $('body').on('submit', '#port-info', function(f) {
                f.preventDefault();
                if ($('.port-info').valid()) {
                    updatePortAjax();
                }
            });

            $('body').on('submit', '#transfer-plan-details', function(f) {
                f.preventDefault();
                if ($('.transfer-plan-details').valid()) {
                    activateNumberAjax();
                }
            });

            $('body').on('submit', '#get-new-number', function(f) {
                f.preventDefault();
                if ($('.get-new-number').valid()) {
                    getNewNumberAjax();
                }
            });

            $('.port-number').on('click', function(e) {
                let $this = $(this);
                $('.selected').removeClass('selected');
                $this.addClass('selected');
                $('.port-id').val($this.attr('data-id'));
                $('.subscription-id').val($this.attr('data-sub-id'));
                $('#sim_card_number').val($this.attr('data-row'));
                $('#number_to_port').val($this.attr('data-number_to_port'));
            });

            $('.activate-number').on('click', function(e) {
                let $this = $(this);
                $('.selected').removeClass('selected');
                $this.addClass('selected');
                $('.port-id').val($this.attr('data-id'));
                $('.subscription-id').val($this.attr('data-sub-id'));
                $('#transfer-plan-details-sim_card_number').val($this.attr('data-row'));
                $('#transfer-plan-details-number_to_port').val($this.attr('data-number_to_port'));
            });

            function updatePortAjax() {
                const formData = $('#port-info').serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('update.port') }}',
                    dataType: 'json',
                    data:formData,
                    beforeSend: showLoader,
                    success: function (data) {
                        $('.selected').hide();
                        $('#portpopup').modal('toggle');
                        swal("success!", 'Port Request Submitted Successfully' , "success");
                    },
                    complete: hideLoader,
                    error: function (data) {
                        swal("Error", "Sorry Something went Wrong", "error");
                    }
                });
            };


            function activateNumberAjax() {
                const formData = $('#transfer-plan-details').serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('update.port') }}',
                    dataType: 'json',
                    data:formData,
                    beforeSend: showLoader,
                    success: function (data) {
                        $('.selected').hide();
                        $('#myModal_extnumberselt').modal('toggle');
                        $('#myModal_neworexisting').modal('toggle');
                        swal("success!", 'Port Request Submitted Successfully' , "success");
                    },
                    complete: hideLoader,
                    error: function (data) {
                        swal("Error", "Sorry Something went Wrong", "error");
                    }
                });
            };


            function getNewNumberAjax()
            {
                const formData = $('#get-new-number').serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('update.requested-zip') }}',
                    dataType: 'json',
                    data: formData,
                    beforeSend: showLoader,
                    success: function (data) {
                        $('.selected').hide();
                        $('#myModal_neworexisting').modal('toggle');
                        swal("success!", 'Activation submitted successfully. New number will be emailed to you shortly.' , "success");
                    },
                    complete: hideLoader,
                    error: function (data) {
                        swal("Error", "Sorry Something went Wrong", "error");
                    }
                });

            }

            function showLoader() {
                $('.myOverlay').removeClass('d-none');
                $('.loadingGIF').removeClass('d-none');
            }

            function hideLoader() {
                $('.myOverlay').addClass('d-none');
                $('.loadingGIF').addClass('d-none');
            }

            $('body').on('click', '.label-edit-btn', function(e) {
                e.preventDefault();
                $this = $(this).parents('dd');
                $this.addClass('display-none');
                $this.next('.edit-label').removeClass('display-none');
            });

            $('body').on('click', '.label-cancel-btn', function(e) {
                e.preventDefault();
                $this = $(this).parents('.edit-label');
                $this.addClass('display-none');
                $this.prev('dd').removeClass('display-none');
            });

            $('body').on('click', '.label-save-btn', function(e) {
                e.preventDefault();
                $this = $(this).parents('.edit-label');
                updateLabel($this);
            });

            function updateLabel($this) {
                $input = $this.find('.label-input');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('update.label') }}',
                    dataType: 'json',
                    data: {
                        label: $input.val(),
                        id: $input.attr('data-id')
                    },
                    beforeSend: showLoader,
                    success: function (data) {
                        $this.addClass('display-none');
                        $this.prev('dd').removeClass('display-none');
                        if(data.label){
                            $this.prev('dd').html(data.label+' <a class="label-edit-btn">Edit</a>');
                        }else{
                            $this.prev('dd').html('NA <a class="label-edit-btn">Edit</a>');
                        }
                    },
                    complete: hideLoader,
                    error: function (data) {
                        swal("Error", "Sorry Something went Wrong", "error");
                    }
                });
            };
        });
    </script>
@endpush
