@extends('layouts.app')

@section('content')
	<section class="choose-device-content">
		<div class="container">
		
			<div class="row text-center compatible_row col-lg-12 col-md-12 co-sm-12 col-xs-12"> 
		
			@if( Session::has( 'message_imeiwrong' ))
			<div class="error_an_www">{{ Session::get( 'message_imeiwrong' ) }}</div>
			@endif
				<h1 class="content-title">BRING YOUR OWN DEVICE </h1>
				<p class="f14 add-top-18">Love your phone? Bring it over to Teltik. Just ensure that your device is unlocked and ready to use on the network. Simply select your device model or enter the IMEI number below for the instant compatibility result.<br><br>Your contacts, emails, apps will all stay right where they are. You can even keep your number and bring it over to Teltik too. </p>
				<div class="add-top-6 xs-add-top-4">
					<div class="checkout-section">
						<div class="">
							<div class="col-md-5 col-sm-5 col-xs-12 left-con">
							<h3 class="blue_title">Quick check by brand & model</h3>
					<form method="get" action="{{url('/compatible')}}" accept-charset="UTF-8" class="class_compiti" novalidate="novalidate">{{csrf_field()}}

						<div class="">
							<div class="form-group add-bottom">
                                <select name="phone_brandan" id="phone_brandan" class="form-control">
                <option selected="selected" disabled="disabled">Select a Brand</option>
				@if (count($data_brands) != 0)
					@foreach($data_brands as $key => $data_brand)
					<option value="{{$data_brand->name}}" >{{ $data_brand->name }}</option>
					@endforeach
				@endif	
			 </select>
			  
			  <select name="phone_modelan" id="phone_modelan" class="form-control" disabled>
                <option selected="selected" >Select a Model</option>
              </select>
							</div>
						</div>
					<br/>
			
                    
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 compitimle_h2_or">
				<h3 class="compitible_color_h2"> OR </h3>
				
			</div>
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 right_com_div">
				<h3 class="blue_title">Best results by IMEI number</h3>
				<input type="text" id="imei" name="imei" placeholder="Enter your phone’s 15-17 digit IMEI" pattern="[0-9]" minlength="15" maxlength="17" >
				<div class="phone_deails">
					<p>1. Enter *#06# on your phone’s dial pad. Some carriers don’t allow you to access (Verizon)</p>
					<p>OR</p>
					<p>2. Check in the settings:</p>
					<ul>
						<li>Android: Go to Settings > About device > Status</li>
						<li>iPhone: Go to Settings > General > About</li>
					</ul>
				</div>
				
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<button class="add-top-2 btn style2 add-bottom-2 create-customer" type="submit" id="create-customer-button" onClick="return checker();">Check Compatability</button>
				<div class="error_an"></div>				
			</div>
			
			
			</form>
			
			
			
		</div>
	</div>


					

		</div>
		
	</div>
</div>
      <!-- Trigger the modal with a button -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	   
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body mobile_vompit text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mobile_img">
		<img src="{{ asset('theme/img/Phone12small.jpg') }}" class="img-responsive center-block main_mobile" alt="hero" style="width:100%;">
		<img class="center-block mobilecmpt_circle" src="{{ asset('theme/newstyle/img/index_cross.png') }}">
			
			
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mobile_decription">
			
			<h3 class="mo_title"><b>{{ Session::get( 'message_devicename' ) }}</b></h3>
			<p>It looks like your <b> <{{ Session::get( 'message_devicename' ) }}></b> isn’t compatible with us. No biggie, upgrade your phone to one that is <b>4G LTE,</b> and <b>VoLTE</b> friendly before you join Mint. We've got options.</p>
			
			<h3 class="device">Device: <span class="comptible"> Not compatible</span></h3>
		
			<h5 class="comp_mess">Remember, you must have an unlocked phone in order to use the Teltik service.<h5>
			
		</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 button_res text-center">
				<a href="#" class="update_phoe">Check another device </a>
			
			</div>
			
	  
      
      </div>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> ---->
    </div>
    
	
	

  </div>
</div>   

<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
   <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	   
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body mobile_vompit text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mobile_img">
		<img src="{{ asset('theme/img/Phone12small.jpg') }}" class="img-responsive center-block" alt="hero" style="width:100%;">
		<img class="center-block mobilecmpt_circle" src="{{ asset('theme/newstyle/img/index_tick.png') }}">
			
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mobile_decription">
			
			<h3 class="mo_title"><b>{{ Session::get( 'message_devicename' ) }}</b></h3>
			<p>Your <b><{{ Session::get( 'message_devicename' ) }}></b> is a perfect fit with our service.</p>
			
			<h3 class="device">Device: <span class="comptible"> COMPATIBLE</span></h3>
			
			<h5 class="comp_mess">Remember, you must have an unlocked phone in order to use the Teltik service.<h5>
			
		</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 button_res text-center">
				<a href="#" class="update_phoe">Upgrade your Phone </a>
			
			</div>
	  
      
      </div>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> ---->
    </div>
	
	

  </div>
</div> 

</section>


@endsection

@push('js')
@if( Session::has( 'message_compatibility' ))
<script>

$(document).ready(function(){
 $('#myModal2').modal('show');
});

</script>
@endif

@if( Session::has( 'message_NOTCOMPATIBLE' ))
<script>

$(document).ready(function(){
 $('#myModal').modal('show');
});

</script>
@endif 
<script>

  function checker()
	  {
		  
			 var text1 = $('#imei').val().length;

			  
			 if (text1 > 0 )            
			 {            
				 if(text1 < 15){
					
					 $(".error_an").html("Please Enter Valid IMEI Information.")
					return false;
				 }
			 }
			var selectedbrand_chk = $('#phone_modelan').val();
				$('#phone_brandan').change(function(){
						 selectedbrand_chk = $('#phone_modelan').val();		
				});						
			
			 if( selectedbrand_chk == 'Select a Model' && text1 == '')
			 {
				 
					$(".error_an").html("Please Enter Valid IMEI Information.");
					return false;
			 }
			 
		}

$(document).ready(function(){
	
	      $("#imei").bind("keypress", function (e) {

          var keyCode = e.which ? e.which : e.keyCode

               

          if (!(keyCode >= 48 && keyCode <= 57)) {

           // $(".error").css("display", "inline");

            return false;

          }else{

            //$(".error").css("display", "none");

          }

      });
	

   
	$('#phone_brandan').change(function(){
		var selectedbrand = $(this).val();
		//alert(selectedbrand);
		$.ajax({
			method: 'GET',
			url: '{{ Request::url() }}/model_value',
			data: {brand: selectedbrand},
			success: function( response ){
				//alert( response );
				$('#phone_modelan').html(response);
				
				 $('#phone_modelan').removeAttr("disabled", false);
				
			},
			error: function( e ) {
				console.log(e);
			}
		});
		
	});
	 
	
});
</script>
@endpush


