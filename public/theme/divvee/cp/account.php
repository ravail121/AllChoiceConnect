<?php include '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=BASE;?>">
	<meta charset="UTF-8">
	<title>My Account - <?=APP_TITLE; ?></title>
	<?php include('../templates/head.php'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
	<?php include '../templates/header.php'; ?>

	<section class="cp">
		<div class="wrapper">
			
			<ul class="cpNav">
				<li><a href="<?=BASE;?>cp/">Monthly Billing</a></li>
				<li><a href="<?=BASE;?>cp/history.php">Billing History</a></li>
				<li class="active account-name"><a href="<?=BASE;?>cp/account.php"><span class="uncolored">Welcome</span>Tsuriel Eichenstein <i>.</i></a></li>
			</ul>

			<aside class="bill">
				<div class="billWrapper">
					<h3><span>Total Due</span> 06/14/2015</h3>
					<h2>$49<sup>.82</sup></h2>

					<a href="account.php" class="edit-billing">Edit Billing Preferences</a>

					<a href="#" class="button-custom">Make Payment</a>
				</div>

				<p class="fineprint">We will process your payment automatically in 0 days</p>

				<a href="#" class="addLine">Add a new line <i>+</i></a>
			</aside>

			<div class="cp-sections">
				
				<section class="cp-account cp-section">
					<h1>Account</h1>

					<ul>
						<li>
							<label>Name</label>
							<input type="text" name="name" value="Tsuriel Eichenstein" disabled>

							<div class="editMeControls">
								<a href="#" class="editMe">Edit</a>
								<a href="#" class="saveMe">Save</a>
								<a href="#" class="cancelMe">Cancel</a>
							</div>
						</li>

						<li>
							<label>Email</label>
							<input type="email" name="email" value="Tsuriel123@gmail.com" disabled>
							<div class="editMeControls">
								<a href="#" class="editMe">Edit</a>
								<a href="#" class="saveMe">Save</a>
								<a href="#" class="cancelMe">Cancel</a>
							</div>
						</li>

						<li>
							<label>Password</label>
							<input type="text" name="password" placeholder="*******" disabled>
							<div class="editMeControls">
								<a href="#" class="editMe">Edit</a>
								<a href="#" class="saveMe">Save</a>
								<a href="#" class="cancelMe">Cancel</a>
							</div>
						</li>

						<li>
							<label>Address</label>
							<input type="text" name="name" value="1490 Carroll St. Brooklyn NY 11213" disabled>
							<div class="editMeControls">
								<a href="#" class="editMe">Edit</a>
								<a href="#" class="saveMe">Save</a>
								<a href="#" class="cancelMe">Cancel</a>
							</div>
						</li>
					</ul>
				</section>


				<section class="cp-payment cp-section">
					<h1>Payment</h1>
					<div class="autopay">
						<input type="checkbox" name="autopay" id="autopay" checked>
						<label for="autopay">Enroll in Auto-Pay <span>Uncheck to Opt-Out of Auto-Pay</span></label>
					</div>

					<ul class="cp-paymentOptions">
						<li>
							<a href="#" class="openCard"><i>.</i></a>
							<figure>
								<img src="<?=BASE;?>images/visa.jpg" alt="visa">
							</figure>

							<div class="card">
								<span class="status">Primary</span>
								Visa Ending in 4433

								<div class="additinal">
									<span>Name on card</span>
									Levi Sudak
								</div>
							</div>

							<div class="expiry">
								<span class="expires">Expires</span>
								3171

								<div class="additinal">
									<span>Billing Address</span>
									1490 Carroll St <br> Brooklyn NY 11213 <br> 347 365 0436
								</div>
							</div>
						</li>

						<li>
							<a href="#" class="openCard"><i>.</i></a>
							<figure>
								<img src="<?=BASE;?>images/master.jpg" alt="visa">
							</figure>

							<div class="card">
								<span class="status"><a href="#">Make Primary</a></span>
								<div class="text">
									Visa Ending in 4433
								</div>

								<div class="inputs">
									<label for="card">Card</label>
									<input type="text" name="card" placeholder="**** **** **** 4433">

									<label for="cvv">CVV</label>
									<input type="text" name="cvv" placeholder="***">
								</div>

								<div class="additinal">
									<span>Name on card</span>
									<div class="text">
									Levi Sudak
									</div>

									<div class="inputs">
										<input type="text" name="exp" placeholder="Levi Sudak">
									</div>
								</div>
							</div>

							<div class="expiry">
								
								<span class="expires">Expires</span>
								<div class="text">
									3171
								</div>

								<div class="inputs">
									<input type="text" name="exp" placeholder="3171">
								</div>
								

								<div class="additinal">
									<div class="text">
										<span>Billing Address</span>
										1490 Carroll St <br> Brooklyn NY 11213 <br> 347 365 0436
									</div>

									<div class="inputs">
										<label>Address</label>
										<input type="text" name="address" value="1490 Carroll St">

										<label>City</label>
										<input type="text" name="city" value="Brooklyn">

										<label>State</label>
										<input type="text" name="state" value="NY">

										<label>Zip</label>
										<input type="text" name="zip" value="11213">
									</div>
								</div>
							</div>

							<div class="editCardControls">
								<a href="#" class="editCard">Edit</a>
								<a href="#" class="saveCard">Save</a>
								<a href="#" class="cancelCard">Cancel</a>
							</div>
						</li>
					</ul>
					
					<div class="addCard"  >
						<a href="#" class="addLine"> <span class="fa-plus-square fa"></span> &nbsp;&nbsp;&nbsp; Add a Credit Card</a>

						<form action="#" class="addCardForm" method="post" style="display: none;">
							
							<ul>
								<li>
									<label>
										<span>Card Number</span>
										<input type="text" name="card" placeholder="Card Number">
									</label>
								</li>

								<li class="half">
									<label>
										<span>Expiration Month</span>
										<select name="month">
											<?php foreach (range(1, 12) as $month): ?>
											<?php $month = ($month < 10 ? '0'.$month : $month); ?>
											<option value="<?=$month;?>"><?=$month;?></option>
											<?php endforeach ?>
										</select>
									</label>
								</li>

								<li class="half right">
									<label>
										<span>Expiration Year</span>
										<select name="year">
											<?php foreach (range(date('y'), date('y')+20) as $year): ?>
											<option value="<?=$year;?>"><?=$year;?></option>
											<?php endforeach ?>
										</select>
									</label>
								</li>

								<li class="cvv">
									<label>
										<span>CVV</span>
										<input type="text" name="cvv" placeholder="CVV">
										<img src="<?=BASE;?>images/card.png" alt="cvv">
									</label>
								</li>


								<li>
									<label>
										<span>Card Holder</span>
										<input type="text" name="cardholder" placeholder="Card Holder">
									</label>
								</li>

								<li>
									<label>
										<span>Country</span>
										<select name="country">
											<option value="US">USA</option>
										</select>
									</label>
								</li>

								<li>
									<label>
										<span>Address</span>
										<input type="text" name="address" placeholder="Address">
									</label>
								</li>

								<li>
									<label>
										<span>City</span>
										<input type="text" name="city" placeholder="City">
									</label>
								</li>

								<li>
									<label>
										<span>State</span>
										<input type="text" name="state" placeholder="State">
									</label>
								</li>

								<li>
									<label>
										<span>Zip</span>
										<input type="text" name="zip" placeholder="Zip">
									</label>
								</li>
							</ul>
							
							<div class="formButtons">
								<input type="reset" value="Cancel">
								<input type="submit" value="Save">
							</div>
						</form>
					</div>

				</section>

			</div>
		</div>
	</section>

	<?php include '../templates/footer.php'; ?>
</body>
</html>