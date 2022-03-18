<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Plans : <?php echo APP_TITLE; ?></title>
	<?php include('templates/head.php'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
	<?php include 'templates/header.php'; ?>

	<section class="purchasePlans">
		<div class="wrapper">
			<ul class="steps">
				<li><a href="plans.php" class="current"><span class="long">Choose a plan</span> <span class="short">Plan</span></a></li>
				<li><a href="verify.php" ><span class="long">Verify Your Business</span> <span class="short">Verify</span></a></li>
				<li><a href="payment.php"><span class="long">Payment Information</span> <span class="short">Payment</span></a></li>
				<li><a href="confirm.php"><span class="long">Confirmation</span> <span class="short">Confirm</span></a></li>
			</ul>

			<section class="plansWrapper cartMaxHeight">
				<div class="plans-heading">
					<h2>We make taking care of businesses our business!</h2>
					<p>THAT'S WHY ALL PLANS INCLUDE:</p>  
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
								<span><strong>No contacts</strong></span>
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
								<span>Visual Voicemail</span>
							</li> 
						</ul>
					</div>
					<a href="<?=BASE?>features.php" class="see-all-features">SEE ALL FEATURES <i class="fa fa-chevron-right"></i></a>
					<div class="note">*Once data allowance has been depleted, speeds will be throttled up to 128kbps</div>  
				</div>
				<p class="notes">* Please note that presently, all Divvee Wireless plans and services are ONLY available to US based Divvee.Social members and 
their team; however, we are in the process of adding International coverage, plans, and services.</p>
				<div class="clearfix label-plans">
					<h5>DIVVEE SOCIAL MOBILE PLANS</h5>
				</div>
				<ul class="plans">
					<li>
						<span class="free">FREE</span>
						<h6><sup>$</sup>49.95<sub>/Mo.</sub></h6>
						<ul>
							<li>1st month <span class="red uppercase">free</span></li>
							<li><strong class="red"><i>Fast start to Free Service</i></strong></li>
							<li><em>Unlimited</em></li>
							<li>Talk, Text and Web</li>
							<li><em>Unlimited</em></li>
							<li>+ 2.5GB High Speed 4G LTE (thru 2015)</li>
							<li>w. Mobile Hot Spot</li>
						</ul>

						<a href="#">Select</a>
						
					</li>

					<li>
						<h6><sup>$</sup>24.95<sub>/Mo.</sub></h6>
						<ul>
							<li><em>Unlimited</em></li>
							<li>Talk, Text and Web</li>
							<li>+ 2.5GB High Speed 4G LTE (thru 2015)</li>
							<li>w. Mobile Hot Spot</li>
						</ul>

						<a href="#">Select</a>
						
					</li>

					<li>
						<span class="new">New</span>
						<h6><sup>$</sup>74.95<sub>/Mo.</sub></h6>
						<ul>
							<li><em>Unlimited</em></li>
							<li>Talk, Text and Web</li>
							<li>+ 2.5GB High Speed 4G LTE (thru 2015)</li>
							<li>w. Mobile Hot Spot</li>
						</ul>

						<a href="#">Select</a>
						
					</li> 
					<li>
						<h6><sup>$</sup>89.95<sub>/Mo.</sub></h6>
						<ul>
							<li><em>Unlimited</em></li>
							<li>Talk, Text and Web</li>
							<li>+ 2.5GB High Speed 4G LTE (thru 2015)</li>
							<li>w. Mobile Hot Spot</li>
						</ul>

						<a href="#">Select</a>
						
					</li>  
					<li>
						<h6><sup>$</sup>99.95<sub>/Mo.</sub></h6>
						<ul>
							<li><em>Unlimited</em></li>
							<li>Talk, Text and Web with</li>
							<li>40gigs High Speed 4G LTE Data</li>
							<li>+ Mobile Hot Spot</li>
						</ul>

						<a href="#">Select</a>
						
					</li>  
					<li>
						<h6><sup>$</sup>99.95<sub>/Mo.</sub></h6>
						<ul>
							<li><em>Unlimited</em></li>
							<li>Talk, Text and Web with</li>
							<li>40gigs High Speed 4G LTE Data</li>
							<li>+ Mobile Hot Spot</li>
						</ul>

						<a href="#">Select</a>
						
					</li>  
				</ul>
				<div class="clearfix label-plans">
					<h5>Divvee Wireless TABLET PLANS</h5>
				</div>
				<ul class="plans">
					<li>
						<h6><sup>$</sup>29.95<sub>/Mo.</sub></h6>
						<h5>Tablet Plan</h5>
						<ul>
							<li>Unlimited Web with</li>
							<li>2GB High Speed 4G LTE Data</li>  
						</ul> 
						<img src="images/tablet.svg" alt="tablet">
						<a href="#">Select</a>
						
					</li>  
					<li>
						<h6><sup>$</sup>39.95<sub>/Mo.</sub></h6>
						<h5>Tablet Plan</h5>
						<ul>
							<li>Unlimited Web with</li>
							<li>5GB High Speed 4G LTE Data</li>  
						</ul> 
						<img src="images/tablet.svg" alt="tablet">
						<a href="#">Select</a>
						
					</li>  
					<li>
						<h6><sup>$</sup>54.95<sub>/Mo.</sub></h6>
						<h5>Tablet Plan</h5>
						<ul>
							<li>Unlimited Web with</li>
							<li>10GB High Speed 4G LTE Data</li>  
						</ul> 
						<img src="images/tablet.svg" alt="tablet">
						<a href="#">Select</a>
						
					</li>  
				</ul>
			</section>
			
			<aside class="cart">
				<div class="cartWrapper">
					<a class="closing" href="#"><span class="fa fa-times"></span></a>
					<h5>Selected Plans</h5>
					<div class="cartPlans">
						<div class="selectedPlan">
							<i>X</i>
							<ul>
								<li>
									<p class="price"><sup>$</sup>30<sub>/Mo.</sub></p>
									<p class="description">Plus taxes, fees and monthly device payment</p>
								</li>

								<li>
									<p class="option">$10.00 - Sim Card</p>
									<p class="description">Micro</p>
								</li>
							</ul>
						</div>
						<div class="selectedPlan">
							<i>X</i>
							<ul>
								<li>
									<p class="price"><sup>$</sup>30<sub>/Mo.</sub></p>
									<p class="description">Plus taxes, fees and monthly device payment</p>
								</li>

								<li>
									<p class="option">$10.00 - Sim Card</p>
									<p class="description">Micro</p>
								</li>
							</ul>
						</div>

						<div class="selectedPlan">
							<i>X</i>
							<ul>
								<li>
									<p class="price"><sup>$</sup>30<sub>/Mo.</sub></p>
									<p class="description">Plus taxes, fees and monthly device payment</p>
								</li>

								<li>
									<p class="option">$10.00 - Sim Card</p>
									<p class="description">Micro</p>
								</li>
							</ul>
						</div>

						<div class="selectedPlan">
							<i>X</i>
							<ul>
								<li>
									<p class="price"><sup>$</sup>30<sub>/Mo.</sub></p>
									<p class="description">Plus taxes, fees and monthly device payment</p>
								</li>

								<li>
									<p class="option">$10.00 - Sim Card</p>
									<p class="description">Micro</p>
								</li>
							</ul>
						</div>

						<div class="selectedPlan">
							<i>X</i>
							<ul>
								<li>
									<p class="price"><sup>$</sup>60<sub>/Mo.</sub></p>
									<p class="description">Plus taxes, fees and monthly device payment</p>
								</li>

								<li>
									<p class="option">$15.00 - International</p>
									<p class="description">Calling</p>
								</li>

								<li>
									<p class="option">$10.00 - Sim Card</p>
									<p class="description">Micro</p>
								</li>
							</ul>
						</div>
					</div>

					<div class="total">
						<p class="tax">Tax: <span>$0.80<sub>/Mo.</sub></span></p>
						<p>Total: <span>$90.00<sub>/Mo.</sub></span></p>
					</div>

					<div class="button clearfix">
						<a href="verify.php" class="button-custom">Next Step   <i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</aside>

			<div class="showCart">
				<a href="#" class="openCart">(8) Total $90.00</a>
				<a href="verify.php" class="next" >Next Step <i>></i></a>
			</div>
		</div>
	</section>


	<div class="modal planOptions">
		<aside>
			<a href="#" class="close">x</a>
			<div class="glance">
				<h6><sup>$</sup>30<sub>/Mo.</sub></h6>
				<ul>
					<li><em>Unlimited</em></li>
					<li>Talk, Text and Web</li>
					<li>+ 2.5GB High Speed 4G LTE (thru 2015)</li>
					<li>w. Mobile Hot Spot</li>
				</ul>
				<a href="#">Add this Plan</a>
			</div>

			<div class="compatibility">
				<form action="#" method="post">
					<h6>
						Your device must be T-Mobile branded or GSM Unlocked 
					</h6>

					<!-- <input type="text" name="device-type" placeholder="What phone do you have"> -->
				</form>
			</div>

			<div class="coverage">
				<a href="#" class="openCoverage">Check Your coverage <i>></i></a>

				<div class="percent">
					<img src="images/map.png" alt="map">
					<span>96%</span>
				</div>
				<p>AT&amp;T covers 96% of you coast-to-coast where you live, work, and play. Plus, the Mobilizing your World is concentrated where more people are with less than 1% dropped calls.</p>
			</div>
		</aside>

		<div class="featuresWrapper">
			<div class="simOptions">
				<h3>Select your SIM <span>What kind of SIM do i need?</span></h3>

				<ul>
					<li>
						<input type="radio" name="sim-option" id="own">
						<label for="own">I will bring my own SIM card</label>
					</li>

					<li>
						<input type="radio" name="sim-option" id="new">
						<label for="new">I want to buy one - $10.00 <span>One time charge includes sim card + S&amp;H</span></label>
					</li>

					<li class="sim-types">
						<input type="radio" name="sim-type" id="standard">
						<label for="standard">Standard</label>

						<input type="radio" name="sim-type" id="micro">
						<label for="micro">Micro</label>

						<input type="radio" name="sim-type" id="nana">
						<label for="nana">Nano</label>
					</li>
				</ul>
			</div>

			<div class="portingOptions">
				<h6>Will you be porting in your number from your current carrier?
				<span>Please keep in mind you can <strong>not</strong> port an existing AT&amp;T number to our service.</span>
				</h6>

				<ul>
					<li>
						<input type="radio" name="proting" id="yes">
						<label for="yes">Yes</label>

						<input type="radio" name="proting" id="no">
						<label for="no">No</label>
					</li>
				</ul>

				<form action="#" method="post">
					<p>Please enter the number you would like to port</p>
					<input type="tel" name="port-number" placeholder="000-000-0000">
				</form>
			</div>

			<div class="addOns">
				<h3>Add-On Features</h3>

				<ul>
					<li>
						<input type="checkbox" name="international" id="international">
						<label for="international">International Calling - $15.00</label>
						<ul>
							<li>Add Unlimited International landline and mobile calling to your plan:</li>
							<li>Unlimited mobile-to-landline calling to 70+ countries</li>
							<li>Unlimited mobile-to-mobile to 30+ countries</li>
							<li>1,000 mobile-to-mobile minutes/mo. to Mexico</li>
						</ul>
					</li>
					<li>
						<input type="checkbox" name="nameID" id="nameID">
						<label for="nameID">Name ID - $5.00</label>
						<p>This service shows you the names in addition to the phone numbers of your callers, even if they're not in your address book.</p>
					</li>
				</ul>
			</div>
		</div>
		<a href="#" class="addThisMobile">Add This Plan</a>

	</div>

	<?php include 'templates/footer.php'; ?>
</body>
</html>