<?php
include 'isloggedin.php';
include 'controller/generalController.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Title -->
	<title>Dashboard - SUAB Portal</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="DexignZone">
	<meta name="robots" content="">

	<meta name="keywords" content="summit, suab, tescode, tesleem, alumni">
	<meta name="description" content="">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon icon -->
	<link rel="icon" type="image/png" href="images/logo-full.png">

	<link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link rel="stylesheet" href="vendor/dotted-map/css/contrib/jquery.smallipop-0.3.0.min.css" type="text/css" media="all">
	<!-- Style css -->
	<link href="css/style.css" rel="stylesheet">
	<style>
		code.custom-code {
			background-color: green;
			color: #ffffff;
		}
	</style>
</head>

<body>

	<!--*******************
        Preloader start
    ********************-->
	<!-- <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
	</div> -->
	<!--*******************
        Preloader end
    ********************-->

	<!--**********************************
        Main wrapper start
    ***********************************-->

	<div id="main-wrapper">
		<!--**********************************
            Header start

        ***********************************-->
		<?php
		include './layout/header.php';
		?>

		<?php
		// var_dump('iii');
		?>
		<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

		<!--**********************************
            Sidebar start
        ***********************************-->
		<?php
		include './layout/side_nav.php';
		?>
		<!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">
				<!-- WELCOME USER -->
				<?php

				echo '<h2 style="text-align:center">WELCOME ' . $fullname . '</h2><br><br><br>';
				?>

				<!-- DISPLAY BOX START -->
				<!-- Button trigger modal -->
				<div class="row">
					<div class="authincation-content col-xl-6 col-md-6">
						<div class="row no-gutters">
							<div class="auth-form">
								<div class="text-center mb-3">
									<i class="bi bi-credit-card" style="font-size:50px"></i>
								</div>
								<div class="text-center">
									<h4>Make Payment</h4><br>
									<form action="" method="post">
										<input type="hidden" name="email" id="email_paystack" value="<?php echo $user_email ?>">
										<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
										<input type="hidden" name="amount" id="amount" value="10000">
										<button type="submit" name="payment" class="btn btn-success btn-block"> Proceed to payment <i class="bi bi-arrow-right"></i> </button>
									</form>
								</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Modal -->

					<?php

					if (isset($_POST['payment'])) {
						$reference_number = 'SUNALUMNI' . rand(0000000, 9999999);
						$amount = $_POST['amount'];
						$insertpayment =  "INSERT INTO  transactions (user_id, payment_type, amount, reference) 
							VALUES ('$user_id','alumni_due','$amount','$reference_number') ";
						$paymentQuery = mysqli_query($db_con, $insertpayment);
						if ($paymentQuery) {

					?>
							<div class="modal fade" id="makepayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content" style="background-color:#ffffff;">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Payment Modal</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body" style="color:black;">
											<p>You are about to make the payment and you will be redirect to paystack website to make the payment</p>
											<p>Note ! <b> =N= 300 </b> will be deducted as charges for the transactions </p>

											<label for="">Payment Reference Number</label>
											<input type="text" name="reference" readonly id="reference_paystack" class="form-control" value="<?php echo $reference_number; ?>">
										</div>
										<div class="modal-footer">
											<button class="btn btn-success btn-block" onclick="payWithPaystack()">Pay <i class="bi bi-credit-card"></i></button>
										</div>
									</div>
								</div>
							</div>
					<?php
						}
					}
					?>
					<div class="authincation-content col-xl-6 col-md-6">
						<div class="row no-gutters">
							<div class="auth-form">
								<div class="text-center mb-3">
									<i class="bi bi-printer" style="font-size:50px"></i>
								</div>
								<div class="text-center">
									<h4>Download Clearance</h4><br>
									<?php
									$approved = array();
									$getpayment = "SELECT * FROM transactions WHERE user_id = '$user_id' AND payment_status = 1";
									$payments = mysqli_query($db_con, $getpayment);
									$getResult = mysqli_num_rows($payments);
									if ($getResult > 0) {
										$tableNamejj = "approvals";
										$selectQuerypp = "SELECT * FROM $tableNamejj";
										$resultpp = mysqli_query($db_con, $selectQuerypp);
										if ($resultpp) {
											$numColumnspp = mysqli_num_fields($resultpp);
											$columnsInfopp = mysqli_fetch_fields($resultpp);

											for ($i = 2; $i < $numColumnspp; $i++) {
												if (checkApproval($user_id, $columnsInfopp[$i]->name) == 0) {
													$approved[] = 0;
												}
											}
										}

										if (!in_array(0, $approved)) {
										echo '<a target="_blank" href="clearance.php" class="btn btn-success btn-block"><i class="bi bi-download"></i> Download</a>';
										} else {
											echo '<button disabled class="btn btn-success btn-block"><i class="bi bi-download"></i> Download</button>';
										}
									} else {
										echo '<button disabled class="btn btn-success btn-block"><i class="bi bi-download"></i> Download</button>';
									}
									?>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="authincation-content col-xl-12 col-md-12">
						<div class="row no-gutters">
							<div class="">
								<div class="auth-form">
									<div class="mb-3">
										<h3><i class="bi bi-bell"></i> <span> Clearance Tracking Status</span></h3>
										<p>Below are the officers incharge to clear you and the status of there operations</p>
									</div>
									<table class="table table-striped">
										<thead>
											<tr>
												<th scope="col">S/NO</th>
												<th scope="col">Office</th>
												<th scope="col">Officer Incharge</th>
												<th scope="col">Status</th>
											</tr>

										</thead>
										<tbody>
											<?php
											$tableName = "approvals";
											$selectQuery = "SELECT * FROM $tableName";
											$result = mysqli_query($db_con, $selectQuery);
											$count = 1;
											if ($result) {
												$numColumns = mysqli_num_fields($result);
												$columnsInfo = mysqli_fetch_fields($result);
												for ($i = 2; $i < $numColumns; $i++) {
													if ($columnsInfo[$i]->name == 'doc') {
														$office = 'Dean of College';
													} elseif ($columnsInfo[$i]->name == 'hod') {
														$office = 'Head of Department';
													} elseif ($columnsInfo[$i]->name == 'dsa') {
														$office = 'Dean, Student Affairs';
													} elseif ($columnsInfo[$i]->name == 'riu') {
														$office = 'Research & Innovation Unit';
													} elseif ($columnsInfo[$i]->name == 'clinic') {
														$office = 'Director of Clinic';
													} elseif ($columnsInfo[$i]->name == 'sport') {
														$office = 'Director of Sports';
													} elseif ($columnsInfo[$i]->name == 'works') {
														$office = 'Director of Works';
													} else {
														$office = ucfirst($columnsInfo[$i]->name);
													}
											?>
													<tr>
														<th scope="row"><?php echo $count++; ?></th>
														<td><?php echo $office; ?></td>

														<td>
															<?php
															if (!empty(lecturer($columnsInfo[$i]->name))) {
																$name = lecturer($columnsInfo[$i]->name)[0];
																$phone = lecturer($columnsInfo[$i]->name)[1];
																echo $name; ?><br><?php echo $phone;
																				} else {
																					echo 'Null' ?><br><?php echo 'Null';
																									}
																										?>
														</td>

														<td><?php
															if (checkApproval($user_id, $columnsInfo[$i]->name) == 0) {
																echo '<code>not approved</code>';
															} else {
																echo '<code class="custom-code">approved</code>';
															}
															?></td>
													</tr>
											<?php
												}
											}
											?>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- DISPLAY BOX END -->
				<!--**********************************
					Footer start
					***********************************-->
				<?php
				include './layout/footer.php';
				?>
				<!--**********************************
						Footer end
					***********************************-->

				<script src="https://js.paystack.co/v1/inline.js"></script>
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
				<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
				<!-- <script src="js/styleSwitcher.js"></script>	 -->
				<script>
					var ref = document.getElementById('reference_paystack');
					var email = document.getElementById('email_paystack');
					var amount = document.getElementById('amount');
					// paymentForm.addEventListener('submit', payWithPaystack, false);

					function payWithPaystack() {
						var handler = PaystackPop.setup({
							key: 'pk_test_c9ca3055dbbb92e1f0009295a4402c5caeb938b4', // Replace with your public key
							email: email.value,
							amount: amount.value * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
							currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
							ref: ref.value, //'alumni' + Math.floor((Math.random() * 100000000000) + 1), // Replace with a reference you generated
							callback: function(response) {
								//this happens after the payment is completed successfully
								var reference = response.reference;
								window.location.replace("comfirm_payment.php?payment_successful=success&ref=" + response.reference);
							},
							onClose: function() {
								alert('Transaction was not completed, window closed.');
							},
						});
						handler.openIframe();
					}
				</script>
				<script type="text/javascript">
					$(window).on('load', function() {
						$('#makepayment').modal('show');
					});
				</script>

			<script src="vendors/global/global.min.js"></script>
			<script src="vendors/chart.js/Chart.bundle.min.js"></script>
			<script src="vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script>

			<!-- Apex Chart -->
			<script src="vendors/apexchart/apexchart.js"></script>

			<!-- Chart piety plugin files -->
			<script src="vendors/peity/jquery.peity.min.js"></script>

			<!-- Dashboard 1 -->
			<script src="js/dashboard/dashboard-1.js"></script>

			<!-- JS for dotted map -->
			<script src="vendors/dotted-map/js/contrib/jquery.smallipop-0.3.0.min.js"></script>
			<script src="vendors/dotted-map/js/contrib/suntimes.js"></script>
			<script src="vendors/dotted-map/js/contrib/color-0.4.1.js"></script>

			<script src="vendors/dotted-map/js/world.js"></script>
			<script src="vendors/dotted-map/js/smallimap.js"></script>
			<script src="js/dashboard/dotted-map-init.js"></script>

			<script src="js/custom.min.js"></script>
			<script src="js/deznav-init.js"></script>
</body>

</html>