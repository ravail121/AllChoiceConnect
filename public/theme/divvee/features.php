<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Features : <?php echo APP_TITLE; ?></title>
	<?php include('templates/head.php'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body style="background: white;">
	<?php include 'templates/header.php'; ?>

	<section class="phonesFeaturesHero">
		<div class="wrapper">
			<h1>MOBILE REDEFINED</h1>
			<p>No rate increases. No annual service contracts. No data overages. No limits. <br />Introducing the Un-contract</p>
			<a href="plans.php" class="button-custom">STARTS AT $25/<span class="font-size-10 no-padding-important">mo.</span> <span class="fa fa-chevron-right"></span></a>
			<img src="<?=BASE_IMG ?>feature.jpg" alt="hero">
		</div>
	</section>

	<section class="featuresSingles">
		<div class="wrapper">
			<article class="virtual-receptionist">
				<h3>Our Business Plan is Better than Ever!</h3>
				<div class="hero-lists">
						<ul class="list-unstyled">
							<li>
								<span class="icon-c fa fa-check-circle-o"></span>
								<span><strong>Unlimited</strong> Data</span>
							</li>
							<li>
								<span class="icon-c fa fa-check-circle-o"></span>
								<span><strong>Unlimited</strong> Talk</span>
							</li>
							<li>
								<span class="icon-c fa fa-check-circle-o"></span>
								<span><strong>Unlimited</strong> Text</span>
							</li>
							<li>
								<span class="icon-c fa fa-check-circle-o"></span>
								<span><strong>No Annual contacts</strong></span>
							</li>
						</ul>
						<ul class="list-unstyled">
							<li>
								<span class="icon-c fa fa-check-circle-o"></span>
								<span>Voicemail</span>
							</li>
							<li>
								<span class="icon-c fa fa-check-circle-o"></span>
								<span>Nationwide 4G LTE  T-Mobile Network</span>
							</li>
							<li>
								<span class="icon-c fa fa-check-circle-o"></span>
								<span>Caller ID</span>
							</li> 
						</ul>
						<ul class="list-unstyled">
							<li>
								<span class="icon-c fa fa-check-circle-o"></span>
								<span>Hot-Spot</span>
							</li>
							<li>
								<span class="icon-c fa fa-check-circle-o"></span>
								<span>3-Way Calling</span>
							</li>
							<li>
								<span class="icon-c fa fa-check-circle-o"></span>
								<span>#MusicFreedom</span>
							</li> 
							<li>
								<span class="icon-c fa fa-check-circle-o"></span>
								<span>Visual Voicemail</span>
							</li> 
						</ul>
					</div> 
			</article>

			<article class="smart-voicemail">
				<h3>No Contract</h3>
				<p>Customers today demand options and that’s why we feel that now is the right time to present Divvee Wireless Mobile as your best next option by giving your the option of choice. Divvee Wireless Mobile is completely free of contracts, giving you the ultimate in ﬂexibility in plan choice and features, depending on your very speciﬁc needs. </p> 
				<p>Folding these features into our members only platform allow us to pass savings on that are reserved for larger groups like ours. </p> 

				<p>We also guarantee that your rate will never increase as long as your a customer of Divvee Wireless Mobile.</p> 
				<a href="<?=BASE ?>plans.php">CHOOSE A PLAN &nbsp;<span class="fa fa-chevron-right"></span></a>
			</article> 

			<article class="never-miss-a-call">
				<h3>Bring Your Own Phone</h3>

				<p>We don't sell phones. That means we don't add the cost of it into your monthly bill. So buy a phone from wherever you want and have it unlocked or call your current provider and have them unlock your phone. Then bring it over to Driftor Mobile and start saving.</p> 
				<a href="<?=BASE ?>plans.php">BUT A PHONE FROM MILI STREET &nbsp;<span class="fa fa-chevron-right"></span></a>
			</article>
			<article class="hotspots">
				<h3>Hotspots</h3>
				<p>Working outside or out of range of WiFi? Some things just need to be done on a laptop. With free hotspot, you can tether any WiFi device and get done what you need to get when you need to get it done.  </p>  
			</article>  
			<article class="unlimitedData">
				<h3>Unlimited Data</h3>

				<p>All of our data plans include unlimited data. The only difference is the amount of 4G LTE data. So, you will NEVER be charged overages, but upon reaching data limits your speed is slowed up to 128 Kbps until the next billing cycle.</p> 
				<a href="<?=BASE ?>plans.php">GET YOUR NEW PLAN &nbsp;<span class="fa fa-chevron-right"></span></a>
			</article>
			<article class="wifiCalling">
				<h3>Wifi Calling</h3>
				<p>It's pretty simple. When you need to make a call, you need service that works. So even if your job takes you out of range of cell towers, WiFi calling will be there. Don't miss important details or create an angry client because of poor reception</p>  
				<p>This requires no app and comes at no additional cost. For all Harbor Mobile customes with a Wi-Fi Calling capable device.</p>
			</article> 
			<article class="musicFreedom">
				<h3>Unlimited Entertainment</h3>

				<p>Your data is important. You're not sending emoji or cat videos. You're sending files, graphs, charts, proposals, slideshows, and the things that make business run. So don't run out of data streaming music. Music freedom let's you listen while you work without burning through your data. </p>

				<a href="#">Compatible music services <i>></i></a>
				<img src="images/radio.png" alt="music">
			</article>
			<article class="dataStash">
				<h3>Rollover Data</h3>

				<p>Keep what you pay for. It's a simple concept. When you pay for high speed data from Harbor Mobile, that data is yours. You wouldn't charge a customer for parts and then keep what's left over, would you? So why would your carrier think they can?</p>

				<p>Your unused 4G LTE data will be rounded up to the next megabyte and rollover to the next month. And it's yours to use for the next 12 months.</p>

				<p>If you go with our $40 a month plan, we'll even throw in an extra 10 GB of 4G LTE to get you started. Of course, you could go with the $50 UNLIMITED 4G LTE and never worry about it, but that's up to you.</p>
			</article>
		</div>
	</section> 
	<?php include 'templates/footer.php'; ?>
</body>
</html>