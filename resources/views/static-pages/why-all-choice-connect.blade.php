@extends('layouts.app')

@section('content')

<section class="whyTeltik">

    <div class="wrapper">

        <h1>Why All Choice Connect?</h1>
       
    </div>

</section>
<!-- end content -->

<!-- FOOTER -->

<div class="map">
	<div class="close-map">x</div>
	<iframe src="https://maps.t-mobile.com/" frameborder="0"></iframe>
</div>


<div class="overlay">&nbsp;</div>

<div id="cart-drop-mobile">
	<a href="#" class="btn style1 btn-cart">
		<i class="fa fa-shopping-cart"></i>
		Your Cart (1)
	</a>
	<a href="#" class="btn style3 place-order-btn">Place Order</a>
	<div class="drop-con">
		
		<strong>Selected Solutions</strong>

		<ul class="cart-list">
			<li>
				<div class="img-wrap"></div>
				<div class="info">
					<table>
						<tr>
							<td>Device: iPhoneX</td>
							<td><strong>$340</strong></td>
						</tr>
						<tr>
							<td>Plan: <strong>N/A</strong></td>
							<td><strong>--</strong></td>
						</tr>
						<tr>
							<td>Sim Card: <strong>N/A</strong></td>
							<td><strong>--</strong></td>
						</tr>
						<tr>
							<td>Add-Ons: <strong>N/A</strong></td>
							<td><strong>--</strong></td>
						</tr>
					</table>
				</div>
				<div class="clearfix"></div>
				<div class="btn-set-action">
					<div class="text-right">
						<a href="#">
							<i class="fa fa-pencil"></i>
							Edit
						</a>
					</div>
					<div class="text-left">
						<a href="#">
							<i class="fa fa-trash-alt"></i>
							Remove
						</a>
					</div>
				</div>
			</li>
		</ul>

		<div class="summary">
			<table>
				<tr>
					<td>Subtotal:</td>
					<td>$69.95</td>
				</tr>
				<tr>
					<td>Shipping:</td>
					<td>$0.00</td>
				</tr>
				<tr>
					<td>Coupons:</td>
					<td>-$15.00</td>
				</tr>
				<tr>
					<td>Tax/Fees:</td>
					<td>$7.95</td>
				</tr>
			</table>
		</div>

		<div class="total">
			<table>
				<tr>
					<td>Account Credits</td>
					<td>-$27.00</td>
				</tr>
				<tr>
					<td><strong>Total Due Today</strong></td>
					<td><strong>$87.95</strong></td>
				</tr>
			</table>
		</div>

		<a href="#" class="btn">Place Order</a>

	</div>
</div>

@endsection

@push('js')

{!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') !!}
{!! Html::script('js/jquery.marquee.min.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}
{!! Html::script('js/functions.min.js') !!}
{!! Html::script('js/main.js') !!}

@endpush


<!-- end FOOTER -->

