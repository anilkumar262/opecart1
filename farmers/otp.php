<!doctype html>
<html class="fixed">

<head>
    <!-- Basic -->
    <script src="vendor/jquery/jquery.js"></script>

    <?php include 'includes/head.php'; ?>
    <!-- Web Fonts  -->
    <?php
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['number'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $num = $_POST['number'];
        $stat = 0;
        $random = mt_rand(100000, 999999);
        $x=0;
        $user="select oc_f_num from oc_farmer where oc_f_num=$num and oc_f_otp_status=1";
        $user = mysqli_query($conn, $user);
        $check_user = mysqli_num_rows($user);
        if ($check_user == 1) {
            $x=1;
            header('Location: index.php?user');
        }

        $check = "select oc_f_num from oc_farmer where oc_f_num=$num and oc_f_otp_status=0" ;
        $check = mysqli_query($conn, $check);
        $check_num = mysqli_num_rows($check);
        if ($check_num ==1 ) {
            $check_del = "delete from oc_farmer where oc_f_num=$num";
            mysqli_query($conn, $check_del);
        }
        if($x==0){
            include 'msg_otp.php';
        }
        $query = "INSERT INTO `oc_farmer`(`oc_f_name`, `oc_f_num`, `oc_f_mail`, `oc_f_password`,`oc_f_status`, `oc_f_otp`) VALUES ('$name','$num','$email','$pwd','$stat','$random')";
        $q1 = mysqli_query($conn, $query);
    } else if(isset($_POST['otp']))  {
        $num=$_POST['num'];
        $otp=$_POST['otp'];
        $check_otp="SELECT oc_f_otp from oc_farmer where oc_f_otp=$otp";
        $check_otp=mysqli_query($conn,$check_otp);
        $check_otp=mysqli_fetch_assoc($check_otp);
        if($check_otp['oc_f_otp']==$otp){
            echo "hi";
            $otp_valid="update oc_farmer set oc_f_otp_status=1,oc_f_otp=0 where oc_f_num=$num";
            echo $otp_valid;
            if(mysqli_query($conn,$otp_valid)){
                header('Location: index.php?otp=s');
            }
        }
        else{
            echo"
            <script>
            $(document).ready(function(){
                $('#otp_err').append('INVALID OTP');
            });
            </script>";
        }
    }
    else{
        header('Location: index.php');
    }

    
    

    ?>
    <?php
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
                <h1>OTP Verification</h1>
            </a>

            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-right">
                    <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i>OTP</h2>
                </div>
                <div class="card-body">
                    <form action="otp.php" onsubmit="return validate();" method="POST">
                        <div class="form-group mb-3">
                            <label>OTP<span class="required">*</span></label>
                            <input name="otp" type="text" class="form-control form-control-lg" id="otp" />
                            <input name="num" value="<?php echo $num; ?>" type="hidden" class="form-control form-control-lg" id="num" />
                            <span id="name_err" style="color:red;"></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <span id='otp_err'style='color:red;'></span>
                                
                            </div>
                            <div class="col-sm-4 text-right">
                                <button type="submit" class="btn btn-primary mt-2">Confirm OTP</button>
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

    <script>
        function validate() {
            var name = $('#name').val();
            document.getElementById("name_err").innerHTML = "";

            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if ((charCode < 48 || charCode > 57))
                    return false;

                return true;
            }
        }
    </script>

</body>

</html>