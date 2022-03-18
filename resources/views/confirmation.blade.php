@extends('layouts.app')

@section('content')

	<!-- content -->
	<section class="choose-device-content">
		<div class="container">
			@include('processes.process-steps')

			<div class="row no-margin pad-top-10 text-center padding-left-right-10">
				<h1 class="content-title">Thank You!</h1>
				<p class="t-gray-2 bold f14 add-top-35 add-bottom-3">We are now processing your purchase!</p>
                <h4 class="t-gray-2 add-bottom-1">Click <a class="t-violet-2 download-invoice" href="{{ $url }}">here</a> to download your invoice for order number <span class="t-violet-2">{{ isset($cart['order_num']) ? $cart['order_num'] : '' }}</span></h4>
				<p class="t-gray-2 bold f12 add-bottom-3"> An email is also sent with attached invoice.pdf to your mail</p>

				<div class="add-top-6 xs-add-top-4">

					@if($cart)
						@foreach($cart['order_groups'] as $cart)
                            <span class='pricing-for-desktop'>@include('confirmation._pricing')</span>
                            <span class='pricing-for-phone'>@include('confirmation._pricing-mobile')</span>
						@endforeach

							<div class="confirm-calculation pull-right">

								<div class="confirm-calculation-holder1">
									<table>
										<tr>
											<td>Subtotal:</td>
											<td>$
												@isset($subtotalAmount)
													@if($subtotalAmount== 0)
                                                    	0
                                                    @else
                                                    	@convert($subtotalAmount)
                                                    @endif
												@else
													0
												@endisset
											</td>
                                        </tr>
                                        <tr>
                                            <td>Coupons/Credits:</td>
                                            <td>
                                                - $
                                                @isset($discount)
                                                	@if($discount== 0)
                                                    	0
                                                    @else
                                                    	@convert($discount)
                                                    @endif
                                                @else
                                                    0
                                                @endisset

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>State Tax:</td>
                                            <td>+ $
                                                @isset($tax)
                                                    @if($tax== 0)
                                                    	0
                                                    @else
                                                    	@convert($tax)
                                                    @endif
                                                @else
                                                    0
                                                @endisset

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Regulatory Fee:</td>
                                            <td>+ $
                                                @isset($regulatoryFees)
                                                    @if($regulatoryFees== 0)
                                                    	0
                                                    @else
                                                    	@convert($regulatoryFees)
                                                    @endif
                                                @else
                                                    0
                                                @endisset

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Fees:</td>
                                            <td>
                                                + $
                                                @isset($shipping)
                                                	@if($shipping)
                                                        @convert($shipping)
                                                    @else
                                                    	0
                                                    @endif
                                                @else
                                                    0
                                                @endisset

                                            </td>
                                        </tr>

									</table>
                                </div>

                                <div class="confirm-calculation-holder1">
                                    <table>
                                        <tr><br>
                                            <td><strong>Total Amount:</strong></td>
                                            <td>$
                                                @isset($totalAmount)
                                                    @if($totalAmount== 0)
                                                    	0
                                                    @else
                                                    	@convert($totalAmount)
                                                    @endif
                                                @else
                                                    0
                                                @endisset

                                            </td>
                                        </tr>
                                    </table>
                                </div>
								<div class="confirm-calculation-holder2">
									<table>
										<tr>
											<td><strong>Paid:</strong></td>
											<td><strong><span>USD</span> $
													@isset($totalAmount)
														@if($totalAmount== 0)
	                                                    	0
	                                                    @else
	                                                    	@convert($totalAmount)
	                                                    @endif
													@else
														0
													@endisset
												</strong>
											</td>
										</tr>
										<tr>
							                <td>Monthly Charge</td>
							                <td>$
                                                @if ($monthlyCharges)
                                                    {{ number_format($monthlyCharges, 2) }}
                                                @else
                                                    0
                                                @endif
                                            </td>
							            </tr>
									</table>

									<a href="{{ route('devices.index') }}" class="btn style2">Go Back To Shop</a>

								</div>

							</div>
					@endif

				</div>

			</div>
		</div>
	</section>
	<!-- end content -->

@endsection

@push('js')
	<script>
		$(function(){
            // runAlert();
            var cart = @json($cart);

			$('.no-margin > ul').addClass('step4');

			// $('.download-invoice').on('click', function(e){
			// 	e.preventDefault();
			// 	 $.ajax({
   //                      type: 'POST',
   //                      url: '{{-- route('download.invoice') --}}',
   //                      dataType: 'json',
   //                      data:{
   //                          order_hash : cart.order_hash,
   //                      },
   //                      beforeSend: showLoader,
   //                      success: function (data) {
   //                          console.log(data);
   //                      },
   //                      complete: hideLoader,
   //                      error: function (data) {
   //                          console.log('Error:', data);

   //                          alert('Something went wrong. Please try again later.');
   //                      }
   //                  });

			// });
		});


        // function runAlert() {
        //     swal({
        //         title: "Your Invoice is ready",
        //         text: "Click here to download",
        //         type: "success",
        //         confirmButtonText: "HERE",
        //     }, function() {
        //         window.location.href = "{{-- url('get/invoice/'.$orderHash) --}}";
        //     });
        // }
	</script>
@endpush
