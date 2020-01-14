<!doctype html>
<html class="fixed">

<head>
	<!-- Basic -->
	<script src="vendor/jquery/jquery.js"></script>

	<?php include 'includes/head.php'; ?>
	<!-- Web Fonts  -->

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
			<h1>Farmer Signup</h1>
			</a>

			<div class="panel card-sign">
			<div class="card-title-sign mt-3 text-right">
                    <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Sign Up</h2>
                </div>
                <div class="card-body">
                    <form action="otp.php" onsubmit="return validate();" method="POST">
                        <div class="form-group mb-3">
                            <label>Name<span class="required">*</span></label>
							<input name="name" type="text" class="form-control form-control-lg" id="name"/>
							<span id="name_err" style="color:red;"></span>
						</div>
						
						<div class="form-group mb-3">
                            <label>Mobile Number<span class="required">*</span></label>
							<input name="number" type="text" class="form-control form-control-lg" id="number" onkeypress="return isNumberKey(event)"/>
							<span id="number_err" style="color:red;"></span>
							
                        </div>

                        <div class="form-group mb-3">
                            <label>E-mail Address<span class="required">*</span></label>
							<input name="email" type="email" class="form-control form-control-lg" id="email"/>
							<span id="email_err" style="color:red;"></span>
							
                        </div>

                        <div class="form-group mb-0">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>Password<span class="required">*</span></label>
									<input name="pwd" type="password" class="form-control form-control-lg" id="pwd"/>
							        <span id="pwd_err" style="color:red;"></span>
									
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>Password Confirmation<span class="required">*</span></label>
                                    <input name="pwd_confirm" type="password" class="form-control form-control-lg" id="pwd_confirm"/>
						         	<span id="pwd_cnf_err" style="color:red;"></span>
								    
								</div>
                            </div>
						</div>
						
						<div class="form-group mb-0">
                            <div class="row" style="text-align:center;">
                                <span id="same" style="color: red;"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-8">
                                <!-- <div class="checkbox-custom checkbox-default">
                                    <input id="AgreeTerms" name="agreeterms" type="checkbox" />
                                    <label for="AgreeTerms">I agree with <a href="#">terms of use</a></label>
                                </div> -->
                            </div>
                            <div class="col-sm-4 text-right">
                                <button type="submit" class="btn btn-primary mt-2" >Sign Up</button>
                            </div>
                        </div>

                        <!-- <span class="mt-3 mb-3 line-thru text-center text-uppercase">
								<span>or</span>
                        </span>

                        <div class="mb-1 text-center">
                            <a class="btn btn-facebook mb-3 ml-1 mr-1" href="#">Connect with <i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-twitter mb-3 ml-1 mr-1" href="#">Connect with <i class="fab fa-twitter"></i></a>
                        </div> -->

                        <p class="text-center">Already have an account? <a href="login.php">Sign In!</a></p>

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

	<script>
		function validate()
		{
			var name=$('#name').val();
			var email=$('#email').val();
			var number=$('#number').val();
			var pwd=$('#pwd').val();
			var pwd_confirm=$('#pwd_confirm').val();
			var ret=true;
			document.getElementById("name_err").innerHTML = "";
			document.getElementById("email_err").innerHTML = "";
			document.getElementById("number_err").innerHTML = "";
			document.getElementById("pwd_err").innerHTML = "";
			document.getElementById("pwd_cnf_err").innerHTML = "";
			document.getElementById("same").innerHTML = "";

			if(name=="")
			{
			  document.getElementById("name_err").innerHTML = "Enter a Valid Name!";
			  ret=false;
			}

			var atpos = email.indexOf("@");
			var dotpos = email.lastIndexOf(".");
			if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
				document.getElementById("email_err").innerHTML = "Enter a Valid E-Mail!";
				ret = false;
			}

            if(number=="" || number.length != 10)
			{
				document.getElementById("number_err").innerHTML = "Enter a Valid Number!";
				ret = false;
			}


			if(pwd=="")
			{
				document.getElementById("pwd_err").innerHTML = "Enter a Valid Password!";
				ret = false;
			}

			if(pwd_confirm == "")
			{
				document.getElementById("pwd_cnf_err").innerHTML = "Enter a Valid Password!";
				ret = false;
			}

			if(pwd != pwd_confirm)
			{
				document.getElementById("same").innerHTML = "Passwords are not Same";
				ret = false;
			}

			return ret;
		}

		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if ((charCode < 48 || charCode > 57))
				return false;

			return true;
		}
	</script>
	
</body>

</html>