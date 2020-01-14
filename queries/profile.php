<?php
session_start();if (isset($_SESSION['fac_id'])) {

    $file = $_FILES['attach'];
    if (isset($_FILES['attach'])) {
        $file_name = $_FILES['attach']['name'];
        $file_size = $_FILES['attach']['size'];
        $file_tmp = $_FILES['attach']['tmp_name'];
        $file_type = $_FILES['attach']['type'];
        $file_ext = strtolower(end(explode('.', $file_name)));
        $id=$_POST['id'];
        if($file_ext!='jpg'){
            echo "File Should Be jpg File";
            header('Location: ../profile-pic.php?ext');
        }
        else{
            if(empty($errors) == true) {
                move_uploaded_file($file_tmp, "../../img/faculty/$id.jpg"); //The folder where you would like your file to be saved
                echo "Profile Picture Updated Successfully";
                header('Location: ../profile-pic.php?s');
            }
            // list($width, $height, $type, $attr) = getimagesize("../../img/faculty/$id.jpg"); 
            // echo $height.'*'.$width;
            
        }
    }
}
?>