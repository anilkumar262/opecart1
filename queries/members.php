<?php
session_start();if (isset($_SESSION['fac_id'])) {
    include '../../departments/connect.php';

    if (isset($_POST['add_mem'])) {
        $mem_name = addslashes($_POST['mem_name']);
        $mem_type = addslashes($_POST['mem_type']);
        $mem_mail = addslashes($_POST['mem_mail']);
        $mem_phnum = addslashes($_POST['mem_phnum']);
        $mem_status = addslashes($_POST['mem_status']);
        $mem_working = addslashes($_POST['mem_working']);

        $query = "INSERT INTO `members`(`fac_id`, `mem_name`, `mem_type`, `mem_mail`, `mem_phnum`, `mem_status`, `mem_working`) VALUES ({$_SESSION['fac_id']},'$mem_name','$mem_type','$mem_mail','$mem_phnum','$mem_status','$mem_working')";
        $re = mysqli_query($conn, $query);
        if ($re) {
            echo 'Member Added Successfully';
        } else {
            echo 'Member Addition Failed';
        }
    }
    if (isset($_POST['upd_mem'])) {
        $mem_id = addslashes($_POST['mem_id']);
        $mem_name = addslashes($_POST['mem_name']);
        $mem_type = addslashes($_POST['mem_type']);
        $mem_mail = addslashes($_POST['mem_mail']);
        $mem_phnum = addslashes($_POST['mem_phnum']);
        $mem_status = addslashes($_POST['mem_status']);
        $mem_working = addslashes($_POST['mem_working']);

        $query = "UPDATE `members` SET `fac_id`='{$_SESSION['fac_id']}',`mem_name`='$mem_name',`mem_type`='$mem_type',`mem_mail`='$mem_mail',`mem_phnum`='$mem_phnum',`mem_status`='$mem_status',`mem_working`='$mem_working' WHERE mem_id=$mem_id";
        // echo $query;
        $re = mysqli_query($conn, $query);
        if ($re) {
            echo 'Member Updated Successfully';
        } else {
            echo 'Member Updation Failed';
        }
    }

    if(isset($_POST['del_mem'])){
    $mem_id= addslashes($_POST['mem_id']);

    $query = "DELETE FROM `members` WHERE mem_id=$mem_id";
    $re = mysqli_query($conn, $query);
    if($re){
        echo 'Member Deleted Successfully';
    }
    else{
        echo 'Member Deletion Failed';
        }
    }
}
?>
