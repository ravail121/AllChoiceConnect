@extends('layouts.app')

@section('content')
	<!-- content -->
	<section class="choose-device-content">
		<div class="container">
			@include('processes.process-steps')
			<div class="row no-margin pad-top-10 text-center">
				<h1 class="content-title">You are almost done!</h1>
				<p class="t-gray-2 bold f14 add-top-35">Please select/add your card for payment.</p>
                <div class='coupon-message mt-20 mb-20'></div>
				<div class="add-top-6 xs-add-top-4">
					<div class="checkout-section">
						<div class="row">
							<div class="col-md-7 col-sm-12 col-xs-12 left-con">
								@include('checkout.forms._create-customer-form')

								@include('checkout.forms._customer-billing-form')

                            </div>
							<div class="col-md-5 col-sm-12 col-xs-12 right-con" style="position: sticky; top: 0;">

                                @include('checkout.cart._cart')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sim edit modal for lowercart -->
        @include('checkout._plan-coupon-logic')
        @include('checkout._billing-logic')
        @include('checkout._coupon-logic')
    </section>
    <!-- end content -->

@endsection

@push('js')
    <script>
        String.prototype.allReplace = function(obj) {
            var retStr = this;
            for (var x in obj) {
                retStr = retStr.replace(new RegExp(x, 'g'), obj[x]);
            }
            return retStr;
        };
        const replaceFromHtml = {
            '-' : '',
            ',' : ''
        }
        $(function(){
            var iTag, liTag, creditCards, sessionId, new_customer, shippingFirstName;

            creditCards = @json($customerCards);
            sessionId   = @json(session('id'));
            new_customer = @json(session('new_customer'));
            const $customerForm         = $('.create-customer-form'),
                  $customerBillingForm  = $('.customer-billing-form'),
                  $addStepNumber        = $('.no-margin > ul'),
                  $digitPin             = $('#digitPin'),
                  $paymentCvc           = $('#payment-cvc'),
                  $password             = $('#password'),
                  $confirmPassword      = $('#confirm-password'),
                  $phoneInputMask       = $('.phone'),
                  $expireDateInputMask  = $('#expires-mmyy'),
                  $cardNumberInputMask  = $('#payment-card-no'),
                  $cardCvcInputMask     = $('#payment-cvc'),
                  $createCustomer       = $('.create-customer'),
                  $updateCustomer       = $('.update-customer'),
                  $collapseTrigger      = $('.panel-title').find('.collapse-trigger'),
                  $placeOrder           = $('.place-order'),
                  $shippingZipInputMask = $('#shipping-zip'),
                  $billingZipInputMask  = $('#billing-zip'),
                  $headingOne           = $('#headingOne'),
                  $headingOneA          = $headingOne.find('a'),
                  $headingTwo           = $('#headingTwo'),
                  $headingTwoA          = $headingTwo.find('a'),
                  $checkbox             = $('#exampleCheckbox1'),
                  $customerCard         = $('input[name="customer_card"]'),
                  $saveTax              = $('#save-tax'),
                  $applyCoupon          = $('#coupon-apply'),
                  $removeCoupon         = $('#remove-coupon'),
                  $billingAccordion     = $('#collapseTwo'),
                  $termsAlert           = $('#terms-alert'),
                  $termsAgree           = $('#terms'),
                  $placeOrderButton     = $('#place-order-button');

            var billingStateId   = $('#billing-state'),
                billingFname     = $('#billing-fname'),
                billingLname     = $('#billing-lname'),
                billingAddress1  = $('#billing-address1'),
                billingAddress2  = $('#billing-address2'),
                billingCity      = $('#billing-city'),
                billingZip       = $('#billing-zip'),
                panelTitle       = $('#panel-tile-2').find('.collapse-trigger'),
                $number          = $('#payment-card-no'),
                $cardHolder      = $('#payment-card-holder'),
                $expiration      = $('#expires-mmyy'),
                $cvv             = $('#payment-cvc');

            $expireDateInputMask.inputmask({ alias: "datetime", inputFormat: "mm/yy", clearIncomplete: false });
            $cardNumberInputMask.inputmask("mask", {"mask": "9999 9999 9999 9999 999", placeholder:"", clearIncomplete: false});
            $phoneInputMask.inputmask("mask", {"mask": "999-999-9999", clearIncomplete: true});
            $shippingZipInputMask.inputmask("mask", {"mask": "99999", placeholder: "", clearIncomplete: true});
            $billingZipInputMask.inputmask("mask", {"mask": "99999", placeholder: "", clearIncomplete: true});
            $placeOrderButton.attr('disabled', true);

            iTag  = '<i class="fa fa-check f16"></i>';
            liTag = '<li><a href="#" class="t-violet-2"><i class="fa f16 caret-btn fa-caret-right"></i></a></li>';

            $addStepNumber.addClass('step3');

            var orderid         = "{{ session('cart')['id'] }}";
            var hash            = "{{ session('customer_hash') }}";
            var totalDueCart    = $('.total-due-cart');

            if (!sessionStorage['phone'] && !sessionId) {
                $collapseTrigger.trigger('click');
                $headingOneA.attr('aria-expanded', 'true');
                $headingTwoA.attr('href', '#col');
                $headingTwo.find('ul').find('li > a.t-violet-2').remove();
            } else {
                const $shippingFname = $('input[name="fname"]'),
                      $shippingLname = $('input[name="lname"]'),
                      $shippingAdd1  = $('input[name="shipping_address1"]'),
                      $shippingAdd2  = $('input[name="shipping_address2"]'),
                      $shippingCity  = $('input[name="shipping_city"]'),
                      $shippingState = $('#shipping-state'),
                      $shippingZip   = $('input[name="shipping_zip"]');

                if (!sessionId) {

                    $shippingFname.val(sessionStorage['firstName']);
                    $shippingLname.val(sessionStorage['lastName']);
                    $('input[name="primary_contact"]').val(sessionStorage['phone']);
                    $('input[name="secondary_contact"]').val(sessionStorage['alternatePhone']);
                    $shippingAdd1.val(sessionStorage['shippingAddress1']);
                    $shippingAdd2.val(sessionStorage['shippingAddress2']);
                    $shippingCity.val(sessionStorage['shippingCity']);
                    $shippingState.val(sessionStorage['shippingStateId']);
                    $shippingZip.val(sessionStorage['zip']);

                } else {

                    var sessionCart = @json(session('cart'));

                    $shippingFname.val(sessionCart.business_verification.fname);
                    $shippingLname.val(sessionCart.business_verification.lname);
                    $shippingAdd1.val(sessionCart.business_verification.shipping_address1);
                    $shippingAdd2.val(sessionCart.business_verification.shipping_address2);
                    $shippingCity.val(sessionCart.business_verification.shipping_city);
                    $shippingState.val(sessionCart.business_verification.shipping_state_id);
                    $shippingZip.val(sessionCart.business_verification.shipping_zip);


                }

                if ($headingOne.find('a').prop('href', '#coll')) {

                    $headingOne.find('li > a').remove();
                    //$headingOne.find('li').append(iTag);
                    $headingOne.find('a').attr('href', '#collapseOne');
                    $headingOne.find('ul').append(liTag);
                    $headingTwoA.attr('href', '#collapseTwo');

                    $('.panel-title').find('.collapse-trigger').trigger('click');

                }

            }

            //$digitPin.on('focus', changeTypeToPassword);
            $password.on('focus', changeTypeToPassword);
            $paymentCvc.on('focus', changeTypeToPassword);
            $confirmPassword.on('focus', changeTypeToPassword);
            $checkbox.on('change', function () {
                copyShippingAddressToBilling(this, billingFname, billingLname, billingAddress1, billingAddress2, billingCity, billingStateId, billingZip);
            });
            $customerCard.on('change', copyCardDetails);
            $updateCustomer.on('click', updateCustomer);
            $createCustomer.on('click', createCustomer);
            $placeOrder.on('click', clearSession);
            $saveTax.on('click', saveTax);
            $applyCoupon.on('click', applyCoupon);
            $(document).on('click', $removeCoupon, removeCouponOnClickTrigger);
            $termsAgree.on('change', termsAgreement);

            function clearSession(f){

                if (!$collapseTrigger.hasClass('collapsed')) {
                    $collapseTrigger.trigger('click');
                }
                if (($('input[name="payment_card_no"]').val() == '') || (!$customerBillingForm.valid())) {
                    f.preventDefault();
                    //sessionStorage.clear();
                }
            }

            function createCustomer(c) {

                if ($customerForm.valid()) {
                    c.preventDefault();
                    var firstName         =  $('input[name="business_fname"]').val(),
                        lastName          =  $('input[name="business_lname"]').val(),
                        email             =  $('#email').val(),
                        companyName       =  $('input[name="company_name"]').val(),
                        primaryContact    =  ($('input[name="primary_contact"]').val()).replace(/\D/g,''),
                        secondaryContact  =  ($('input[name="secondary_contact"]').val()).replace(/\D/g,''),
                        password          =  $('#password').val(),
                        shippingAddress1  =  $('input[name="shipping_address1"]').val(),
                        shippingAddress2  =  $('input[name="shipping_address2"]').val(),
                        shippingCity      =  $('input[name="shipping_city"]').val(),
                        shippingState     =  $('#shipping-state option:selected').val(),
                        zip               =  $('input[name="shipping_zip"]').val(),
                        pin               =  $('input[name="pin"]').val(),
                        shippingFirstName =  $('input[name="shipping_fname"]').val(),
                        shippingLastName  =  $('input[name="shipping_lname"]').val();
                        customer_id       =  $('#customer-id').val();

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('create.customer') }}',
                        dataType: 'json',
                        data:{
                            fname             : firstName,
                            lname             : lastName,
                            email             : email,
                            company_name      : companyName,
                            phone             : primaryContact,
                            alternate_phone   : secondaryContact,
                            password          : password,
                            shipping_fname    : shippingFirstName,
                            shipping_lname    : shippingLastName,
                            shipping_address1 : shippingAddress1,
                            shipping_address2 : shippingAddress2,
                            shipping_city     : shippingCity,
                            shipping_state_id : shippingState,
                            shipping_zip      : zip,
                            pin               : pin,
                            customer_id       : customer_id
                        },
                        beforeSend: showLoader,
                        success: function (data) {
                            signOn(email, password);
                        },
                        error: function (data) {
                            hideLoader();
                            console.log('Error:', data);
                            alert('Something went wrong. Please try again later.');
                        }

                    });
                } else {

                    c.preventDefault();

                }
            }

            function signOn(email, password)
            {
                $.ajax({
                    url: '{{ route('signOn.no-redirect') }}',
                    method: 'post',
                    data: {
                        'identifier': email,
                        'password': password
                    },
                    beforeSend: showLoader,
                    success: function(data){
                        location.reload();
                    },
                });
            }
            function updateCustomer(u) {

                if ($customerForm.valid()) {
                    u.preventDefault();

                    var firstName         =  $('input[name="shipping_fname"]').val(),
                        lastName          =  $('input[name="shipping_lname"]').val(),
                        shippingAddress1  =  $('input[name="shipping_address1"]').val(),
                        shippingAddress2  =  $('input[name="shipping_address2"]').val(),
                        shippingCity      =  $('input[name="shipping_city"]').val(),
                        shippingState     =  $('#shipping-state option:selected').val(),
                        zip               =  $('input[name="shipping_zip"]').val();

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('updateCustomer') }}',
                        dataType: 'json',
                        data:{
                            shipping_fname    : firstName,
                            shipping_lname    : lastName,
                            shipping_address1 : shippingAddress1,
                            shipping_address2 : shippingAddress2,
                            shipping_city     : shippingCity,
                            shipping_state_id : shippingState,
                            shipping_zip      : zip,
                        },
                        beforeSend: showLoader,
                        success: function (data) {
                            var sessionCart = @json(session('cart'));

                            sessionCart.business_verification.fname             = firstName;
                            sessionCart.business_verification.lname             = lastName;
                            sessionCart.business_verification.shipping_address1 = shippingAddress1;
                            sessionCart.business_verification.shipping_address2 = shippingAddress2;
                            sessionCart.business_verification.shipping_city     = shippingCity;
                            sessionCart.business_verification.shipping_state_id = shippingState;
                            sessionCart.business_verification.shipping_zip      = zip;

                            const $headingO   = $('#headingOne'),
                                  $headingT   = $('#headingTwo'),
                                  $panelTitle = $('.panel-title').find('.collapse-trigger'),
                                  $collapseOne= ('#collapseOne'),
                                  $collapseTwo= ('#collapseTwo');

                            panelTitle   = $('#panel-tile-1').find('.collapse-trigger');
                            panelTitle.click();
                            scrollTrigger('#accordionTwo');
                        },
                        complete: function() {
                            hideLoader();
                        },
                        error: function (data) {
                            console.log('Error:', data);

                            alert('Something went wrong. Please try again later.');
                        }
                    });

                } else {
                    c.preventDefault();
                }
            }

            function showLoader() {
                $('.myOverlay').removeClass('d-none');
                $('.loadingGIF').removeClass('d-none');
            }

            function hideLoader() {
                $('.myOverlay').addClass('d-none');
                $('.loadingGIF').addClass('d-none');

                $('html, body').animate({
                    // scrollTop: $("#collapseTwo").position().top - 560
                }, 2000);
            }

            function changeTypeToPassword() {
                $(this).attr('type','password');
            };

            if (typeof creditCards !== 'undefined' && creditCards !== null) {
                copyCardDetails();
            }

            storeBillingInputsInSession();
            billingInputValues(billingAddress1, billingAddress2, billingCity, billingStateId, billingZip, billingFname, billingLname, sessionId);

            function copyCardDetails() {

                $paymentCvc.attr('type', 'password');

                var cardId, i;

                cardId = $('input[name="customer_card"]').val();

                if (typeof creditCards !== 'undefined' && creditCards !== null) {

                    for (i = 0; i < creditCards.length; i++) {

                        if (creditCards[i].id == cardId) {
                            var billingAddress1 = creditCards[i].billing_address1,
                                billingAddress2 = creditCards[i].billing_address2,
                                billingCity     = creditCards[i].billing_city,
                                billingState    = creditCards[i].billing_state_id,
                                billingZip      = creditCards[i].billing_zip,
                                number          = creditCards[i].number,
                                cardholder      = creditCards[i].cardholder,
                                expiration      = creditCards[i].expiration,
                                cvc             = creditCards[i].cvc;

                        }
                    }
                }

                if($('#new-card').is(':checked')) {
                    $('.payment-fields').removeClass('d-none');
                    $cardHolder.val('');
                    $expiration.val('');
                    $number.val('');
                    $cvv.val('');
                } else {
                    $('.payment-fields').addClass('d-none');
                    // $billingAddress1.val(billingAddress1);
                    // $billingAddress2.val(billingAddress2);
                    // $billingState.val(billingState);
                    // $billingCity.val(billingCity);
                    // $billingZip.val(billingZip);
                    $cardHolder.val(cardholder);
                    $expiration.val(expiration);
                    $number.val(number);
                    $cvv.val(cvc);
                }

            };

            callvalidation($customerForm, $customerBillingForm);

            $('#place-order-button').click(()=>{
                if (!new_customer) {
                    billingInputValues(billingAddress1, billingAddress2, billingCity, billingStateId, billingZip, billingFname, billingLname, sessionId);
                }
                if ($('#collapseThree').attr('class') == 'panel-collapse collapse' && $('#payment-card-no').val() == '') {
                    $('#collapse-button-3').click();
                }

                let paymentCardValidation = $('#payment-card-holder').valid(),
                    expiryDateValidation  = $('#expires-mmyy').valid(),
                    paymentCvcValidation  = $('#payment-cvc').valid(),
                    paymentCardNumber     = $('#payment-card-no').valid();
                if ($customerBillingForm.valid()) {
                    if (paymentCardValidation && expiryDateValidation && paymentCvcValidation && paymentCardNumber) {
                        $(this).prop('disabled', true);
                        showLoader();
                    } else {
                        $(this).prop('disabled', false);
                        hideLoader();
                    }
                }
            });

            function callvalidation($customerForm, $customerBillingForm)
            {
            	$customerForm.validate({
                    rules: {

                        business_fname : "required",
                        business_lname : "required",
                        email: {
                            required : false,
                            email    : true,
                            remote :{
                                url: "{{ route('update.email') }}",
                                type: "post"
                            }
                        },
                        company_name    : "required",
                        primary_contact : "required",
                        password: {
                            required    : true,
                            minlength   : 6,
                        },
                        password_confirmation: {
                            required: true,
                            equalTo:  "#password",
                        },
                        shipping_fname:     "required",
                        shipping_lname:     "required",
                        shipping_address1:  "required",
                        shipping_city:      "required",
                        shipping_state_id:  "required",
                        shipping_zip:       "required",
                        pin: {
                            required:   true,
                            digits:     true,
                            minlength:  4
                        },
                    },
                    messages: {

                        business_fname    : "Please provide your first name",
                        business_lname    : "Please provide your last name",

                        email: {
                            required      : "Please provide your email address",
                            email         : "Please enter a valid email address",
                            remote        : "Email already exist",
                        },
                        company_name      : "Please provide your Company name",

                        primary_contact   : "Please enter your contact number",
                        password: {
                            required      : "Please enter your 6 or more characters password",
                            minlength     : "Your password must be atleast 6-characters long",
                        },
                        password_confirmation: {
                            required      : "Please confirm your password",
                            equalTo       : "This should match with your password",
                        },
                        shipping_fname    : "Please provide your first name",
                        shipping_lname    : "Please provide your last name",
                        shipping_address1 : "Please provide your address",
                        shipping_city     : "Please provide your city",
                        shipping_state_id : "Please provide your state",
                        shipping_zip      : "Please provide your zip code",
                        pin: {
                            required      : "Please create your unique 4-digit pin for future use",
                            digits        : "Oops! you entered alphabet by mistake",
                        },
                    },

                    errorElement: "small",

                    errorPlacement: function( error, element ){

                    	$(element).addClass('is-invalid');
                        error.addClass('form-text text-muted text-danger');
                        error.insertAfter(element);

                    },
    				success: function( label, element ){
                        $(element).removeClass("is-invalid");
                    },
                });

				$customerBillingForm.validate({
                    rules: {
                        billing_fname:    "required",
                        billing_lname:    "required",
                        billing_address1: "required",
                        billing_city:     "required",
                        billing_state_id: "required",
                        billing_zip:      "required",
                        payment_card_no: {
                            required:   true,
                            creditcard: true,
                        },
                        payment_card_holder: "required",
                        expires_mmyy: {
                            required: true,
                            CCExp: true,
                        },
                        payment_cvc: {
                            required:  true,
                            digits:    true,
                            minlength: 3,

                        },
                    },
                    messages: {

                        billing_fname:       "Please provide your first name",
                        billing_lname:       "Please provide your last name",
                        billing_address1:    "Please provide your address",
                        billing_city:        "Please provide your city",
                        billing_state_id:    "Please choose your state",
                        billing_zip:         "A valid zip code is required",
                        payment_card_holder: "Please provide the Card Holder Name",
                        payment_card_no: {
                            required:        "Your card number is required",
                            creditcard:      "Please enter a valid card number",
                        },
                        payment_cvc: {
                            required:        "Please enter a valid cvc for this card",
                            digits:          "Oops! you entered alphabet by mistake",
                        },
                        expires_mmyy: {
                            required:        "Please provide your card expiry date",
                        }
                    },

                    errorElement: "small",

                    errorPlacement: function( error, element ){

                    	$(element).addClass('is-invalid');
                        error.addClass('form-text text-muted text-danger');
                        error.insertAfter(element);

                    },
    				success: function( label, element ){
                        $(element).removeClass("is-invalid");
                    },
                });

            }
            $.validator.addMethod('CCExp', function(value, element) {
              var minMonth = new Date().getMonth() + 1;
              var month    = value.split('/')[0];
              var minYear  = parseInt(new Date().getFullYear().toString().substr(-2));
              var incrementedYear = parseInt(new Date().getFullYear().toString().substr(-2)) + 10;
              var year     = value.split('/')[1];
              if(year > incrementedYear || (year == incrementedYear && month > minMonth )) {
                return false;
              }  else if(year < minYear || (year == minYear && month < minMonth )) {
                return false;
              } else {
                return true
              }
            }, 'Your Credit Card Expiration date is invalid.');
            if (sessionId) {
                sessionStorage.getItem('billing_state_id') != '' ? scrollTrigger('#accordionTwo') : scrollTrigger('#accordionOne');
            } else {
                scrollTrigger('.content-title');
            }
            function termsAgreement()
            {
                let agreementTip = $('.agreement-tip');
                if (this.checked) {
                    $placeOrderButton.attr('disabled', false);
                    agreementTip.addClass('d-none');
                } else {
                    $placeOrderButton.attr('disabled', true);
                    agreementTip.removeClass('d-none');
                }
            }
            $termsAlert.click(()=>{
                let aggreementMessage = $('.agreement-message');
                aggreementMessage.html('Refunds are only valid for devices returned within 7 days');
            });
		});



        function addCommas(num) {
            var str = num.toString().split('.');
            if (str[0].length >= 4) {
                str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
            }
            return str.join('.');
        }

        function scrollTrigger(target)
        {
            $('html, body').animate({
                scrollTop: $(target).position().top
            }, 2000);
        }
        $('.customer-info').change(function(){
            $(this).val($.trim($(this).val()));
        });
	</script>
@endpush
