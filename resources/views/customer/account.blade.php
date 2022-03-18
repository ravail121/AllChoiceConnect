@extends('layouts.app')
<!-- end header -->

<!-- content -->
@section('content')
<section class="cp">
    <div class="wrapper">

        @include('customer._sidebar')

        <div class="cp-sections">

            <section class="cp-account cp-section">
                <h1>Account</h1>
                @if (session('account_suspended'))
                    <h4 style='text-align:center; color: #B22222'>Account Suspended</h4>
                @endif
                <ul>
                    {!! Form::open(['route' => 'updateCustomer','id' =>'customerForm', 'name' => 'customerForm', 'class' => 'updateCustomerForm']) !!}
                    <li>
                        {!! Form::label('fname','First Name*') !!}
                        {!! Form::text('fname',$customer['fname'] ,['disabled']) !!}
                        {!! $errors->first('fname') !!}

                        <div class="editMeControls">
                            <a href="#" class="editMe">Edit</a>
                            <a href="#" class="saveMe">Save</a>
                            <a href="#" class="cancelMe">Cancel</a>
                        </div>
                    </li>

                    <li>
                        {!! Form::label('lname','Last Name*') !!}
                        {!! Form::text('lname',$customer['lname'] ,['disabled']) !!}
                        {!! $errors->first('lname') !!}

                        <div class="editMeControls">
                            <a href="#" class="editMe">Edit</a>
                            <a href="#" class="saveMe">Save</a>
                            <a href="#" class="cancelMe">Cancel</a>
                        </div>
                    </li>

                    <li>
                        {!! Form::label('email', 'Email* ') !!}
                        {!! Form::text('email',$customer['email'] ,['disabled', 'class' => 'customer-email']) !!}
                        {!! $errors->first('email') !!}

                        <div class="editMeControls">
                            <a href="#" class="editMe">Edit</a>
                            <a href="#" class="saveMe">Save</a>
                            <a href="#" class="cancelMe">Cancel</a>
                        </div>
                    </li>

                    <li>
                        {!! Form::label('pin', 'Pin* ') !!}
                        {!! Form::text('pin', $customer['pin'], ['disabled', 'maxlength'=>'4']) !!}
                        <div class="editMeControls">
                            <a href="#" class="editMe">Edit</a>
                            <a href="#" class="saveMe">Save</a>
                            <a href="#" class="cancelMe">Cancel</a>
                        </div>
                    </li>

                    <li>
                        {!! Form::label('old_password', 'Current Password* ') !!}
                        {!! Form::password('old_password' ,['disabled','placeholder'=> '*****']) !!}

                        {!! Form::label('password', 'New Password* ') !!}
                        {!! Form::password('password' ,['disabled','placeholder'=> '*****' , 'id' => 'password']) !!}

                        {!! Form::label('password_confirmation', 'Re-type New Password* ') !!}
                        {!! Form::password('password_confirmation',['disabled','placeholder'=> '*****']) !!}

                        <div class="editMeControls">
                            <a href="#" class="editMe">Edit</a>
                            <a href="#" class="saveMe password-save">Save</a>
                            <a href="#" class="cancelMe password-cancel">Cancel</a>
                        </div>
                    </li>

                    <li>
                        {!! Form::label('phone', 'Primary Phone Number* ') !!}
                        {!! Form::text('phone',$customer['phone'],['class' => 'phone','disabled',]) !!}

                        <div class="editMeControls">
                            <a href="#" class="editMe">Edit</a>
                            <a href="#" class="saveMe">Save</a>
                            <a href="#" class="cancelMe">Cancel</a>
                        </div>
                    </li>

                    <li>
                        {!! Form::label('alternate_phone', 'Secondary Phone Number ') !!}
                        {!! Form::text('alternate_phone',$customer['alternate_phone'],['disabled','class' => 'phone']) !!}
                        <div class="editMeControls">
                            <a href="#" class="editMe">Edit</a>
                            <a href="#" class="saveMe">Save</a>
                            <a href="#" class="cancelMe">Cancel</a>
                        </div>
                    </li>

                    @if($customer['business_verification_id'])
                        <li>
                            {!! Form::label('company_name', 'Company Name* ') !!}
                            {!! Form::text('company_name',$customer['company_name'],['disabled']) !!}
                            <div class="editMeControls">
                                <a href="#" class="editMe">Edit</a>
                                <a href="#" class="saveMe">Save</a>
                                <a href="#" class="cancelMe">Cancel</a>
                            </div>
                        </li>
                    @endif

                    <li>

                        <div class="legend">Shipping</div>

                        <div class="shipping-info">
                            {!! Form::label('shipping_fname', 'Shipping First Name*') !!}
                            {!! Form::text('shipping_fname',$customer['shipping_fname'],['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('shipping_lname', 'Shipping Last Name*') !!}
                            {!! Form::text('shipping_lname',$customer['shipping_lname'],['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('shipping_address1', 'Address Line 1* ') !!}
                            {!! Form::text('shipping_address1',$customer['shipping_address1'],['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('shipping_address2', 'Address Line 2 ') !!}
                            {!! Form::text('shipping_address2',$customer['shipping_address2'],['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('shipping_city', 'City* ') !!}
                            {!! Form::text('shipping_city',$customer['shipping_city'],['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('shipping_state_id', 'State*') !!}
                            {!! Form::select('shipping_state_id', $states, $customer['shipping_state_id'] ,['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('shipping_zip', 'Postal/Zip code* ') !!}
                            {!! Form::text('shipping_zip',$customer['shipping_zip'],['maxlength'=>'5','disabled']) !!}
                        </div>

                        <div class="editMeControls">
                            <a href="#" class="editMe">Edit</a>
                            <a href="#" class="saveMe">Save</a>
                            <a href="#" class="cancelMe">Cancel</a>
                        </div>
                    </li>

                    <li>

                        <div class="legend">Billing</div>
                        <div class="shipping-info">
                            {!! Form::label('billing_fname', 'Billing First Name*') !!}
                            {!! Form::text('billing_fname',$customer['billing_fname'],['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('billing_lname', 'Billing Last Name*') !!}
                            {!! Form::text('billing_lname',$customer['billing_lname'],['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('billing_address1', 'Address Line 1* ') !!}
                            {!! Form::text('billing_address1',$customer['billing_address1'],['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('billing_address2', 'Address Line 2 ') !!}
                            {!! Form::text('billing_address2',$customer['billing_address2'],['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('billing_city', 'City* ') !!}
                            {!! Form::text('billing_city',$customer['billing_city'],['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('billing_state_id', 'State*') !!}
                            {!! Form::select('billing_state_id', $states, $customer['billing_state_id'] ,['disabled']) !!}
                        </div>

                        <div class="shipping-info">
                            {!! Form::label('billing_zip', 'Postal/Zip code ') !!}
                            {!! Form::text('billing_zip',$customer['billing_zip'],['maxlength'=>'5','disabled']) !!}
                        </div>

                        <div class="editMeControls">
                            <a href="#" class="editMe">Edit</a>
                            <a href="#" class="saveMe">Save</a>
                            <a href="#" class="cancelMe">Cancel</a>
                        </div>
                    </li>

                </ul>
            </section>
            {!! Form::button('Save',['type' => 'submit', 'class'=>'customer-btn']) !!}
            {!! Form::close() !!}


            <section class="cp-payment cp-section"  id ='payment'>
                <h1>Payment</h1>
                <div class="autopay">
                    {!! Form::checkbox('1','1', $customer['auto_pay'] , ['name' => 'auto', 'id' => 'autopay', 'class'=>'auto-pay']) !!}
                    <label for="autopay">Enroll in Auto-Pay <span>Uncheck to Opt-Out of Auto-Pay</span></label>
                    {!! Form::hidden(null, $customer['auto_pay'], ['name' => 'auto_pay', 'id' => 'auto-pay']) !!}
                </div>
                <ul class="cp-paymentOptions">
                    @foreach($cards as $key => $card)
                    <li>
                        <a href="#" class="openCard"><i>.</i></a>
                        <figure>
                            @if ( $card['card_type'] == 'Visa')
                                <img src="{{ asset('theme/images/visa.jpg') }}" alt="visa">
                            @elseif ($card['card_type'] == 'Master')
                                <img src="{{ asset('theme/images/master.jpg') }}" alt="master">
                            @else
                                <img src="{{ asset('theme/images/other-card.png') }}" alt="xyz">
                            @endif
                        </figure>

                        <div class="card">
                            @if ( $card['default'] == '1')
                                <span class="status add-bottom primary">Primary</span>
                                <span class="status add-bottom display-none make-primary"><a href="#">Make Primary</a></span>
                                @isset( $nextPrimary['id'] )
                                    {!! Form::hidden(null, $nextPrimary['card_type'] .' Ending in '.$nextPrimary['last4'], ['name' => 'nextprimary', 'id' => 'nextprimary']) !!}
                                @else
                                    {!! Form::hidden(null, '0', ['name' => 'nextprimary', 'id' => 'nextprimary']) !!}
                                @endisset
                            @else
                                <span class="status add-bottom display-none primary">Primary</span>
                                <span class="status add-bottom make-primary"><a href="#">Make Primary</a></span>
                            @endif
                            <div class="text">
                                {{ $card['card_type'] }} Ending in {{ $card['last4'] }}
                            </div>

                            {!! Form::hidden(null, $card['id'], ['name' => 'card_id', 'id' => 'card_id', 'value' => '1']) !!}
                            {!! Form::hidden(null, $card['default'], ['name' => 'primary', 'id' => 'primary']) !!}

                            <div class="additinal">
                                <span>Name on card</span>
                                <div class="text">
                                {{ $card['cardholder'] }}
                                </div>
                            </div>
                        </div>

                        <div class="expiry">

                            <span class="expires">Expires</span>
                            <div class="text">
                                {{ $card['expiration'] }}
                            </div>

                            <div class="additinal">
                                <div class="text">
                                    <span>Billing Address</span>
                                    {{ $card['billing_address1'] }} <br> {{ $card['billing_city'] }} <br> {{ $card['billing_zip'] }}
                                </div>
                            </div>
                        </div>

                        <div class="editCardControls">
                            <a href="#" class="removeCard">Remove</a>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <div class="addCard" id ='addCard'>
                    <a class="addLine" href="javascript:void(0);"> <span class="fa-plus-square fa"></span> &nbsp;&nbsp;&nbsp; Add a Credit Card</a>
                    {!! Form::open(['route' => 'addCard', 'class' => 'addCardForm', 'style'=> 'display: none;']) !!}
                        <ul>
                            <li class="pad-right-15 city">
                                {!! Form::label('payment_card_no', 'Card Number ') !!}
                                {!! Form::text('payment_card_no',null,['placeholder' => 'Card Number', 'maxlength'=>'23']) !!}
                            </li>


                            <li class="half expiration-month pad-right-15">
                                {!! Form::label('month', 'Expiration Month ') !!}
                                {!! Form::select('month', ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6' , '7' => '7' , '8' => '8' , '9' => '9' , '10' => '10', '11' => '11', '12' => '12'], null ,  ['placeholder' => 'Month']) !!}
                            </li>

                            <li class="half pad-right-15 expiration-year">
                                {!! Form::label('year', 'Expiration Year ') !!}
                                {!! Form::select('year', $currentYear , null ,  ['placeholder' => 'Year']) !!}
                            </li>

                            <li class="cvv">
                                {!! Form::label('payment_cvc', 'CVV ') !!}
                                {!! Form::text('payment_cvc',null,['placeholder' => 'CVV','maxlength'=>'4']) !!}
                                <img src="{{ asset('theme/images/card.png') }}" alt="cvv">
                            </li>


                            <li class="pad-right-15 card-holder">
                                {!! Form::label('payment_card_holder', 'Card Holder ') !!}
                                {!! Form::text('payment_card_holder',null,['placeholder' => 'Card Holder']) !!}
                            </li>

                            <li class="pad-right-15 addr">
                                {!! Form::label('billing_address1', 'Address ') !!}
                                {!! Form::text('billing_address1',null,['placeholder' => 'Address']) !!}
                            </li>

                            <li class="pad-right-15 city">
                                {!! Form::label('billing_city', 'City ') !!}
                                {!! Form::text('billing_city',null,['placeholder' => 'City']) !!}
                            </li>

                            <li class="pad-right-15 state">
                                {!! Form::label('billing_state_id', 'State ') !!}
                                {!! Form::select('billing_state_id',$states, null ,  ['placeholder' => 'State']) !!}
                            </li>

                            <li class="zip">
                                {!! Form::label('billing_zip', 'Zip ') !!}
                                {!! Form::text('billing_zip',null,['placeholder' => 'Zip', 'maxlength' =>'5']) !!}
                            </li>
                        </ul>

                        <div class="formButtons">
                            <input type="reset" value="Cancel">
                            {!! Form::button('Save',['type' => 'submit', 'class'=>'card-btn']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>

            </section>

        </div>
    </div>
</section>

@endsection

@push('js')
<script>
    $('#customerForm').on('keyup keypress', function(e) {
      let keyCode = e.keyCode || e.which;
      if (keyCode === 13) {
        e.preventDefault();
        return false;
      }
    });
    $(function(){

        $('.status a').on('click', makePrimary);

        $("body").on("click", ".cancelMe", function(e) {
            $(this).parents("li").find("em").hide();
        });

        $("body").on("click", ".saveMe", fieldValidate);
        $('.auto-pay').on('change', toggleCheckboxAndValidate);

        function toggleCheckboxAndValidate(f){
            const value = $(this).is(':checked') ? 1 : 0;
            $('#auto-pay').val(value);
            autoPay(value);
            // fieldValidate(f);
        };

        $('#payment_card_no').inputmask("mask", {"mask": "9999 9999 9999 9999 999", placeholder:"", clearIncomplete: false});

        function autoPay(value) {
            const formData = {auto_pay: value};
            $.ajax({
                type: 'POST',
                url: '{{ route('updateCustomer') }}',
                dataType: 'json',
                data:formData,
                beforeSend: showLoader,
                success: function (data) {
                    swal("Success", "Auto pay changes Done", "success");
                },
                complete: hideLoader,
                error: function (data) {
                    swal("Error", "Sorry Something went Wrong", "error");
                }
            });
        }

        $('.removeCard').on('click',function (f) {
            f.preventDefault();
            const e = $(this);
            if(e.parents("li").find("#primary").val() == "1"){
                nextcard = e.parents("li").find("#nextprimary").val();
                if(nextcard == '0'){
                    msg = 'This is your only card, Removing this will un-enroll you from Auto-Pay.';
                }else{
                    msg = "This is your primary card, Deleting it will switch your primary card to "+nextcard+".";
                }
            }else{
                nextcard = null;
                msg = "Do you Really want to delete this card";
            }

            swal({
                    title: "Are you sure you want to proceed?",
                    text: msg,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        let id = e.parents("li").find("#card_id").val();
                        deleteCard(id, e, nextcard);
                    } else {
                        swal("Don't Worry Your Card is safe!");
                    }
            });
        });

        function makePrimary(f) {
            f.preventDefault();
            const  $this = $(this);
            const formData = {customer_credit_card_id: $this.parents("li").find("#card_id").val()};
            $.ajax({
                type: 'POST',
                url: '{{ route('primary.card') }}',
                dataType: 'json',
                data:formData,
                beforeSend: showLoader,
                success: function (data) {
                    location.reload();
                },
                complete: hideLoader,
                error: function (data) {
                    alert("Something Went Wrong");
                }
            });
        }

        function deleteCard(id, e, nextcard = null) {
            const formData = {customer_credit_card_id: id};
            $.ajax({
                type: 'POST',
                url: '{{ route('delete.card') }}',
                dataType: 'json',
                data:formData,
                beforeSend: showLoader,
                success: function (data) {
                    if(nextcard == '0' && $('#auto-pay').val() == "1"){
                        autoPayDisable();
                    }else{
                        hideLoader();
                        swal("Your Card has been deleted!")
                        .then((value) => {  
                            location.reload();
                        });
                    }
                },
                error: function (data) {
                    hideLoader();
                    swal("Something Went Wrong");
                }
            });
        }

        function autoPayDisable() {
            $.ajax({
                type: 'POST',
                url: '{{ route('updateCustomer') }}',
                dataType: 'json',
                data:{auto_pay: '0'},
                success: function (data) {
                    hideLoader();
                    swal("Your Card has been deleted!")
                    .then((value) => {  
                        location.reload();
                    });
                },
                error: function (data) {
                    swal("Error", "Sorry Something went Wrong", "error");
                }
            });
        }

        $phoneInputMask       = $('.phone'),
        $phoneInputMask.inputmask("mask", {"mask": "999-999-9999", clearIncomplete: true});

        function fieldValidate(f){
            f.preventDefault();
            let e = $(this);
            // var name = e.parents("li").find("input").attr('name');
            $('.updateCustomerForm').validate({
                rules: {
                    fname: {
                        required:  true,
                    },
                    lname: {
                        required:  true,
                    },
                    email:{
                        required:  true,
                        email:     true,
                        remote :{
                            url: "{{ route('update.email') }}",
                            type: "post"
                        }
                    },
                    pin: {
                        required:   true,
                        minlength:  4,
                        number:     true,
                    },
                    phone: {
                        required:   true,

                    },
                    shipping_address1: {
                        required:   true,
                    },
                    shipping_city: {
                        required:   true,
                    },
                    shipping_state_id: {
                        required:   true,
                    },
                    shipping_zip: {
                      required:             true,
                      minlength:            5,
                      number:               true
                    },
                    shipping_fname: {
                        required:   true,
                    },
                    shipping_lname: {
                        required:   true,
                    },
                    billing_fname: {
                        required:   true,
                    },
                    billing_lname: {
                        required:   true,
                    },
                    billing_address1: {
                        required:   true,
                    },
                    billing_city: {
                        required:   true,
                    },
                    billing_state_id: {
                        required:   true,
                    },
                    billing_zip: {
                      required:             true,
                      minlength:            5,
                      number:               true
                    },
                    company_name: {
                        required:   true,
                    },
                    old_password: {
                        required:  true,
                        remote :{
                            url: "{{ route('update.password') }}",
                            type: "post"
                        }
                    },
                    password: {
                        required:   true,
                        minlength:  6,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo:  '#password'
                    },
                },
                messages: {
                    fname:                 "Please provide First Name.",
                    lname:                 "Please provide Last Name.",
                    billing_address1:      "Please provide Address",
                    billing_city:          "Please provide City",
                    pin:{
                        required:          "Please provide Pin",
                        minlength:         "Your Pin must be of 4 digits",
                        number:            "Please provide valid Pin",
                    },
                    password:{
                        required:          "Please provide Password",
                        minlength:         "Your password must be atleast 6-characters long"
                    },
                    billing_state_id:      "Please provide State",
                    email: {
                        required:          "Please enter your email address",
                        email:             "Please enter a valid email address",
                        remote:            "Email Already exist"
                    },
                    shipping_address1:     "Please provide Address",
                    shipping_city:         "PSomething Wentlease provide City",
                    shipping_zip:          "Please Enter a Valid Zip",
                    billing_zip:           "Please Enter a Valid Zip",
                    company_name:          "Please provide Company Name",
                    shipping_state_id:     "Please provide State",
                    shipping_fname:        "Please provide First name",
                    shipping_lname:        "Please provide Last name",
                    billing_fname:        "Please provide First name",
                    billing_lname:        "Please provide Last name",
                    old_password: {
                        required:          "Please enter your current Password",
                        remote:            "Password doesn't match in Database"
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
            if ($('.updateCustomerForm').valid()) {
                runAjax(e);
                e.hide(), e.siblings(".cancelMe").hide(), e.siblings(".editMe").show(),
                e.parents("li").find("input").prop("disabled", !0),
                e.parents("li").find("select").prop("disabled", !0), !1;
            }else{
                runSubmit();
            }
        };
        function runSubmit() {
            $('.updateCustomerForm').submit();
        }
        function runAjax(e) {
            const loginForm = $("#customerForm");
            const formData = loginForm.serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route('updateCustomer') }}',
                dataType: 'json',
                data:formData,
                beforeSend: showLoader,
                success: function (data) {
                    e.parents("li").find("input").removeClass('update-invalid');
                    $(".password-save").parents("li").find("input").val('');
                },
                complete: hideLoader,
                error: function (data) {
                    e.parents("li").find("input").addClass('update-invalid');
                }
            });
        };
    });

    $(function(){
        $('.addCardForm').validate({
            rules: {
                payment_card_no: {
                  required:             true,
                  creditcard:           true
                },
                year:                  "required",
                month: {
                    required:           true,
                    CCExp: {
                        year:          '#year',
                        month:         '#month'
                    }
                },
                payment_cvc: {
                  required:             true,
                  minlength:            3,
                  number:               true
                },
                billing_zip: {
                  required:             true,
                  minlength:            5,
                  number:               true
                },
                payment_card_holder:   "required",
                billing_address1:      "required",
                billing_city:          "required",
                billing_state_id:      "required",
            },
            messages: {
                payment_card_no: {
                    required:          "Please enter your Card Number",
                    creditcard:        "Please enter a valid Card Number"
                },
                year:                  "Please provide year",
                payment_cvc:           "Provide Valid CVV",
                payment_card_holder:   "Please provide Cardholder Name ",
                billing_address1:      "Please provide Address",
                billing_city:          "Please provide City",
                billing_state_id:      "Please provide State",
                billing_zip:           "Please provide Valid Zip",

            },

            errorElement: "em",

            errorPlacement: function( error, element ){

                $(element).addClass('is-invalid');
                error.addClass('card-error');
                error.insertAfter(element);
                hideLoader();
            },
            success: function( label, element ){
                $(element).removeClass("is-invalid");
            },
        });
    });

    $(".card-btn").on("click", checkLoader);

    function checkLoader() {
        if($('.addCardForm').valid()){
            showLoader();
        }else{
            hideLoader();
        }
    }

    $(".password-cancel").on("click", function() {
        $(this).parents("li").find("input").val('');
    });

    $.validator.addMethod('CCExp', function(value, element, params) {
        let minMonth = new Date().getMonth() + 1;
        let month    = parseInt($(params.month).val(), 10);
        let minYear  = new Date().getFullYear().toString().substr(-2);
        let year     = parseInt($(params.year).val().substr(-2), 10);
        return (!month || !year || year > minYear || (year == minYear && month >= minMonth));
    }, 'Expiration date is invalid.');


</script>
@endpush
