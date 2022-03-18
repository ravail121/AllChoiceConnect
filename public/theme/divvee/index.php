<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo APP_TITLE; ?></title>
	<?php include('templates/head.php'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
	<?php include 'templates/header.php'; ?>

	<section class="hero">
		<div class="wrapper">
			<h1>Welcome Divvee.Social Members <span>Home to exclusive wireless plans and services * <br />  
Created specifically for you and your Divvee.Social team!</span></h1>
			<a href="plans.php">Explore Plans <i>></i></a>
			<p class="note">* Please note that presently, all Divvee Wireless plans and services are ONLY available to US based Divvee.Social members and their team; <br />
however, we are in the process of adding International coverage, plans, and services.</p>
		</div>
	</section>

	<!-- <section class="save">
		<div class="wrapper">
			<h3>Save $5 or more per line!</h3>
			<p>Order 4+ voice lines &amp; receive $5 off each</p>
		</div>
	</section> -->
	
	<!-- REMOVE cover-over class when showing the save section -->
	
	<section class="home-features-whole">
		<div class="wrapper">
			<article>
				<h2>$35 UNLIMITED LTE</h2>
				<p>10GB Mobile HotSpot and HD Video Streaming</p> 
			</article>
			<article>
				<h2>$17 UNLIMITED PLAN</h2>
				<p>Hurry! Sale ends <span class="green">03/31/2017</span></p> 
			</article>
		</div>
	</section>

	<section class="homeFeatures">
		<div class="wrapper"> 
			<article class="long bringPhone">
				<h2 class="italic">Network of Tomorrow</h2>
				<p>Your connected device is only as strong as the network behind it.</p>
				<a href="<?=BASE?>plans.php">Get Started <i>></i></a>
				<img src="<?=BASE_IMG ?>phone.jpg" alt="phone">
			</article>

			<article class="short wifi-calling no-right">
				<h2 class="italic">Wi-fi Calling+</h2>
				<p>Now every Wi-fi connection works like a cell tower</p>
				<a href="<?=BASE?>plans.php">LEARN MORE<i>></i></a>
			</article>

			<article class="short bringFreinds">
				<h2>Bring your friends!</h2>
				<p>You’ll get $5 oﬀ your next Divvee Wireless bill.</p>
				<a href="#" class="text-green">Become an Affiliate <i>></i></a>
			</article>

			<article class="long expand-borders no-right clearfix"> 
  				<div class="border-div-wrapper">
  					<h2 >Unlimited Media Streaming</h2>
    				<p>Now you can enjoy unlimited streaming music and video from favorite services like Netflix, Youtbe, Pandora, iTunes, Spotify, and more.</p>	
    				<div class="details-wrp">
    						<a href="#" class="text-green">SEE LISTS <i>></i></a>
    						<ul class="list-unstyled">
    							<li><img src="<?=BASE_IMG ?>3rd-party-icons/netflix.png" /></li>
    							<li><img src="<?=BASE_IMG ?>3rd-party-icons/youtube.png" /></li>
    							<li><img src="<?=BASE_IMG ?>3rd-party-icons/pandora.png" /></li>
    							<li><img src="<?=BASE_IMG ?>3rd-party-icons/itunes.png" /></li>
    							<li><img src="<?=BASE_IMG ?>3rd-party-icons/spotify.png" /></li>
    						</ul>
    				</div>
    			</div>		 
			</article>
		<article class="long borders">
				<h2>Expand your borders</h2>
				<p>Use your phone to call Canada and use your LTE data in Canada, at no additional cost.</p>
				<a href="#">See Coverage</a>
			</article>
			<article class="short simple-setup no-right">
				<h2>Simple Setup</h2>
				<ul>
					<li><span class="bg-green-important">1</span> <p>Choose your package.</p></li>
					<li><span class="bg-green-important">2</span> <p>Verify your business</p></li>
					<li><span class="complete bg-green-important">3</span> <p>You’re mobilized. <em>Enjoy!</em></p></li>
				</ul>
			</article>

			<article class="super-long support no-right" >
				<h2 >24hr. Business Support.</h2>
				<p >At Divvee Wireless, we have your back. You will receive direct and dedicated membership account support for any issues that may unexpectedly arise.</p> 
				<a href="#" class="text-green">discover better service <i>></i></a>
				<img src="<?=BASE_IMG ?>why-join.png" alt="phone">
			</article>
		</div>
	</section>
	
	<?php include 'templates/footer.php'; ?>
</body>
</html>