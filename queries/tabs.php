<?php
session_start();if (isset($_SESSION['fac_id'])) {
    include '../../departments/connect.php';
    if (isset($_POST['add_tabs'])) {
        $title = addslashes($_POST['title']);
        $disc = addslashes($_POST['disc']);
        $fac = $_SESSION['fac_id'];
        $disc = urldecode($disc);
        $disc = addslashes($disc);
        // echo $disc;
        $q = "INSERT INTO `tabs`(`fac_id`, `tab_title`, `tab_disc`) VALUES ($fac,'$title','$disc')";
        
        $result = mysqli_query($conn, $q);
        if ($result) {
            echo "New Tab Added Successfully";
        } else {
            echo "New Tab Addition Failed";
        }
    }
    if (isset($_POST['upd_tabs'])) {
        $title = addslashes($_POST['title']);
        $disc = $_POST['disc'];
        $fac = $_SESSION['fac_id'];
        $id = $_POST['tab_id'];
        $disc=urldecode($disc);
        $disc = addslashes($disc);
        $q = "UPDATE `tabs` SET `tab_title`='$title',`tab_disc`='$disc' WHERE tab_id=".$id;
        // echo $q;
        $result = mysqli_query($conn, $q);
        if ($result) {
            echo "Tab Updated Successfull";
        } else {
            echo "Tab Updation Failed";
        }
    }
    if (isset($_POST['del_tab'])) {
        $id = addslashes($_POST['id']);
        $q = "DELETE FROM tabs where tab_id=".$id;
        $result = mysqli_query($conn, $q);
        if ($result) {
            echo "Tab Deleted Successfully";
        } else {
            echo "Tab Deletion Failed";
        }
    }
}
?>