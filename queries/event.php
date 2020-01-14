    <?php
session_start();if(isset($_SESSION['fac_id'])) {

    include '../../departments/connect.php';
    if(isset($_POST['add_event'])){
    $event_title = addslashes($_POST['event_title']);
    $event_from_date = addslashes($_POST['event_from_date']);        
    $event_to_date = addslashes($_POST['event_to_date']);
    $event_link = addslashes($_POST['event_link']);
    $event_disc = addslashes($_POST['event_disc']);
    $cf_id = addslashes($_POST['cf_id']);
    $cf_status = addslashes($_POST['cf_status']);
    $event_level = addslashes($_POST['event_level']);
    $fac_id = addslashes($_POST['fac_id']);
    $query = "INSERT INTO `events`(`fac_id`, `cf_id`, `event_title`, `event_disc`, `event_link`, `event_from_date`, `event_to_date`, `event_cf_status`, `event_level_status`) VALUES ({$_SESSION['fac_id']},'$cf_id','$event_title','$event_disc','$event_link','$event_from_date','$event_to_date','$cf_status','$event_level')";
    $re = mysqli_query($conn, $query);
    if($re){
        echo 'Event Added Successfully';
    }else{
        echo 'Event Addition Failed';
    }
    }
    if(isset($_POST['event_approve'])){
    $event_id= addslashes($_POST['event_id']);
    $event_level_status = addslashes($_POST['status']);
    $query= "UPDATE `events` SET `event_level_status`=$event_level_status,`event_cf_status`=0 WHERE event_id=$event_id";
    // echo $query;
    $res= mysqli_query($conn, $query);
    if($res){
        echo "Event Rejected";
    } else{
        echo "Event Disapproved";
    }
    }


    if(isset($_POST['del_event'])){
    $id = addslashes($_POST['event_id']);
    $query = "DELETE from events where event_id=$id";
    $result = mysqli_query($conn,$query);
    if($result){
        echo "Event Deleted Successfully";
    }    
    else{
        echo "Event Deletion Failed";
    }
    }

    if(isset($_POST['event_lev'])){
    $id = addslashes($_POST['event_id']);
    $event_cf_status=addslashes($_POST['event_cf_status']);
    $event_from_date=addslashes($_POST['event_from_date']);
    $event_to_date=addslashes($_POST['event_to_date']);
    $event_level_status=addslashes($_POST['event_level_status']);
    $q1="SELECT * FROM `events` WHERE (
        (event_from_date BETWEEN '$event_from_date' AND '$event_to_date') or 
            (event_to_date BETWEEN '$event_from_date' AND '$event_to_date') or
            (event_from_date < '$event_from_date' and event_to_date > '$event_to_date') or
            (event_from_date > '$event_to_date' and event_to_date < '$event_to_date')
        ) and event_cf_status=2";
        // echo $q1;
        $q1 = mysqli_query($conn, $q1);
        
        if(mysqli_num_rows($q1) > 0 && $event_cf_status==2)
        {
            echo "Sorry, Seminar Hall has already been allocated for the given dates";

        }
        else{ 
            $query = "UPDATE events SET `event_level_status`=$event_level_status,`event_cf_status`=$event_cf_status where event_id=$id";
            $result = mysqli_query($conn,$query);
            if($result){
                echo "Event Approved";
            }    
            else{
                echo "Updating Event Failed";
            }
        }
    }
}
?>