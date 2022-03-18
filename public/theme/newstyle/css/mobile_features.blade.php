@extends('layouts.app')

@section('content')
    <!-- ======= Hero Section ======= -->
	<div class="mobile_feature" style="background:#f6f5f5;">
	<section class="phonesFeaturesHero">
		<div class="wrapper">
			<h1>Mobilizing your World</h1>
			<p>No rate increases. No annual service contracts. No data overages. No limits. NO contract.</p>
			<a href="plans.php" style="font-size: 20px;" class="button-custom bluu">starts at $20/<span>mo.</span> <span class="fa fa-chevron-right"></span></a>
			<img src="{{ asset('theme/newstyle/img/84_New-Project.jpg') }}" alt="hero" style="width:100%;">
		</div>
		
	</section>
<section class="home-features-glance">
        <div class="wrapper">
            <div class="features">
                <h2>Our Plans are Better than Ever!</h2>

               <ul>
				<li><span>Unlimited</span> Data*</li>
				<li><span>Unlimited</span> Talk</li>
				<li><span>Unlimited</span> Text</li>
				<li>No Annual Contract</li>
				<li>Nationwide 4G LTE Network</li>
				<li>Caller ID</li>
				<li>Hot-Spot</li>
				<li>3-Way Calling</li>
				<!-- <li>#MusicFreedom</li> -->
				<li>Visual Voicemail</li>
				 <p class="fineprint pull-left">*4G LTE phone required.</p>
			</ul>

           
            </div>
        </div>
    </section>
	<section class="featuresSingles">
		<div class="wrapper">
			<article class="noContracts" style="background: white url('{{ asset('theme/newstyle/img/features-no-contract.jpg') }}') right center no-repeat;background-size: 30%;
padding-right: 35%;">
				<h3>No Contracts</h3>
				<p>The world of business requires constant adaption. It's hard to know what the next week will bring, much less the next 2 years. So why would you ever want to be stuck in a 2-year contract?</p>
				<p>Well, not anymore. Teltik Communications gives you the flexibility to shift with the ever-changing tides of business ownership. When your needs change, your plan can change. Simple, easy, and hassle-free. </p>
				<p>Teltik Communications gives you the best of both worlds: The power and perks of a big corporate network, plus the customer service and values that come from small business.  </p>
				<p>But what about my rates going up? Won't a contract lock in my price? Sure it will, but we guarantee your rate will never increase as long you're our customer. In fact, it may even go down. Try that with a contract.</p>

				<a href="plans_step1_choose.php">Choose a Plan <i>&gt;</i></a>
			</article>
		</div>	
 </section>





	<section class="featuresSingles">
		<div class="wrapper">
			

			<article class="never-miss-a-call">
				<h3>Bring Your Own Phone</h3>

				<p>We don't sell phones. That means we don't add the cost of it into your monthly bill. Any T-Mobile branded or properly unlocked device will work with our network. Bring a phone from wherever you want, but make sure it is unlocked or call your current provider and have them unlock your phone. Then bring it over to Teltik and start saving.</p> 
			</article>
			<article class="hotspots">
				<h3>Hotspots</h3>
				<p>Working outside or out of range of WiFi? Some things just need to be done on a laptop. With free hotspot, you can tether any WiFi device and get done what you need to get done, when you need to get it done.  </p>  
			</article>  
			<article class="unlimitedData">
				<h3>Unlimited Data</h3>

				<p>All of our plans include unlimited data. Upon depleting your 4G LTE data allotment your speeds are throttled to 128 Kbps until the next billing cycle, so there are NEVER any data overage fees.</p> 
				<a href="#">GET YOUR NEW PLAN &nbsp;<span class="fa fa-chevron-right"></span></a>
			</article>
			<article class="wifiCalling">
				<h3>Wifi Calling</h3>
				<p>It's pretty simple. When you need to make a call, you need service that works. So even if your job takes you out of range of cell towers, WiFi Calling will be there. Never miss an important call or frutrate your clients because of poor reception. </p>

				<p>This requires no app and comes at no additional cost. For all Teltik Communications customers with a Wi-Fi Calling capable device.</p>
			</article>
			<article class="musicFreedom">
				<h3>Unlimited Entertainment</h3>

				<p>Your data is important. As a business, you're sending files, graphs, charts, proposals, slideshows, and the things that make a business run. Never run out of data again with our unlimited entertainment feature. This feature lets you listen to music and stream videos (on qualifying plans) without burning through your data. </p>

				<a href="#" class="openApps">Compatible streaming services <i>&gt;</i></a>
				<img src="{{ asset('theme/newstyle/img/radio.png') }}" alt="music">
			</article>
			
			<article class="dataStash">
				<h3>Rollover Data</h3>

				<p>Keep what you pay for. It's a simple concept. When you pay for high speed data from Teltik Communications, that data is yours. You wouldn't charge a customer for parts and then keep what's left over, would you? So why would your carrier think they can?</p>

				<p>Your unused 4G LTE data will be rounded up to the next megabyte and rollover to the next month. And it's yours to use for the next 12 months.</p>

				<p>If you go with either of our $30 or $40 a month plans, you will qualify for this feature. Of course, you could go with the UNLIMITED 4G LTE plan and never worry about it, but that's up to you.</p>
			</article>
		

		</div>	
		</section>
			<div class="clearfix"></div>
<section class="plan-section">
  <div class="wrapper">
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-4 pr-0">
        <div class="plan-box">
          <div class="plan-header"></div>
          <ul class="list-unstyled">
            <li>Data included</li>
            <li>Mobile hotspot</li>
            <li>Streaming video</li>
            <li>Streaming audio</li>
            <li>Data Deprioritization</li>
            <li>Canada & Mexico Calling</li>
            <li>24 x 7 customer support</li>
            <li>5G Network compatible</li>
            <li>Contract</li>
        
          </ul>
        </div>
      </div>

      <div class="col-md-4 col-sm-4 col-xs-4 pl-0">
        <div class="plan-box text-center">
          <div class="plan-header">
            <h5>Teltik</h5>
          </div>
          <ul class="list-unstyled text-center">
            <li>Unlimited</li>
            <li>Included</li>
            <li>Yes</li>
            <li>Yes</li>
            <li>50GB</li>
            <li>YES</li>
            <li>YES</li>
            <li>YES</li>
            <li>NO</li>
          
          </ul> <a href="" class="gradient-button">CHOOSE A PLAN</a>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4 pl-0">
        <div class="plan-box">
          <div class="plan-header">
            <p>Other</p>
          </div>
          <ul class="list-unstyled text-center">
            <li>Unlimited</li>
            <li>Limited</li>
            <li>480p</li>
            <li>.5MBPS</li>
            <li>32GB</li>
            <li>NO</li>
            <li>NO</li>
            <li>NO</li>
            <li>YES</li>
            
          </ul>
        </div>
      </div>
	  

	  
	  
    </div>
  </div>
</section>
<!-- <section class="mobile_tab_pl">
	<div class="container">
		<div class="row">
			<div class="tab_mobile_plan_fea">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#data_include">Data included</a></li>
					<li><a data-toggle="tab" href="#mobile_hotspot">Mobile hotspot</a></li>
					<li><a data-toggle="tab" href="#streaming_video">Streaming video</a></li>
					<li><a data-toggle="tab" href="#streaming_audio">Streaming audio</a></li>
					<li><a data-toggle="tab" href="#data_deprior">Data Deprioritization</a></li>
					<li><a data-toggle="tab" href="#canada_calling">Canada & Mexico Calling</a></li>
					<li><a data-toggle="tab" href="#customer_support">24 x 7 customer support</a></li>
					<li><a data-toggle="tab" href="#network_compatible">5G Network compatible</a></li>
					<li><a data-toggle="tab" href="#contract">Contract</a></li>
		
				  </ul>

				  <div class="tab-content col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="data_include" class="tab-pane fade in active">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header teltik_plan">
								<p>Teltik</p>
							</div>
							<h2 class="text-center"> Unlimited</h2>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header other">
								<p>Other</p>
							</div>
							<h2 class="text-center"> Unlimited</h2>
						</div>
					</div>
					
					<div id="mobile_hotspot" class="tab-pane fade">
					  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header teltik_plan">
								<p>Teltik</p>
							</div>
							<h2 class="text-center"> Included</h2>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header other">
								<p>Other</p>
							</div>
							<h2 class="text-center"> Limited</h2>
						</div>
					  
					  
					</div>
					
					<div id="streaming_video" class="tab-pane fade">
					 
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header teltik_plan">
								<p>Teltik</p>
							</div>
							<h2 class="text-center"> Yes</h2>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header other">
								<p>Other</p>
							</div>
							<h2 class="text-center"> 480p</h2>
						</div>
					 
					</div>
					
					<div id="streaming_audio" class="tab-pane fade">
						
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header teltik_plan">
								<p>Teltik</p>
							</div>
							<h2 class="text-center"> Yes</h2>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header other">
								<p>Other</p>
							</div>
							<h2 class="text-center"> .5MBPS</h2>
						</div>
						
					</div>
					
					<div id="data_deprior" class="tab-pane fade">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header teltik_plan">
								<p>Teltik</p>
							</div>
							<h2 class="text-center"> 50GB</h2>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header other">
								<p>Other</p>
							</div>
							<h2 class="text-center"> 32GB</h2>
						</div>
					</div>
					
					<div id="canada_calling" class="tab-pane fade">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header teltik_plan">
								<p>Teltik</p>
							</div>
							<h2 class="text-center"> YES</h2>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header other">
								<p>Other</p>
							</div>
							<h2 class="text-center"> NO</h2>
						</div>
					</div>
					
					<div id="customer_support" class="tab-pane fade">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header teltik_plan">
								<p>Teltik</p>
							</div>
							<h2 class="text-center"> YES</h2>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header other">
								<p>Other</p>
							</div>
							<h2 class="text-center"> NO</h2>
						</div>
					</div>
					
					<div id="network_compatible" class="tab-pane fade">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header teltik_plan">
								<p>Teltik</p>
							</div>
							<h2 class="text-center"> YES</h2>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header other">
								<p>Other</p>
							</div>
							<h2 class="text-center"> NO</h2>
						</div>
					</div>
					
					<div id="contract" class="tab-pane fade">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header teltik_plan">
								<p>Teltik</p>
							</div>
							<h2 class="text-center"> NO</h2>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="plan-header other">
								<p>Other</p>
							</div>
							<h2 class="text-center"> YES</h2>
						</div>
					</div>
					
				  </div>
				</div>
			</div>
		</div>
	</div>
</section>---->




<section class="featuresSingles">
	<div class="wrapper">
			<article class="wifiCalling">
				<h3>Nationwide calling includes calls to Canada and Mexico. Why? Because we can.</h3>
			
				<p>We like keeping things simple, so rest assured that you can call all those numbers in your contact list and never get "that number is not in your calling area.</p>
			</article>
	</div>
</section>
<section class="total_security_peace">
  <div class="wrapper">
    <div class="row">
		<article class="wifiCalling_security col-md-offset-2 col-md-8 col-sm-8 col-xs-12">
			<h3>Total family security and peace of mind included with all plans. </h3>
			
			<p>The included OneTouch GPS service will allow you to instantly track loved ones. In addition, simply tap the SOS button on the app and you and your loved ones are instantly connected via 2-way video / audio + GPS with our team of trained emergency response agents. Help is dispatched. Simple.</p>
			<a href="{{url('/plans')}}" class="gradient-button plan_chose">CHOOSE A PLAN</a>
		</article>
		<div class="mob_fea_img">
			<div class="col-md-6 col-sm-6 col-xs-6 ">
				<img src="{{ asset('theme/newstyle/img/1608207851212.JPEG') }}" alt="hero" style="width:100%;">
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6 ">
				<img src="{{ asset('theme/newstyle/img/1608207851219.JPEG') }}" alt="hero" style="width:100%;">
			</div>			
		</div>

    </div>
  </div>
</section>


	
	</div>
	<div class="clearfix"></div>
@endsection
@push('js')

@endpush