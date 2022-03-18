<?php include '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=BASE;?>">
	<meta charset="UTF-8">
	<title>Monthly Billing - <?=APP_TITLE; ?></title>
	<?php include('../templates/head.php'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
	<?php include '../templates/header.php'; ?>

	<section class="cp">
		<div class="wrapper">

			<ul class="cpNav">
				<li class="active"><a href="<?=BASE;?>cp/">Monthly Billing</a></li>
				<li><a href="<?=BASE;?>cp/history.php">Billing History</a></li>
				<li><a href="<?=BASE;?>cp/account.php"><span>Welcome</span>Tsuriel Eichenstein <i>.</i></a></li>
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
				<section class="billGlance cp-section">
					<h1>Your Bill</h1>
					<p>Charges for June 15, 2015 to July 15, 2015. <span>You are enrolled in auto-pay. <a href="<?=BASE;?>cp/account.php">Edit</a></span></p>

					<ul>
						<li>
							<h4>Latest Bill</h4>
							$49<sup>.82</sup>
						</li>

						<li>
							<h4>Credits</h4>
							$0<sup>.00</sup>
						</li>

						<li>
							<h4>Past Due</h4>
							$0<sup>.00</sup>
						</li>

						<li>
							<h4>Total Due</h4>
							$49<sup>.82</sup>
							<span>06/14/2015</span>
						</li>
					</ul>
				</section>

				<section class="billPlans cp-section">
					<h1>My Plans</h1>

					<ul class="billPlans-lines">

						<li class="billPlans-line">
							<ul class="billPlans-details">
								<li>
									<figure>
										<img src="<?=BASE;?>images/bill-phone1.jpg" alt="phone">
									</figure>

									<dl>
										<dt>LG G4</dt>
										<dd><strong>347-774-6543</strong></dd>

										<dt>Price</dt>
										<dd>$15.00</dd>
									</dl>
								</li>

								<li>
									<dl>
										<dt>Plan</dt>
										<dd>Bronze</dd>

										<dt>Features</dt>
										<dd>--</dd>
									</dl>
								</li>

								<li>
									<dl>
										<dt>IMEI</dt>
										<dd class="imei">
											<input type="text" name="imei" value="00000000000000000" disabled>
											<p>
												<a href="#" class="savePlanOption">Save</a>
												<a href="#" class="cancelPlanOption">Cancel</a>
											</p>
										</dd>

										<dt>Sim</dt>
										<dd class="sim">
											<input type="text" name="sim" value="00000000000000000000000" disabled>

											<p>
												<a href="#" class="savePlanOption">Save</a>
												<a href="#" class="cancelPlanOption">Cancel</a>
											</p>
										</dd>
									</dl>
								</li>
							</ul>

							<div class="menu">
								<a href="#" class="trigger">.</a>

								<ul>
									<li><a href="#" class="openUsage">See Usage Activity</a></li>
									<li><a href="#">Activate a new phone</a></li>
									<li><a href="#" class="updateSim">Update SIM card</a></li>
									<li><a href="#" class="updateIMEI">Update IMEI</a></li>
									<li><a href="#">Change my plan</a></li>
									<li><a href="#">Report lost or stolen device</a></li>
								</ul>
							</div>
						</li>

						<li class="billPlans-line">
							<ul class="billPlans-details">
								<li>
									<figure>
										<img src="<?=BASE;?>images/bill-phone2.jpg" alt="phone">
									</figure>

									<dl>
										<dt>LG G4</dt>
										<dd><strong>347-774-6543</strong></dd>

										<dt>Price</dt>
										<dd>$15.00</dd>
									</dl>
								</li>

								<li>
									<dl>
										<dt>Plan</dt>
										<dd>Bronze</dd>

										<dt>Features</dt>
										<dd>--</dd>
									</dl>
								</li>

								<li>
									<dl>
										<dt>IMEI</dt>
										<dd class="imei">
											<input type="text" name="imei" value="00000000000000000" disabled>
											<p>
												<a href="#" class="savePlanOption">Save</a>
												<a href="#" class="cancelPlanOption">Cancel</a>
											</p>
										</dd>

										<dt>Sim</dt>
										<dd class="sim">
											<input type="text" name="sim" value="00000000000000000000000" disabled>

											<p>
												<a href="#" class="savePlanOption">Save</a>
												<a href="#" class="cancelPlanOption">Cancel</a>
											</p>
										</dd>
									</dl>
								</li>
							</ul>

							<div class="menu">
								<a href="#" class="trigger">.</a>

								<ul>
									<li><a href="#" class="openUsage">See Usage Activity</a></li>
									<li><a href="#">Activate a new phone</a></li>
									<li><a href="#" class="updateSim">Update SIM card</a></li>
									<li><a href="#" class="updateIMEI">Update IMEI</a></li>
									<li><a href="#">Change my plan</a></li>
									<li><a href="#">Report lost or stolen device</a></li>
								</ul>
							</div>
						</li>

						<li class="billPlans-line">
							<ul class="billPlans-details">
								<li>
									<figure>
										<img src="<?=BASE;?>images/bill-phone3.jpg" alt="phone">
									</figure>

									<dl>
										<dt>LG G4</dt>
										<dd><strong>347-774-6543</strong></dd>

										<dt>Price</dt>
										<dd>$15.00</dd>
									</dl>
								</li>

								<li>
									<dl>
										<dt>Plan</dt>
										<dd>Bronze</dd>

										<dt>Features</dt>
										<dd>--</dd>
									</dl>
								</li>

								<li>
									<dl>
										<dt>IMEI</dt>
										<dd class="imei">
											<input type="text" name="imei" value="00000000000000000" disabled>
											<p>
												<a href="#" class="savePlanOption">Save</a>
												<a href="#" class="cancelPlanOption">Cancel</a>
											</p>
										</dd>

										<dt>Sim</dt>
										<dd class="sim">
											<input type="text" name="sim" value="00000000000000000000000" disabled>

											<p>
												<a href="#" class="savePlanOption">Save</a>
												<a href="#" class="cancelPlanOption">Cancel</a>
											</p>
										</dd>
									</dl>
								</li>
							</ul>

							<div class="menu">
								<a href="#" class="trigger">.</a>

								<ul>
									<li><a href="#" class="openUsage">See Usage Activity</a></li>
									<li><a href="#">Activate a new phone</a></li>
									<li><a href="#" class="updateSim">Update SIM card</a></li>
									<li><a href="#" class="updateIMEI">Update IMEI</a></li>
									<li><a href="#">Change my plan</a></li>
									<li><a href="#">Report lost or stolen device</a></li>
								</ul>
							</div>
						</li>

					</ul>

					<div class="addNewLine">
						<a href="#" class="addLine">Add a new line <i>+</i></a> Add 4 or more lines and receive a discount of $5/line per month! <strong>Use Code <em>MULTI45</em></strong>
					</div>


					<div class="totals">
						<ul>
							<li>
								<span>Subtotal</span>
								$15.00
							</li>

							<li>
								<span>Fed Tax <em>$3 per line</em></span>
								$3.00
							</li>

							<li>
								<span>State Tax</span>
								$0.00
							</li>
						</ul>

						<div class="grandTotal"><span>Monthly Total</span> $49.82</div>
					</div>
				</section>
			</div>
		</div>
	</section>


	<div class="modal usageHistory">
		<div class="wrapper">
			<nav>
				<ul>
					<li data-tab="calling"><a href="#">Call Log</a></li>
					<li data-tab="sms"><a href="#">SMS</a></li>
					<li data-tab="data" class="active"><a href="#">Data</a></li>
				</ul>

				<a href="#" class="close">x</a>
			</nav>

			<ul class="usage">
				<li data-tab="calling">
					<h4>Call Log</h4>
					<p>For June 15, 2015 to July 15, 2015.</p>

					<div class="log">
						<table>
							<thead>
								<tr>
									<th></th>
									<th>Time</th>
									<th>Phone #</th>
									<th>Destination</th>
									<th>Minutes</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<th>7/22/15</th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th>7/22/15</th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>
							</tbody>
						</table>
					</div>
				</li>

				<li data-tab="sms">
					<h4>SMS</h4>
					<p>For June 15, 2015 to July 15, 2015.</p>

					<div class="log">
						<table>
							<thead>
								<tr>
									<th></th>
									<th>Time</th>
									<th>Phone #</th>
									<th>Destination</th>
									<th>Minutes</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<th>7/22/15</th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th>7/22/15</th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>

								<tr>
									<th></th>
									<td>2:23 PM</td>
									<td>516-815-7227</td>
									<td>Incoming</td>
									<td>9.0</td>
								</tr>
							</tbody>
						</table>
					</div>
				</li>

				<li data-tab="data" class="active">
					<h4>Data</h4>
					<p>For June 15, 2015 to July 15, 2015.</p>

					<dl>
						<dt>Data Remaining <span><em>0.6742GB</em> / 40 GB</span></dt>
						<dd><span style="width: 45%">&nbsp;</span></dd>

						<dt>3G/4G Data with Mobile Hotspot (shared)  <span><em>0.6742GB</em> / 40 GB</span></dt>
						<dd><span style="width: 20%">&nbsp;</span></dd>
					</dl>
				</li>
			</ul>
		</div>


	</div>


	<?php include '../templates/footer.php'; ?>
</body>
</html>
