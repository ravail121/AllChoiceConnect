<ul class="cpNav">
    <li><a class='monthly-billing-link' href="{{ route('plans.details') }}">Monthly Billing</a></li>
    <li><a class='billing-history-link' href="{{ route('history') }}">Billing History</a></li>
    <li><a class='account-page-link' href="{{ route('account') }}"><span>Welcome</span>{{ $customer['fname'] }}  {{ $customer['lname'] }} <i>.</i></a></li>
</ul>

<aside class="bill">
    <div class="billWrapper">
        <div class='amount-container'>
            <h3 class='text-account-page-left'><span>Total Due</span>{{ $invoices['due_date'] }}</h3>
            <h2 class='text-account-page-right'>${{ $invoices['total'][0] }}<sup>.{{ $invoices['total'][1] }}</sup></h2>
        </div> <br>
        <a href="{{ route('account') }}#payment">Edit Billing Preferences</a>

        <a href="#" class="button" data-toggle="modal" data-target="#paymentModal">Make Payment</a>
    </div>
    @if ($customer['auto_pay'] && array_sum($invoices['total']))
        <p class="fineprint">We will process your payment automatically in
            {{ isset($daysUntilAutoPay) ? $daysUntilAutoPay : ''}}
        days</p>
    @endif
    <a href="{{ route('plans.index') }}" class="add-line">Add a new line <i>+</i></a>
</aside>

<div class="portPopup">
<div class="modal fade bd-example-modal-lg" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="portpopup" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content editpopcontent">
            <div class="top-custom-bx">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>

            </div>
            <div class="popvtmcont">
                <form id="make-payment-form">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-8 card-div" style="overflow: visible !important;">
                            <div class="visacard">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4 text-center"><img src="{{ asset('theme/images/card_img.png') }}" class="img-fluid cardimg" alt="" /></div>
                                    <div class="col-sm-8 col-md-8">
                                        {!! Form::label('card', 'Card:') !!}
                                        {!! Form::select('credit_card_id', $customercard, null, ['class' => 'effect-1']) !!}
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label for="amount">Amount:</label>
                            <input type="text" id="amount" name="amount" class="form-control effect-1" aria-describedby="emailHelp" placeholder="Please Enter Amount" value="{{ $invoices['total'][0] + $invoices['total'][1]/100 }}">
                            <span class="focus-border"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-4 text-center">
                            <div class="finalsendbtn">
                                <a class="addLine" ><button type="button" class="btn btn1 sendbtn2 new-card-btn">Add New Card</button></a>
                            </div>
                        </div>

                        <div class="form-group col-sm-12 col-md-4">

                        </div>

                        <div class="form-group col-sm-12 col-md-4">
                            <div class="finalsendbtn">
                                <button type="submit" class="btn btn1 sendbtn2"><span class="fas fa-location-arrow"></span> Make Payment</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@push('js')
<script>
	$(function(){
        let currentPage         = window.location.pathname,
            monthlyBillingLink  = $('.monthly-billing-link'),
            billingHistoryLink  = $('.billing-history-link')
            accountPageLink     = $('.account-page-link');

        if (currentPage.includes('customer-plans')) {
            monthlyBillingLink.css('color', '#1db4cb');
            monthlyBillingLink.css('border-bottom', '2px solid #1db4cb');
        } else if (currentPage.includes('history')) {
            billingHistoryLink.css('color', '#1db4cb');
            billingHistoryLink.css('border-bottom', '2px solid #1db4cb');
        } else if (currentPage.includes('account')) {
            accountPageLink.css('color', '#1db4cb');
            accountPageLink.css('border-bottom', '2px solid #1db4cb');
        }

		$("#make-payment-form").on("submit", function(e) {
            e.preventDefault();
            if ($('#make-payment-form').valid()) {
                makePayment();
            }
        });

        $("body").on('click', '.new-card-btn', function(e) {
            $('.close').click();
            setTimeout(function(){ window.location.href = '{{url("account")}}#addCard'; }, 500);
        });

        $('#make-payment-form').validate({
            rules: {
                credit_card_id:   "required",
                amount: {
                    required:       true,
                    min:            0.01,
                },
            },
            messages: {
                credit_card_id:   "Please Select Card ",
                amount: {
                    required:       "Please provide Amount",
                    min:            "Amount Should be greater then 0",
                },

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

		function makePayment() {
	        let formData = $('#make-payment-form').serialize();
	        $.ajax({
	            type: 'POST',
	            url: '{{ route('make.payment') }}',
	            dataType: 'json',
	            data:formData,
	            beforeSend: showLoader,
	            success: function (data) {
	                if(data.message){
	                    swal("Error!", data.message , "error");
	                }else{
	                    swal("Success!",'Payment Sucessfull!' , "success");
                        $('#paymentModal .close').click();
	                }
	            },
	            complete: hideLoader,
	            error: function (xhr,status,error) {
	                swal("Error!", "Sorry Something went wrong", "error");
	            }
	        });
	    }
	});

	function showLoader() {
        $('.myOverlay').removeClass('d-none');
        $('.loadingGIF').removeClass('d-none');
    }

    function hideLoader() {
        $('.myOverlay').addClass('d-none');
        $('.loadingGIF').addClass('d-none');
    }
</script>
@endpush
