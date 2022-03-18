<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Plan Verification : <?php echo APP_TITLE; ?></title>
	<?php include('templates/head.php'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
	<?php include 'templates/header.php'; ?>

	<section class="purchasePlans">
		<div class="wrapper">
			<ul class="steps">
				<li><a href="plans.php" class="complete"><span class="long">Choose a plan</span> <span class="short">Plan</span></a></li>
				<li><a href="verify.php"  class="current"><span class="long">Verify Your Business</span> <span class="short">Verify</span></a></li>
				<li><a href="payment.php"><span class="long">Payment Information</span> <span class="short">Payment</span></a></li>
				<li><a href="confirm.php"><span class="long">Confirmation</span> <span class="short">Confirm</span></a></li>
			</ul>

			<section class="verifyWrapper cartMaxHeight">
				<div class="verify">
					<h1>Verify Your Business</h1>

					<div class="b-contact">
						<input type="text" name="fname" placeholder="First Name">
						<input type="text" name="lname" placeholder="Last Name">
						<input type="email" name="email" placeholder="Email Address">
					</div>
					<div class="clearfix">
						<a href="https://www.irs.gov/businesses/small-businesses-self-employed/apply-for-an-employer-identification-number-ein-online"  target="_blank" class="get-ein">Get EIN</a>
					</div>
					<div class="b-type">
						<div class="b-inputWrap">
							<input type="radio" name="btype" id="ein" value="ein">
							<label for="ein">I am a business (INC, LLC etc.) with a TAX ID/EIN</label>
						</div>

						<div class="b-inputWrap">
							<input type="radio" name="btype" id="sp" value="sp">
							<label for="sp">I am self employed, sole proprietor, contractor or other</label>
						</div>
					</div>

					<div class="b-credentials">
						<input type="text" name="dba" placeholder="DBA (if applicable)">
						<input type="text" name="tax" placeholder="Tax ID / EIN">
					</div>
				</div>

				<div class="proof">
					<h3>Please upload a business verification document <span class="red">*</span></h3>
					<p class="required-ein"><span class="red">*</span> Required if EIN not supplied above</p>
					<p class="note"><em>This may include a business registrativon, DBA form, sales and use form, or a business license or permit.</em></p>

					<div class="b-fileInput">
						<p>Upload a GIF, JPG, PNG, or PDF file</p>
						<input type="file" name="proof" id="proof">
						<a href="#" class="chooseTrigger button-custom">Choose File</a>
					</div>

					<div class="b-proofFile">
						<img src="images/proof.jpg" alt="proof">
						<p>24311961.png</p>
					</div>
				</div>

				<div class="b-submit">
					<input type="submit" class="button-custom" value="Request Verification Email">
					<p>Email should arive within the hour</p>
					<p>Click link verification email</p>
				</div>

			</section>

			<aside class="cart">
				<div class="cartWrapper">
					<a class="closing" href="#"><span class="fa fa-times"></span></a>
					<h5>Selected Plans</h5>
					<div class="cartPlans">
						<div class="selectedPlan"> 
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

					<div class="total verify-2">
						<p class="tax">Tax: <span>$0.80<sub>/Mo.</sub></span></p>
						<p>Total: <span>$90.00<sub>/Mo.</sub></span></p>
					</div> 
				</div>
			</aside>

			<div class="showCart">
				<a href="#" class="openCart">(8) Total $90.00</a>
				<a href="payment.php" class="next">Next Step <i>></i></a>
			</div>
		</div>
	</section>

	<?php include 'templates/footer.php'; ?>
</body>
</html>