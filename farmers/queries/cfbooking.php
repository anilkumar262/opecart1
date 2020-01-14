<?php
session_start();if (isset($_SESSION['fac_id'])) {

  include '../../departments/connect.php';
  if(isset($_POST['book_cf'])){
      $cf_id = $_POST['cf_id'];
      $book_date = $_POST['book_date'];
      $book_start_time = $_POST['book_start_time'];
      $book_end_time = $_POST['book_end_time'];
      $fac = $_SESSION['fac_id'];
      $q1="SELECT * FROM `cf_booking` WHERE (
        (book_start_time BETWEEN '$book_start_time' AND '$book_end_time') or 
          (book_end_time BETWEEN '$book_start_time' AND '$book_end_time') or
          (book_start_time < '$book_start_time' and book_end_time > '$book_end_time') or
         (book_start_time > '$book_end_time' and book_end_time < '$book_end_time')
      ) and cf_id='$cf_id' and book_date='$book_date' and book_status=1";
        // echo $q1;
      $q1 = mysqli_query($conn, $q1);
      
      if(mysqli_num_rows($q1) > 0)
      {
          echo "Central Facility is Registered For Given Timings";

      }
      else{ 
        $q = "INSERT INTO `cf_booking`(`cf_id`, `fac_id`, `book_date`, `book_start_time`, `book_end_time`) VALUES ($cf_id,$fac,'$book_date','$book_start_time','$book_end_time')";
        //  echo $q;
        $q_res = mysqli_query($conn, $q);
        $ls=mysqli_insert_id($conn);
        if($q_res){
          $q2="SELECT * FROM `cf_booking` WHERE (
            (book_start_time BETWEEN '$book_start_time' AND '$book_end_time') or 
              (book_end_time BETWEEN '$book_start_time' AND '$book_end_time') or
              (book_start_time < '$book_start_time' and book_end_time > '$book_end_time') or
             (book_start_time > '$book_end_time' and book_end_time < '$book_end_time')
          ) and cf_id='$cf_id' and book_date='$book_date' and book_status=0 and book_id!=$ls";
          $q2 = mysqli_query($conn, $q2);
          if(mysqli_num_rows($q2) > 0)
          {
              echo "Registered Succesfully\nNote: There are ".mysqli_num_rows($q2)." Pending Requests for the Date And Time" ;

          }
          else{
            echo "Central Facility Registered Succesfully";
          }
                
        }
        else{
            echo "Registering Central Facility  Falied";
        }
      }   
  }

  if(isset($_POST['del_booking'])){
    $book_id = $_POST['book_id'];
    $query = "DELETE from cf_booking where book_id=$book_id";
    $result = mysqli_query($conn,$query);
    if($result){
            echo "Booking Deleted Successfully";
    }    
    else{
            echo "Deletion Failed";
        }
  }

  if(isset($_POST['book_disapprove'])){
    $book_id = $_POST['book_id'];
    $book_status=$_POST['status'];
    $query = "UPDATE `cf_booking` SET `book_status`=$book_status where book_id=$book_id";
    $result = mysqli_query($conn,$query);
    if($result){
            echo "Booking Rejected";
    }    
    else{
            echo "Rejecting Failed";
        }
  }

  if(isset($_POST['fac_cf'])){
    $fac_id = $_POST['fac_id'];
    $query = "UPDATE `faculty` SET `fac_cf`=0 where fac_id=$fac_id";
    $result = mysqli_query($conn,$query);
    if($result){
            echo "Senior Technichal Officer Deleted";
    }    
    else{
            echo "Deletion Failed";
        }
  }

  if(isset($_POST['upd_fac'])){
    $fac_id = $_POST['fac_id'];
    $query = "UPDATE `faculty` SET `fac_cf`=1 where fac_id=$fac_id";
    $result = mysqli_query($conn,$query);
    if($result){
            echo "Senior Technichal Officer Added";
    }    
    else{
            echo "Adding Failed";
        }
  }

  if(isset($_POST['book_lev'])){
    $book_id = $_POST['book_id'];
    $book_status=$_POST['book_level'];
    $que="SELECT * FROM `cf_booking` WHERE book_id=$book_id";
    $que=mysqli_query($conn,$que);
    $res=mysqli_fetch_assoc($que);
    $book_start_time=$res['book_start_time'];
    $book_end_time=$res['book_end_time'];
    $cf_id = $res['cf_id'];
    $book_date = $res['book_date'];
    $q1="SELECT * FROM `cf_booking` WHERE (
      (book_start_time BETWEEN '$book_start_time' AND '$book_end_time') or 
        (book_end_time BETWEEN '$book_start_time' AND '$book_end_time') or
        (book_start_time < '$book_start_time' and book_end_time > '$book_end_time') or
       (book_start_time > '$book_end_time' and book_end_time < '$book_end_time')
    ) and cf_id='$cf_id' and book_date='$book_date' and book_status=1";
    $q1 = mysqli_query($conn, $q1);
      
    if(mysqli_num_rows($q1) > 0)
    {
        echo "Central Facility is Alloted For Given Timings";

    }
    else{
    $query = "UPDATE `cf_booking` SET `book_status`=$book_status where book_id=$book_id";
    $result = mysqli_query($conn,$query);
    if($result){
            echo "Booking Approved";
    }    
    else{
            echo "Approval Failed";
        }
    }   
  }
}
?>