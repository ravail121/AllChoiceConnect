<?php include '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=BASE;?>">
	<meta charset="UTF-8">
	<title>Billing History - <?=APP_TITLE; ?></title>
	<?php include('../templates/head.php'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
	<?php include '../templates/header.php'; ?>

	<section class="cp">
		<div class="wrapper">
			
			<ul class="cpNav">
				<li><a href="<?=BASE;?>cp/">Monthly Billing</a></li>
				<li class="active"><a href="<?=BASE;?>cp/history.php">Billing History</a></li>
				<li ><a href="<?=BASE;?>cp/account.php"><span>Welcome</span>Tsuriel Eichenstein<i>.</i></a></li>
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
				
				<section class="cp-history cp-section">
					<h1>Billing History</h1>
					
					<div class="table">
						<table>
							<thead>
								<tr>
									<th>Date</th>
									<th>Type</th>
									<th>Notes</th>
									<th>Amount</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>May 21, 2015 12:00pm</td>
									<td>Payment</td>
									<td>AutoPay account balance of $18</td>
									<td><strong>$122.00</strong></td>
								</tr>

								<tr>
									<td>May 21, 2015 12:00pm</td>
									<td>Payment</td>
									<td>Invoice for Period from 05-23-15 to 06-23-15</td>
									<td><strong>$122.00</strong></td>
								</tr>

								<tr>
									<td>May 21, 2015 12:00pm</td>
									<td>Payment</td>
									<td>AutoPay account balance of $18</td>
									<td><strong>$122.00</strong></td>
								</tr>

								<tr>
									<td>May 21, 2015 12:00pm</td>
									<td>Payment</td>
									<td>Invoice for Period from 2015-04-23 to 2015-05-23</td>
									<td><strong>$122.00</strong></td>
								</tr>
							</tbody>
						</table>
					</div>
				</section>

				<section class="cp-history cp-section">
					<h1>Open orders</h1>
					
					<div class="table">
						<table>
							<thead>
								<tr>
									<th></th>
									<th>Order Date</th>
									<th>Order Number</th>
									<th>Amount</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td><a href="#">View Tracking</a></td>
									<td>May 21, 2015 12:00pm </td>
									<td>3171</td>
									<td><strong>$122.00</strong></td>
								</tr>

								<tr>
									<td><a href="#">View Tracking</a></td>
									<td>May 21, 2015 12:00pm </td>
									<td>3171</td>
									<td><strong>$122.00</strong></td>
								</tr>

								<tr>
									<td><a href="#">View Tracking</a></td>
									<td>May 21, 2015 12:00pm </td>
									<td>3171</td>
									<td><strong>$122.00</strong></td>
								</tr>
							</tbody>
						</table>
					</div>
				</section>
			</div>
		</div>
	</section>

	<?php include '../templates/footer.php'; ?>
</body>
</html>