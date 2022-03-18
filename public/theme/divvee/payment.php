<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Plan Payment : <?php echo APP_TITLE; ?></title>
	<?php include('templates/head.php'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
	<?php include 'templates/header.php'; ?>

	<section class="purchasePlans">
		<div class="wrapper">
			<ul class="steps">
				<li><a href="plans.php" class="complete"><span class="long">Choose a plan</span> <span class="short">Plan</span></a></li>
				<li><a href="verify.php" class="complete"><span class="long">Verify Your Business</span> <span class="short">Verify</span></a></li>
				<li><a href="payment.php" class="current"><span class="long">Payment Information</span> <span class="short">Payment</span></a></li>
				<li><a href="confirm.php"><span class="long">Confirmation</span> <span class="short">Confirm</span></a></li>
			</ul>

			
			<section class="paymentsWrapper cartMaxHeight">
				<div class="paymentStatus">
					<h1>Account Verified <img src="images/checkmark.png" alt="checkmark"></h1>
					<p class="eml">levi@cursorblue.com</p>

					<h4>Create a password</h4>
					<input type="password" name="password" placeholder="Password">
					<input type="password" name="confirmPassword" placeholder="Confirm Password">
				</div>

				<div class="paymentDetails-shipping">
					<h1>Payment Details</h1>
					<p><em>All Fields Required</em></p>

					<h4>Shipping Information</h4>
					<input type="text" name="shipping-fname" placeholder="First Name">
					<input type="text" name="shipping-lname" placeholder="Last Name">
					<input type="text" name="shipping-address1" placeholder="Address 1">
					<input type="text" name="shipping-address2" placeholder="Address 2">
					<input type="text" name="shipping-company" placeholder="Comapany">
					<input type="text" name="shipping-country" placeholder="Country">
					<input type="text" name="shipping-city" placeholder="City">
					<input type="text" name="shipping-state" placeholder="State/Province">
					<input type="text" name="shipping-zip" placeholder="Postal/Zip Code">
					<input type="tel" name="shipping-phone1" placeholder="Primary Phone">
					<input type="tel" name="shipping-phone2" placeholder="Alternitave Phone">
					<input type="email" name="shipping-email" placeholder="Email Address">
				</div>

				<div class="paymentDetails-billing">

					<h4>Billing Information</h4>
					<div class="sameAsShipping">
						<input type="checkbox" name="sameAsShipping" id="sameAsShipping">
						<label for="sameAsShipping">Use my shipping address for my billing</label>
					</div>
					<div class="bill-form">
						<input type="text" name="billing-fname" placeholder="First Name">
						<input type="text" name="billing-lname" placeholder="Last Name">
						<input type="text" name="billing-address1" placeholder="Address 1">
						<input type="text" name="billing-address2" placeholder="Address 2">
						<input type="text" name="billing-company" placeholder="Comapany">
						<input type="text" name="billing-country" placeholder="Country">
						<input type="text" name="billing-city" placeholder="City">
						<input type="text" name="billing-state" placeholder="State/Province">
						<input type="text" name="billing-zip" placeholder="Postal/Zip Code">
						<input type="tel" name="billing-phone1" placeholder="Primary Phone">
						<input type="tel" name="billing-phone2" placeholder="Alternitave Phone">
						<input type="email" name="billing-email" placeholder="Email Address">
					</div>
				</div>

				<div class="discount">
					<h4>Discount Code</h4>
					<input type="text" name="code" placeholder="Code">
					<button>Apply</button>
				</div>

				<div class="creditCardInfo">
					<h4>Payment Details</h4>
					<div class="autopay">
						<input type="checkbox" name="autopay" id="autopay" checked>
						<label for="autopay">Enroll in Auto-Pay <span>Uncheck to Opt-Out of Auto-Pay</span></label>
					</div>
					
					<div class="form">
						<div class="number"><input type="tel" name="number" placeholder="Credit Card Number"></div>
						<div class="cccards"><span class="fa fa-cc-visa"></span> <span class="fa fa-cc-mastercard"></span> <span class="fa fa-cc-discover"></span></div>
						<div class="exp"><input type="tel" name="exp" placeholder="EXP Date"></div>
						<div class="cvv"><input type="tel" name="cvv" placeholder="CVV">
						<div class="cardTip"><img src="images/card.png" alt="card"></div> 
						</div>
					</div>
				</div>


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
						<div class="button">
							<a href="confirm.php">Place Order <i class="fa fa-chevron-right"></i></a>
						</div>  
					</div> 
					<p class="fineprint">
						By placing your order, you agree to <a href="#">Divvee Wireless's</a> privacy notice and <a href="#">conditions of use</a>.
					</p>
				</div>
			</aside>

			<div class="showCart">
				<a href="#" class="openCart">(8) Total $90.00</a>
				<a href="confirm.php" class="next">Place Order <i>></i></a>
			</div>
		</div>
	</section>

	<?php include 'templates/footer.php'; ?>
</body>
</html>