<?php
session_start();if (isset($_SESSION['fac_id'])) {
    include '../../departments/connect.php';
    if(isset($_POST['add_cls'])){
        $class_title = addslashes($_POST['class_title']);
        $class_disc = $_POST['class_disc'];
        $class_disc=urldecode($class_disc);
        $class_disc = addslashes($class_disc);
        $fac = "INSERT INTO `cls_updates`(`fac_id`, `class_title`, `class_disc`) VALUES ({$_SESSION['fac_id']},'$class_title','$class_disc')";
        // echo $fac;
        $fac = mysqli_query($conn, $fac);
        if($fac){
            echo "Class Update Added Successfully";
        }else{
            echo "Class Update Failed";
        }
    }

    if(isset($_POST['upd_cls'])){
        $class_title = addslashes($_POST['class_title']);
        $class_disc = $_POST['class_disc'];
        $class_id = addslashes($_POST['class_id']);
        $class_disc=urldecode($class_disc);
        $class_disc = addslashes($class_disc);
        
        $fac = "UPDATE `cls_updates` SET `fac_id`='{$_SESSION['fac_id']}',`class_title`='$class_title',`class_disc`='$class_disc' WHERE class_id=$class_id";
        // echo $fac;
        $fac = mysqli_query($conn, $fac);
        if($fac){
            echo "Class Update Added Successfully";
        }else{
            echo "Class Update Failed";
        }
    }

    if(isset($_POST['del_cls'])){
        $class_id = addslashes($_POST['class_id']);
        $query = "DELETE FROM `cls_updates` WHERE class_id=$class_id ";
        $re = mysqli_query($conn, $query);
        if ($re) {
            echo 'Class Update Deleted Successfully';
        } else {
            echo 'Class Update Deletion Failed';
        }

    }
}
								
?>