<?php
session_start();if (isset($_SESSION['fac_id'])) {
    include '../../departments/connect.php';
    if(isset($_POST['cnt'])){
        $placement = addslashes($_POST['placement']);
        $mous = addslashes($_POST['mous']);
        $patent = addslashes($_POST['patents']);
        $query = "UPDATE counters SET `count_value`=$placement where count_id=1";
        $result = mysqli_query($conn , $query);
        if($result) $i=1;
        $query = "UPDATE counters SET `count_value`=$mous where count_id=2";
        $result = mysqli_query($conn, $query);
        if($result) $i++;
        $query = "UPDATE counters SET `count_value`=$patent where count_id=3";
        $result = mysqli_query($conn, $query);
        if($result) $i++;
        if($i == 3){
            echo "Counter Updated Successfully";
        }
        else{
            echo "Counters Update Failed";
        }
    }

    if(isset($_POST['pro'])){
        $title = addslashes($_POST['title']);
        $duration = addslashes($_POST['duration']);
        $amount = addslashes($_POST['amount']);
        $year = addslashes($_POST['year']);    
        $pi = addslashes($_POST['pi']);
        $query = "INSERT INTO funded_projects (`fund_title`,`fund_duration`,`fund_amt`,`fund_year`,`fund_pi`) VALUES ('$title','$duration','$amount','$year','$pi')";
        // echo $query;
        $result = mysqli_query($conn,$query);
        if($result){
            echo "Funded Project Added Successfully";
        }
        else{
            echo "Funded Project Addtion failed";
        }
    }

    if(isset($_POST['upd_pro'])){
        $fund_id=addslashes($_POST['fund_id']);
        $title = addslashes($_POST['title']);
        $duration = addslashes($_POST['duration']);
        $amount = addslashes($_POST['amount']);
        $year = addslashes($_POST['year']);
        $pi = addslashes($_POST['pi']);
        $query = "UPDATE `funded_projects` SET `fund_title`='$title',`fund_duration`='$duration',`fund_year`='$year',`fund_amt`='$amount',`fund_pi`='$pi' WHERE fund_id=".$fund_id;
        echo $query;
        $result = mysqli_query($conn,$query);
        if($result){
            echo "Funded Project Updated Successfully";
        }
        else{
            echo "Updating Funded Project failed";
        }
    }

    if(isset($_POST['del_fund'])){
        $fund_id= addslashes($_POST['fund_id']);
        $query = "DELETE from`funded_projects` WHERE fund_id=".$fund_id;
        // echo $query;
        $result = mysqli_query($conn,$query);
        if($result){
            echo "Funded Project Deleted Successfully";
        }
        else{
            echo "Deleting Funded Project failed";
        }
    }
}
?>