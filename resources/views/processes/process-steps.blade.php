<div class="row no-margin">
	<ul class="process-steps" style='display:flex; flex-direction:row; justify-content:center; align-items:center;'>
		{{-- <li class="">
			<div class="circle"></div>
			<div class="bar"></div>
			<span>Choose Device</span>
		</li> --}}
		<li class="">
			<div class="circle"></div>
			<div class="bar"></div>
			<span>Choose Package</span>
        </li>
        @if($verificationStatus)
            <li class="">
                <div class="circle"></div>
                <div class="bar"></div>
                <span>Verify Your Business</span>
            </li>
        @endif
		<li class="">
			<div class="circle"></div>
			<div class="bar"></div>
			<span>Checkout</span>
		</li>
        @if($verificationStatus)
		<li class="">
        @else
        <li class="remove-line">
        @endif   
			<div class="circle"></div>
			<div class="bar"></div>
			<span>Confirmation</span>
		</li>
	</ul>
</div>
