<?php
session_start();if (isset($_SESSION['fac_id'])) {

    include '../../departments/connect.php';

        if(isset($_POST['fac_upd'])){
            $fac_name= addslashes($_POST['fac_name']);
            $fac_designation= addslashes($_POST['fac_designation']);
            // $fac_uname= addslashes($_POST['fac_uname']);
            // $fac_dob= addslashes($_POST['fac_dob']);
            $fac_qualification= addslashes($_POST['fac_qualification']);
            $fac_mail= addslashes($_POST['fac_mail']);
            $fac_phnum= addslashes($_POST['fac_phnum']);
            $fac_area= addslashes($_POST['fac_area']);
            $fac_teaching= addslashes($_POST['fac_teaching']);
            $fac_upd_query = "UPDATE `faculty` SET `fac_name`='$fac_name',`fac_uname`=' ',`fac_designation`='$fac_designation',`fac_qualification`='$fac_qualification',`fac_area`='$fac_area',`fac_mail`='$fac_mail',`fac_phnum`='$fac_phnum',`fac_teaching`='$fac_teaching' WHERE fac_id=".$_SESSION['fac_id'];
            // echo $fac_upd_query;
            $re = mysqli_query($conn ,$fac_upd_query);
            if($re){
                echo 'Updated Successfully';
            }
            else{
                echo 'Update Failed';
            }
        }

        if(isset($_POST['add_fac'])){
            $fac_name= addslashes($_POST['fac_name']);
            // $fac_uname= addslashes($_POST['fac_uname']);
            $fac_passwd= addslashes($_POST['fac_passwd']);
            $fac_passwd=md5($fac_passwd);
            $fac_mail= addslashes($_POST['fac_mail']);
            $fac_dept= addslashes($_POST['fac_dept']);
            $fac_role= addslashes($_POST['fac_role']);
            if($fac_role==1)
            {
                $fac1="SELECT * from `faculty` where dept_id=".$fac_dept."&& fac_role=1";
                $fac1_query=mysqli_query($conn,$fac1);
                if(mysqli_num_rows($fac1_query) > 0)
                {
                    echo 'H.O.D exists for the department'; 
                }
                else
                {
                    $fac_query="INSERT INTO `faculty`(`dept_id`, `fac_name`, `fac_uname`, `fac_passwd`, `fac_designation`, `fac_qualification`, `fac_area`, `fac_mail`, `fac_phnum`, `fac_role`, `fac_teaching`) VALUES ('$fac_dept','$fac_name','','$fac_passwd','','','','$fac_mail','','$fac_role','')";
                    // echo $fac_query;
                    $re = mysqli_query($conn ,$fac_query);
                    if($re){
                    echo 'Faculty Added Successfully';
                    }
                    else{
                    echo 'Adding Faculty Failed';
                }
                }
            }
            else{
            $fac_query="INSERT INTO `faculty`(`dept_id`, `fac_name`, `fac_uname`, `fac_passwd`, `fac_designation`, `fac_qualification`, `fac_area`, `fac_mail`, `fac_phnum`, `fac_role`, `fac_teaching`) VALUES ('$fac_dept','$fac_name',' ','$fac_passwd','','','','$fac_mail','','$fac_role','')";
            // echo $fac_query;
            $re = mysqli_query($conn ,$fac_query);
            if($re){
                echo 'Faculty Added Successfully';
            }
            else{
                echo 'Adding Faculty Failed';
            }

            }
            
        }

        if(isset($_POST['upd_fac'])){
            $fac_name= addslashes($_POST['fac_name']);
            // $fac_uname= addslashes($_POST['fac_uname']);
            $fac_mail= addslashes($_POST['fac_mail']);
            $fac_dept= addslashes($_POST['fac_dept']);
            $fac_role= addslashes($_POST['fac_role']);
            $fac_id= addslashes($_POST['fac_id']);

            if($fac_role==1)
            {
                $fac1_query="SELECT * from `faculty` where dept_id=".$fac_dept."&& fac_role=1"  ;
                $fac1_query=mysqli_query($conn,$fac1_query);
                if(mysqli_num_rows($fac1_query) > 0)
                {
                    echo 'H.O.D exists for the depatment'; 
                }
                else
                {
                    $fac_query="UPDATE `faculty` SET `dept_id`='$fac_dept',`fac_name`='$fac_name',`fac_uname`=' ',`fac_mail`='$fac_mail',`fac_role`='$fac_role' where fac_id=".$fac_id;
                    // echo $fac_query;
                    $re = mysqli_query($conn ,$fac_query);
                    if($re){
                    echo 'H.O.D Updated Successfully';
                    }
                    else{
                    echo 'Updating H.O.D Failed';
                }
                }
            }
            else{
                $fac_query="UPDATE `faculty` SET `dept_id`='$fac_dept',`fac_name`='$fac_name',`fac_uname`=' ',`fac_mail`='$fac_mail',`fac_role`='$fac_role'where fac_id=".$fac_id;
            // echo $fac_query;
            $re = mysqli_query($conn ,$fac_query);
            if($re){
                echo 'Faculty Updated Successfully';
            }
            else{
                echo 'Updating Faculty Failed';
            }

            }
            
        }
        
        if(isset($_POST['del_fac']))
        { 
            $fac_id= addslashes($_POST['fac_id']);

            $fac2_query="DELETE FROM `faculty` WHERE fac_id=".$fac_id;
            $re=mysqli_query($conn,$fac2_query);
            if($re){
                echo 'Faculty Deleted Successfully';
            }
            else{
                echo 'Deleting Faculty Failed';
            }

        }

        if(isset($_POST['pass_fac']))
        { 
            $fac_passwd= addslashes($_POST['fac_passwd']);
            $fac_id=$_POST['fac_id'];
            $fac_passwd=md5($fac_passwd);
            $fac2_query="UPDATE `faculty` SET `fac_passwd`='$fac_passwd' where fac_id=".$fac_id;
            $re=mysqli_query($conn,$fac2_query);
            if($re){
                echo 'Password Changed Successfully';
            }
            else{
                echo 'Changing Password Failed';
            }

        }
    }    
?>