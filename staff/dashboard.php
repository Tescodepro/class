<?php
include 'isloggedin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Title -->
	<title>Dashboard - SUAB Alumni</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Tescode">
	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon icon -->
	<link rel="icon" type="image/png" href="../images/logo.png">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="../vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../vendor/dotted-map/css/contrib/jquery.smallipop-0.3.0.min.css" type="text/css" media="all">
	<!-- Style css -->
	<link href="../css/style.css" rel="stylesheet">
	<style>
		/* .deznav .metismenu li.has-arrow  a i{
			color: #000;
		} */
		.student-detail {
			text-align: center;
		}

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
	<div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
	</div>
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
		include '../layout/header.php';
		?>
		<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

		<!--**********************************
            Sidebar start
        ***********************************-->
		<?php
		include '../layout/side_nav.php';
		?>
		<!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<div class="container-fluid">
				<?php
				echo '<h2 style="text-align:center">WELCOME ' . $fullname . '</h2><br><br><br>';
				?>

				<div class="row">
					<div class="col-12">
						<div class="card">
							<?php
							if (isset($_GET['msg'])) {
								$msg = $_GET['msg'];
								if ($_GET['type'] == 'error') {
									echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<strong>Hoops!</strong> ' . $msg . '
										  </div>';
								} else {
									echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
											<strong>Great!</strong> ' . $msg . '
										  </div>';
								}
							}
							?>
							<div class="card-header">
								<h4 class="card-title">Basic Datatable</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="display" style="min-width: 845px">
										<thead>
											<tr>
												<th>S/NO</th>
												<th>Name</th>
												<th>Matric</th>
												<th>Department</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$count = 1;
											$student_query_str = "SELECT * FROM users INNER JOIN transactions ON users.id = transactions.user_id INNER JOIN departments ON departments.id = users.department INNER JOIN approvals ON approvals.user_id = users.id WHERE transactions.payment_status = 1";
											$student_query_db = mysqli_query($db_con, $student_query_str);
											while ($row_result = mysqli_fetch_array($student_query_db)) {

												$student_id = $row_result['user_id'];
											?>
												<tr>
													<td><?php echo $count++; ?></td>
													<td><?php echo $row_result['fullname'] ?></td>
													<td><?php echo $row_result['matric_number'] ?></td>
													<td><?php echo $row_result['name'] ?></td>
													<td><?php if ($row_result[$role] == 0) {
															echo '<code>not approved</code>';
														} else {
															echo '<code class="custom-code">approved</code>';
														} ?></td>
													<td><a href="controller/generalController.php?operation=approved&user_id=<?php echo $student_id; ?>&role=<?php echo $role; ?>" class="btn btn-success">Approved</a> <a href="controller/generalController.php?operation=disapproved&user_id=<?php echo $student_id; ?>&role=<?php echo $role; ?>" class="btn btn-danger">Disapproved</a></td>
												</tr>
											<?php
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th>S/NO</th>
												<th>Name</th>
												<th>Matric</th>
												<th>Department</th>
												<th>Action</th>
											</tr>
										</tfoot>
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
				include '../layout/footer.php';
				?>
				<!--**********************************
						Footer end
					***********************************-->
				<!-- Required vendors -->

				<script src="https://js.paystack.co/v1/inline.js"></script>
				<script src="../js/demo.js"></script>
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
				<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
				<script src="../vendor/global/global.min.js"></script>
				<script src="../vendor/chart.js/Chart.bundle.min.js"></script>
				<script src="../vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

				<!-- Apex Chart -->
				<script src="../vendor/apexchart/apexchart.js"></script>

				<!-- Chart piety plugin files -->
				<script src="../vendor/peity/jquery.peity.min.js"></script>

				<!-- Dashboard 1 -->
				<script src="../js/dashboard/dashboard-1.js"></script>

				<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
				<script src="../js/plugins-init/datatables.init.js"></script>

				<script src="../vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

				<script src="../js/custom.min.js"></script>
				<script src="../js/deznav-init.js"></script>
				<!-- <script src="../js/demo.js"></script> -->

				<!-- JS for dotted map -->
				<script src="../vendor/dotted-map/js/contrib/jquery.smallipop-0.3.0.min.js"></script>
				<script src="../vendor/dotted-map/js/contrib/suntimes.js"></script>
				<script src="../vendor/dotted-map/js/contrib/color-0.4.1.js"></script>

				<script src="../vendor/dotted-map/js/world.js"></script>
				<script src="../vendor/dotted-map/js/smallimap.js"></script>
				<script src="../js/dashboard/dotted-map-init.js"></script>



				<script src="../js/custom.min.js"></script>
				<script src="../js/deznav-init.js"></script>

</body>

</html>