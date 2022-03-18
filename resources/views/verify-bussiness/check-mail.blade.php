@extends('layouts.app')

@section('content')


<div class="global-wrap">

	<!-- content -->
	<section class="choose-device-content">
		<div class="container">

			<div class="row no-margin text-center">
				
				<div class="text-left verify-business-form">
						
					<div class="form-notif" style="margin-top: 0px;">
						<div class="form-notif-con">
							<h5>Your business verification documents have been sent for approval.</h5>
							<p>You Will Recieve An Email On Approval </p> <br>
							@if(!isset($message))
							@endif
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- end content -->
@endsection