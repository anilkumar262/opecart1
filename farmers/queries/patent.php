<?php
    session_start();if (isset($_SESSION['fac_id'])) {
        include '../../departments/connect.php';

        if(isset($_POST['add_patent'])){
            $fac_id=$_SESSION['fac_id'];
            $patent_title= addslashes($_POST['patent_title']);
            $patent_authors= addslashes($_POST['patent_authors']);
            $patent_grant_year= addslashes($_POST['patent_grant_year']);
            $patent_num= addslashes($_POST['patent_num']);
            $patent_country= addslashes($_POST['patent_country']);
            $patent_year_applied= addslashes($_POST['patent_year_applied']);
            $patent_status= addslashes($_POST['patent_status']);
            
            $pat_query="INSERT INTO `patents`(`fac_id`, `patent_title`, `patent_authors`, `patent_grant_year`, `patent_num`, `patent_country`, `patent_year_applied`,`patent_status`) VALUES ('$fac_id','$patent_title','$patent_authors','$patent_grant_year','$patent_num','$patent_country','$patent_year_applied','$patent_status')";
            // echo $fac_query;
            $re = mysqli_query($conn ,$pat_query);
            if($re){
                echo 'Patent Added Successfully';
            }
            else{
                echo 'Adding Patent Failed';
            }
            
        }

        if(isset($_POST['upd_patent'])){
            $fac_id=$_SESSION['fac_id'];
            $patent_id=$_POST['patent_id'];
            $patent_title= addslashes($_POST['patent_title']);
            $patent_authors= addslashes($_POST['patent_authors']);
            $patent_grant_year= addslashes($_POST['patent_grant_year']);
            $patent_num= addslashes($_POST['patent_num']);
            $patent_country= addslashes($_POST['patent_country']);
            $patent_year_applied= addslashes($_POST['patent_year_applied']);
            $patent_status= addslashes($_POST['patent_status']);
            
            $pat_query="UPDATE `patents` SET `fac_id`='$fac_id',`patent_title`='$patent_title',`patent_authors`='$patent_authors',`patent_grant_year`='$patent_grant_year',`patent_num`='$patent_num',`patent_country`='$patent_country',`patent_year_applied`='$patent_year_applied',`patent_status`='$patent_status' WHERE patent_id=".$patent_id;
            // echo $fac_query;
            $re = mysqli_query($conn ,$pat_query);
            if($re){
                echo 'Patent Updated Successfully';
            }
            else{
                echo 'Updating Patent Failed';
            }
            
            
        }

        if(isset($_POST['del_patent']))
        { 
            $patent_id= addslashes($_POST['patent_id']);

            $fac2_query="DELETE FROM `patents` WHERE patent_id=".$patent_id;
            $re=mysqli_query($conn,$fac2_query);
            if($re){
                echo 'Patent Deleted Successfully';
            }
            else{
                echo 'Deleting Patent Failed';
            }

        }
    }
    
    
    
?>