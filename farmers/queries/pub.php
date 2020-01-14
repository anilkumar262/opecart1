<?php
session_start();if (isset($_SESSION['fac_id'])) {
    include '../../departments/connect.php';
    if(isset($_POST['add_pub'])){
        $pub_title= addslashes($_POST['pub_title']);
        $pub_author= addslashes($_POST['pub_author']);
        $pub_year= addslashes($_POST['pub_year']);
        $pub_type= addslashes($_POST['pub_type']);
        $pub_type_name= addslashes($_POST['pub_type_name']);
        $pub_pages= addslashes($_POST['pub_pages']);
        $pub_number= addslashes($_POST['pub_number']);
        $pub_volume= addslashes($_POST['pub_volume']);
        $pub_publisher= addslashes($_POST['pub_publisher']);
        $pub_oth= addslashes($_POST['pub_oth']);
        $fac_id = $_SESSION['fac_id'];
        $fac = $_POST['fac'];
        $str_arr = explode (",", $fac);  

        $q= "INSERT INTO `publication`(`fac_id`, `pub_title`, `pub_author`, `pub_year`, `pub_type`, `pub_type_name`, `pub_publisher`, `pub_volume`, `pub_number`, `pub_pages`, `pub_impact`) VALUES ('$fac_id','$pub_title','$pub_author','$pub_year','$pub_type','$pub_type_name','$pub_publisher','$pub_volume','$pub_number','$pub_pages','$pub_oth')";
        $q = mysqli_query($conn,$q);	
        $pub_id = mysqli_insert_id($conn);
        $pub_fac = "INSERT INTO `pub_mapping`(`pub_id`, `fac_id`) VALUES ($pub_id,{$_SESSION['fac_id']})";
        $pub_fac = mysqli_query($conn,$pub_fac);
        $i=0;
        foreach($str_arr as $chk1)  
        {  
            if($chk1!=0){
                $query2="INSERT INTO `pub_mapping`(`pub_id`, `fac_id`) VALUES ('$pub_id','$chk1')";
                mysqli_query($conn,$query2);    
            }
        }
        if($q && $pub_fac){
            echo 'Publication Added Successfully';
        }		
        else{
            echo 'Publication Addition failed';
        }
    }
    if(isset($_POST['upd_pub'])){
        $pub_title= addslashes($_POST['pub_title']);
        $pub_author= addslashes($_POST['pub_author']);
        $pub_year= addslashes($_POST['pub_year']);
        $pub_type= addslashes($_POST['pub_type']);
        $pub_type_name= addslashes($_POST['pub_type_name']);
        $pub_oth= addslashes($_POST['pub_oth']);
        $pub_volume = addslashes($_POST['pub_volume']);
        $pub_pages = addslashes($_POST['pub_pages']);
        $pub_publisher = addslashes($_POST['pub_publisher']);
        $pub_number = addslashes($_POST['pub_number']);

        $pub_id = $_POST['pub_id'];
        $fac = $_POST['fac'];
        $str_arr = explode (",", $fac);
        $del = "DELETE FROM `pub_mapping` WHERE pub_id=$pub_id";
        $del_res = mysqli_query($conn,$del);

        $q= "UPDATE `publication` SET `pub_title`='$pub_title',`pub_author`='$pub_author',`pub_year`='$pub_year',`pub_type`='$pub_type',`pub_type_name`='$pub_type_name',`pub_publisher`='$pub_publisher',`pub_volume`='$pub_volume',`pub_pages`='$pub_pages',`pub_number`='$pub_number',`pub_impact`='$pub_oth' WHERE pub_id=$pub_id";
        $q = mysqli_query($conn,$q);	
        $pub_fac = "INSERT INTO `pub_mapping`(`pub_id`, `fac_id`) VALUES ($pub_id,{$_SESSION['fac_id']})";
        $pub_fac = mysqli_query($conn,$pub_fac);
        foreach($str_arr as $chk1)  
        {  
            if($chk1 != 0){
                $query2="INSERT INTO `pub_mapping`(`pub_id`, `fac_id`) VALUES ('$pub_id','$chk1')";
                mysqli_query($conn,$query2);    
            }
        }
        if($q && $pub_fac){
            echo 'Publication Updated Successfully';
        }		
        else{
            echo 'Publication Updated failed';
        }
    }
    if(isset($_POST['del_pub'])){
        $pub_id = addslashes($_POST['pub_id']);
        $del_pub = "DELETE FROM `publication` WHERE pub_id=$pub_id";
        $del_map = "DELETE FROM `pub_mapping` WHERE pub_id=$pub_id";
        $del_pub = mysqli_query($conn,$del_pub);
        $del_map = mysqli_query($conn,$del_map);
        if($del_map){
            echo "Publication Deleted Successfully";
        } else{
            echo "Publication Deletion Failed";
        }
    }
}
?>