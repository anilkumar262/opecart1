<?php
session_start();if (isset($_SESSION['fac_id'])) {
    include '../../departments/connect.php';
        if(isset($_POST['cf_upd'])){
            $cf_name = addslashes($_POST['cf_name']);
            $cf_disc = $_POST['cf_disc'];
            $cf_id = addslashes($_POST['cf_id']);
            $cf_disc=urldecode($cf_disc);
            $cf_disc = addslashes($cf_disc);
            $q = "UPDATE `cf` SET `cf_name`='$cf_name',`cf_disc`='$cf_disc' WHERE cf_id=$cf_id";
            // echo $q;
            $q_res = mysqli_query($conn, $q);
            if($q_res){
                echo "Updated Successfully";
            }
            else{
                echo "Update Falied";
            }
        }

        if(isset($_POST['upd_fac']))
        {
            $cf_id=addslashes($_POST['cf_id']);
            $cf_fac=addslashes($_POST['cf_fac']);
            $cf='select * from `cf` where fac_id='.$cf_fac;
            $cf=mysqli_query($conn,$cf);
            if(mysqli_num_rows($cf)>0){
                echo 'Faculty Assigned as Incharge For Another Central Faciltiy';
            }
            else{
                $cf1="UPDATE `cf` SET `fac_id`=$cf_fac where cf_id=".$cf_id;
                $cf1=mysqli_query($conn,$cf1);
                if($cf1){
                    echo "Incharge Updated Successfully";
                }
                else{
                    echo "Incharge Update Falied";
                }


            }
        }
    }
?>