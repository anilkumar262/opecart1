<?php
session_start();if (isset($_SESSION['fac_id'])) {

    include '../../departments/connect.php';
    if(isset($_POST['dept_upd'])){
        $dept_name = addslashes($_POST['dept_name']);
        $dept_about = $_POST['dept_about'];
        $dept_study = $_POST['dept_study'];
        $dept_exam = $_POST['dept_exams'];
        $dept_infra = $_POST['dept_infra'];
        $dept_contact = $_POST['dept_contact'];
        $dept_id = addslashes($_POST['dept_id']);
        
        $dept_about = urldecode($dept_about);
        $dept_study = urldecode($dept_study);
        $dept_exam = urldecode($dept_exam);
        $dept_infra = urldecode($dept_infra);
        $dept_contact = urldecode($dept_contact);

        $dept_about = addslashes($dept_about);
        $dept_study = addslashes($dept_study);
        $dept_exam = addslashes($dept_exam);
        $dept_infra = addslashes($dept_infra);
        $dept_contact = addslashes($dept_contact);
        
     
        $query = "UPDATE `department` SET `dept_name`='$dept_name',`dept_about`='$dept_about',`dept_study`='$dept_study',`dept_exams`='$dept_exam',`dept_infra`='$dept_infra',`dept_contact`='$dept_contact' WHERE dept_id=$dept_id";
        $res = mysqli_query($conn , $query);
        if($res){
            echo "Department Details Updated Successfully";
        }else {
            echo "Department Details Updation failed";
        }
    }

    if(isset($_POST['dept_table'])){
        $dept_id = addslashes($_POST['dept_id']);
        $dept_table = $_POST['dept_timetable'];
        $dept_table=urldecode($dept_table);
        $dept_table = addslashes($dept_table);

        $q= "UPDATE `department` SET `dept_timetable`='$dept_table' WHERE dept_id=$dept_id";
        // echo $q;
        $q=mysqli_query($conn,$q);
        if($q){
            echo "Department Timetable Updated Successfully";
        }
        else{
            echo "Department Timetable Update Failed";
        }
    }
}
?>