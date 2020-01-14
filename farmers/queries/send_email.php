<?php
session_start();if (isset($_SESSION['fac_id'])) {
    include '../../departments/connect.php';
    if ( $_FILES['attach']['error'] > 0 ){
        $subject = addslashes($_POST['sub']);
        $body = addslashes($_POST['disc']);
        $dept = addslashes($_POST['mail_dept']);
        $c=0;
        // echo $_POST['mail_dept'];
        if($dept == 0){
            $query = "SELECT  `fac_mail` FROM `faculty` WHERE 1";
        }
        else{
            $query = "SELECT `fac_mail` FROM `faculty` WHERE dept_id=".$dept;
        }
        
        $result = mysqli_query($conn,$query);
        include '../email.php';
         header('Location: ../compose.php?s');
    }
    else{
        $subject = addslashes($_POST['sub']);
        $body = addslashes($_POST['disc']);
        $dept = addslashes($_POST['mail_dept']);
        $file = $_FILES['attach'];
        if (isset($_FILES['attach'])) {
        $file_name = $_FILES['attach']['name'];
        $file_size = $_FILES['attach']['size'];
        $file_tmp = $_FILES['attach']['tmp_name'];
        $file_type = $_FILES['attach']['type'];
        // $file_ext = strtolower(end(explode('.', $file_name)));
        
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../emails/" . $file_name); //The folder where you would like your file to be saved
        }
    }
    if($dept == 0){
        $query = "SELECT `fac_mail` FROM `faculty` WHERE 1";
    }
    else{
        $query = "SELECT `fac_mail` FROM `faculty` WHERE dept_id=".$dept;
    }
    
    $result = mysqli_query($conn,$query);    
    include '../email_attach.php';
    header('Location: ../compose.php?s');
    }
}

?>