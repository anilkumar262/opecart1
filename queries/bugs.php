<?php

session_start();if(isset($_SESSION['fac_id'])){
    include '../../departments/connect.php';
    
    if(isset($_POST['rep_add'])){
        session_start();
        $bug_disc=addslashes($_POST['bug_disc']);
        $fac_id=addslashes($_SESSION['fac_id']);
        $q= "INSERT INTO `bug_report`(`fac_id`, `disc`) VALUES ($fac_id,'$bug_disc')";
        $result=mysqli_query($conn,$q);
        if($result){
            echo "Bug Has Been Reported It Will Be Solved As Soon As Possible";
        } else{
            echo "Bug Failed To Report";
        }
    }
}
?>
