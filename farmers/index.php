<!doctype html>
<html class="fixed">

<head>
	<!-- Basic -->
	<script src="vendor/jquery/jquery.js"></script>

	<?php include 'includes/head.php'; ?>

	<!-- Web Fonts  -->
	<?php

	if (isset($_POST['phnum']) && isset($_POST['passwd'])) {
		$check = "SELECT * from `oc_farmer` where oc_f_num=" . '"' . $_POST['phnum'] . '"';
		$check = mysqli_query($conn, $check);
		$login_row = mysqli_fetch_assoc($check);
		if ($_POST['phnum'] == $login_row['oc_f_num'] && $_POST['passwd'] == $login_row['oc_f_password']) {
			if ($login_row['oc_f_otp_status'] == 0) {
	?>
				<script>
					$(document).ready(function() {
						$('#pc').html('Invalid Login Credentials');
					});
				</script>
			<?php
			} else if ($login_row['oc_f_status'] == 1) {
			?>
				<script>
					$(document).ready(function() {
						$('#pc').html('Account Not Approved.');
					});
				</script>
			<?php
			} else {
				session_start();
				$_SESSION['farmer_id'] = $login_row['oc_f_number'];
				$_SESSION['farmer_name'] = $login_row['oc_f_name'];
				$_SESSION['farmer_num'] = $login_row['oc_f_num'];
				$_SESSION['farmer_status'] = $login_row['oc_f_status'];
				header('Location: dashboard.php');
			}
		} else {
			?>
			<script>
				$(document).ready(function() {
					$('#err').html('UserId and Password didn`t match');
				});
			</script>
	<?php
		}
	}

	?>

	<?php
	if (isset($_GET['otp'])) { ?>
		<script>
			$(document).ready(function() {
				$('#pc').html('Account Created Successfully.');
			});
		</script>
	<?php }
	?>

	<?php
	if (isset($_GET['user'])) { ?>
		<script>
			$(document).ready(function() {
				$('#pc').html('<div style="color:red;">User Already Exists.</div>');
			});
		</script>
	<?php }
	?>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="vendor/animate/animate.css">

	<link rel="stylesheet" href="vendor/font-awesome/css/fontawesome-all.min.css" />
	<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="css/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="css/custom.css">

	<!-- Head Libs -->
	<script src="vendor/modernizr/modernizr.js"></script>

</head>

<body>
	<!-- start: page -->
	<section class="body-sign">
		<div class="center-sign">

			<a href="" class="logo float-left">
				<h1>Farmer Login</h1>
			</a>

			<div class="panel card-sign">
				<div class="card-title-sign mt-3 text-right">
					<h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> LogIn</h2>
				</div>
				<div class="card-body">
					<form action="index.php" method="post">
						<div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-10">
								<div style="color:green;font-size:18px" id='pc'></div>
							</div>
						</div>
						<div class="form-group mb-3">
							<label>Mobile Number</label>
							<div class="input-group">
								<input name="phnum" type="text" class="form-control form-control-lg" />
								<span class="input-group-append">
									<span class="input-group-text">
										<i class="fas fa-user"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="form-group mb-3">
							<div class="clearfix">
								<label class="float-left">Password</label>
								<!-- <a href="pages-recover-password.html" class="float-right">Lost Password?</a> -->
							</div>
							<div class="input-group">
								<input name="passwd" type="password" class="form-control form-control-lg current-password" />
								<span class="input-group-append">
									<span class="input-group-text">
										<i class="fas fa-lock"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="row" style="text-align:left">
							<div class="col-sm-6">
								<div style="color:red;" id='err'></div>
								<div style="color:green;" id='suc_otp'></div>
							</div>
							<div class="col-sm-4 text-center">
								<b>Not a User?<a href="signup.php">Sign Up here</a></b>
							</div>
							<div class="col-sm-2 text-right">
								<button type="submit" class="btn btn-primary mt-2">LogIn</button>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5">

							</div>
							<div class="col-sm-7 text-right">
							</div>
						</div>
					</form>
				</div>
			</div>

			<p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2019. All Rights Reserved.</p>
		</div>
	</section>
	<!-- end: page -->

	<!-- Vendor -->
	<script src="vendor/jquery/jquery.js"></script>
	<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="vendor/popper/umd/popper.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.js"></script>
	<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="vendor/common/common.js"></script>
	<script src="vendor/nanoscroller/nanoscroller.js"></script>
	<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
	<script src="vendor/jquery-placeholder/jquery-placeholder.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="js/theme.js"></script>

	<!-- Theme Custom -->
	<script src="js/custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="js/theme.init.js"></script>

</body>

</html>