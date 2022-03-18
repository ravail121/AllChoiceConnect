<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Plan Confirmation : <?php echo APP_TITLE; ?></title>
	<?php include('templates/head.php'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
	<?php include 'templates/header.php'; ?>

	<section class="purchasePlans">
		<div class="wrapper">
			<ul class="steps">
				<li><a href="plans.php"  class="complete"><span class="long">Choose a plan</span> <span class="short">Plan</span></a></li>
				<li><a href="verify.php" class="complete"><span class="long">Verify Your Business</span> <span class="short">Verify</span></a></li>
				<li><a href="payment.php" class="complete"><span class="long">Payment Information</span> <span class="short">Payment</span></a></li>
				<li><a href="confirm.php" class="current"><span class="long">Confirmation</span> <span class="short">Confirm</span></a></li>
			</ul>

			
			<section class="confirmationWrapper">
				<p class="orderNumber">Order <span>#TTWQP1P23520766</span></p>
				<p class="orderDate">Order Date <span>Apr 15, 2015</span></p>

				<h1>
					<img src="images-2/checkmark-big.png" alt="checkmark">
					Thank You!
					<span>Your order is processing</span>
				</h1>

				<table>
					<thead>
						<tr>
							<th colspan="2" class="item">Item</th>
							<th colspan="2" class="price">Price</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td class="item"> $30/Mo.</td>
							<td>$10 - Micro Sim</td>
							<td>$15 - International calling</td>
							<td class="price"> $55</td>
						</tr>

						<tr>
							<td class="item"> $30/Mo.</td>
							<td>$10 - Micro Sim</td>
							<td>$15 - International calling</td>
							<td class="price"> $55</td>
						</tr>
					</tbody>

					<tfoot>
						<tr>
							<td>
								<div class="divfoot">
									<div>Subtotal</div> 
									<div><span>$0.00</span></div>
								</div>
								<div class="divfoot">
									<div>Coupon</div> 
									<div><span>$0.00</span></div>
								</div>
								<div class="divfoot">
									<div>Tax</div> 
									<div><span>$0.00</span></div>
								</div>
							</td>
							<td colspan="3"><h6>Total <span>$110.00</span></h6></td>
						</tr>
					</tfoot>
				</table>

				<ul class="billingShipping">  
					<li>
						<h6>Billing Information</h6>
						<p>YISROEL LIPSZYC <br />
							473 CROWN ST <br />
							BROOKLYN, NY 11225-3119</p>
					</li>

					<li>
						<h6>Shipping Information</h6>
						<p>YISROEL LIPSZYC <br />
							473 CROWN ST <br />
							BROOKLYN, NY 11225-3119</p>
					</li>
				</ul>

				<div class="rating">
					<h5>How was your shopping experience?</h5>

					<ul>
						<li><a href="#">*</a></li>
						<li><a href="#">*</a></li>
						<li><a href="#">*</a></li>
						<li><a href="#">*</a></li>
						<li><a href="#">*</a></li>
					</ul>
				</div>
			</section>
			



			<aside class="login">
				<h6>Sign into your account</h6>

				<form action="#" method="post">
					<ul>
						<li><input type="email" placeholder="Email" name="email"></li>
						<li><input type="password" placeholder="Password" name="password"><a href="#">Forgot?</a></li>
					</ul>

					<button class="button-custom">Sign In <i class="fa fa-chevron-right"></i></button>
				</form>

				<div class="twitter">
					<p>"I just got an awesome plan from Divvee Wireless!"</p>

					<a href="#">Share on twitter <i>t</i></a>
				</div>
			</aside>
		</div>
	</section>

	<?php include 'templates/footer.php'; ?>
</body>
</html>