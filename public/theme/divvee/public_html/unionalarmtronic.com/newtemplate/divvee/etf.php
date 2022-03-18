<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ETF - Harbor Mobile</title>
	<link rel="stylesheet" href="styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
	<?php include 'templates/header.php'; ?>


	<section class="etf">
		<div class="wrapper">
			<article class="etf-hero">
				<h1>There’s no reason to stay stuck anymore. <em>Break free.</em></h1>
				<p>Can’t get the phone or plan you want—all because you’re stuck in a dead-end service contract? Think again. We will pay your Early Termination Fee (ETF) with a Visa® Prepaid card or a check—and never make you sign another annual service contract.</p>
			</article>

			<article class="steps">
				<h3>Here is the low-down</h3>
				<ul>
					<li><span>1</span> Get up to $350 per line based on the Early Termination Fees (ETFs) stated on your carrier’s final bill. (Limit 10 per account)</li>

					<li><span>2</span> Keep your line on any of our qualifying plans active (must be a phone based voice/data plan, the wearable or data plan does not qualify) through Harbor for 120 consecutive days of service (After your 4th monthly payment)</li>

					<li><span>3</span> Submit a receipt indicating the purchase of a handset from any T-mobile store or T-mobile.com (within the last 60 days of day of purchase) and use that device on the line with Harbor. </li>
					<li><span>4</span> Port in your number from a qualifying plan/carrier within 20 days of signing up. (Port in # and number that has ETF charge must match)</li>
					<li><span>5</span> Submit your final bill within 60 days of signing up</li>
				</ul>
			</article>

			<article class="toDo">
				<h3>What you need to do</h3>

				<ul>
					<li><span>1. Download FINAL BILL</span> When you receive your current carrier’s final bill with your Early Termination Fees (ETFs) please submit <br> <br> (a) Document 1: Your final bill summary indicating the ETF charges <br> (b) Document 2: The detail page indicating the ETF charge and the number it was assessed to (This number and the number your are porting must match)</li>

					<li><span>2. PROOF OF DEVICE PURCHASE</span> Document 3: Submit receipt of payment for the device you purchased from a T-Mobile store or T-mobile.com. (Purchase must be within the 60 days of date of purchase from harbor and the port) </li>

					<li><span>3. Send it in or fill out the form below</span> Email <a href="mailtio:support@harbormobile.com">support@harbormobile.com</a> with subject ETF CREDIT within 2 calendar months of your initial purchase from Harbor. Limit 10 lines per account.</li>
				</ul>
			</article>

			<article class="request">
				<h3>ETF Request	<span>All Fields Required</span></h3>

				<form action="#" method="post" enctype="multipart/form-data">

				<ul class="elements">
					<li class="half"><input type="text" name="fName" placeholder="First Name" required></li>
					<li class="half right"><input type="text" name="lName" placeholder="Last Name" required></li>

					<li>
						<span class="tip">must be the same as your harbor mobile account</span>
						<input type="email" name="email" placeholder="Email Address" required>
					</li>

					<li>
						<input type="tel" name="phone[]" placeholder="Which Phone Number are you asking the ETF for?" required>
					</li>
				</ul>

				<a href="#" class="addNumber">Add a Number <i>+</i></a>

				<ul class="elements">
					<li class="half">
						<select name="carrier" required>
							<option>Carrier are you coming off</option>
							<option value="verizon">Verizon</option>
							<option value="att">AT&amp;T</option>
							<option value="sprint">Sprint</option>
						</select>
					</li>

					<li class="half right">
						<input type="text" name="device" placeholder="T-Mobile device you purchased" required>
					</li>

					<li class="half">
						<input type="tel" name="total" placeholder="Total ETF $ requested" required>
					</li>
				</ul>

				<div class="docs">
					<div class="fileInput">
						<p>Upload a JPG or PDF file</p>
						<input type="file" name="proof[]" id="proof" multiple>
						<a href="#" class="chooseTrigger">Attach Doc</a>
					</div>

					<ul class="files">
						<li>
							<img src="images/proof.jpg" alt="proof">
							<p>24311961.png</p>
						</li>

						<li>
							<img src="images/proof.jpg" alt="proof">
							<p>24311961.png</p>
						</li>

						<li>
							<img src="images/proof.jpg" alt="proof">
							<p>24311961.png</p>
						</li>
					</ul>
				</div>
				<input type="submit" value="Send ETF Request">
				</form>
			</article>

			<article class="fineprint">
				<p>Limited time offer; subject to change. At participating locations. Eligible device trade-in, new device purchase, qualifying credit, port-in from eligible carriers (incl. , Verizon, and Sprint), and qualifying postpaid service required. Payments consist of: (1) credit of device trade-in value, and (2) Visa® Prepaid Card in amount of carrier’s Early Termination Fee (card not redeemable for cash and expires in 12 months unless extended to 24 months). Sales tax on ETF not included. You must submit final bill showing ETF within 2 calendar months of port-in and be active and in good standing with T-Mobile when payment is processed; allow up to 8 weeks. Additional validation may be required. Up to 10 lines; all lines must be activated in same T-Mobile market with same billing address. One offer per subscriber. Check your contract with your carrier for your rights and obligations. Visa® Prepaid Card is rebate/reimbursement on new device, service, or port-in; for any tax implications of payment, consult a tax advisor.</p>
			</article>
		</div>
	</section>
	
	<?php include 'templates/footer.php'; ?>
</body>
</html>