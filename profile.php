<?php
include 'isloggedin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Title -->
	<title>SUAB Alumni</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Tescode">
	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon icon -->
	<link rel="icon" type="image/png" href="images/favicon.png">

	<link href="vendors/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link rel="stylesheet" href="vendors/dotted-map/css/contrib/jquery.smallipop-0.3.0.min.css" type="text/css" media="all">
	<!-- Style css -->
	<link href="css/style.css" rel="stylesheet">
	<style>
		.student-detail {
			text-align: center;
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
		include './layout/header.php';
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

			<!-- <form action="" method="POST"> -->
			<div class="container-fluid">
				<?php
				$id_email = $_SESSION['id'];
				$fetch_data = "SELECT * FROM users WHERE id =  $id_email";
				$query_data = mysqli_query($db_con, $fetch_data);
				$exist = mysqli_fetch_array($query_data);
				$matric_number = $exist['matric_number'];
				$fullname = $exist['fullname'];
				$email = $exist['email'];
				$college = $exist['college'];
				$whatsapp_number = $exist['whatsapp_number'];
				$department = $exist['department'];
				$linkedin_profile = $exist['linkedin_profile'];
				$profile_picture = $exist['profile_picture'];
				$job = $exist['job_status'];
				$address = $exist['address'];
				// }
				?>
				<div class="col-xl-12">
					<div class="student-detail">
						<?php echo "<h2>$fullname" . "'s Details</h2>" ?>
					</div>
					<div class="row">
						<div class="col-xl-6">
							<div class="mb-3">
								<label class="mb-1"><strong>Matric Number</strong></label>
								<p name="matric_number" class="form-control" readonly><?php echo $matric_number ?></p>
							</div>
							<div class="mb-3">
								<label class="mb-1"><strong>Fullname</strong></label>
								<p name="matric_number" class="form-control" readonly><?php echo $fullname ?></p>
							</div>
							<div class="mb-3">
								<label class="mb-1"><strong>College</strong></label>
								<p name="matric_number" class="form-control" readonly><?php echo $college ?></p>
							</div>
							<div class="mb-3">
								<label class="mb-1"><strong>Department</strong></label>
								<p name="matric_number" class="form-control" readonly><?php echo $department ?></p>
							</div>
						</div>
						<div class="col-xl-6">
							<div class="mb-3">
								<label class="mb-1"><strong>Whatsapp Number</strong></label>
								<p name="matric_number" class="form-control" readonly><?php echo $whatsapp_number ?></p>
							</div>
							<div class="mb-3">
								<label class="mb-1"><strong>linkedin_profile</strong></label>
								<p name="matric_number" class="form-control" readonly><?php echo $linkedin_profile ?></p>
							</div>
							<div class="mb-3">
								<label class="mb-1"><strong>Address</strong></label>
								<p name="matric_number" class="form-control" readonly> <?php echo $address ?> </p>
							</div>
							<div class="mb-3">
								<label class="mb-1"><strong>Job Status</strong></label>
								<p name="matric_number" class="form-control" readonly><?php echo $job ?></p>
							</div>
						</div>
					</div>
					<!--**********************************
					Footer start
					***********************************-->
					<?php
					include './layout/footer.php';
					?>
					<!--**********************************
						Footer end
					***********************************-->
				</div>


				<!-- </form> -->

			</div>
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