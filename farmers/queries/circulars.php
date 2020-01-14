<?php
session_start();if (isset($_SESSION['fac_id'])) {
    include '../../departments/connect.php';
    if(isset($_FILES['attach'])){

        if ($_FILES['attach']['error'] > 0) {
            $title = addslashes($_POST['circ_title']);
            $disc = addslashes($_POST['circ_disc']);
            $query = "INSERT INTO `circulars`(`circ_title`, `circ_disc`, `circ_filename`) VALUES ('$title','$disc',0)";
            $result = mysqli_query($conn,$query);
            // echo $query;
            if($result){
                header('Location: ../cir-add.php?s');
            }
            else{
                header('Location: ../cir-add.php?e');
            }
        }
        else{
            $title = addslashes($_POST['circ_title']);
            $disc = addslashes($_POST['circ_disc']);
            $max_id = 'SELECT max(circ_id) from circulars';
            $max_id = mysqli_query($conn,$max_id);
            $max_id = mysqli_fetch_assoc($max_id);
            $max_id = $max_id['max(circ_id)']+1;
            // echo $max_id;
        
            $file = $_FILES['attach'];
            if (isset($_FILES['attach'])) {
                $file_name = $_FILES['attach']['name'];
                $file_size = $_FILES['attach']['size'];
                $file_tmp = $_FILES['attach']['tmp_name'];
                $file_type = $_FILES['attach']['type'];
                $file_ext = strtolower(end(explode('.', $file_name)));
                
                if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, "../uploads/circular/$max_id.".$file_ext); //The folder where you would like your file to be saved
                }
            
            $query = "INSERT INTO `circulars`(`circ_id`, `circ_title`, `circ_disc`, `circ_filename`) VALUES ($max_id,'$title','$disc','uploads/circular/$max_id.$file_ext')";
            // echo $query;
            $result = mysqli_query($conn,$query);
            }
            if ($result) {
                header('Location: ../cir-add.php?s');
            } else {
                    header('Location: ../cir-add.php?e');
            }   
        }
    }

    if(isset($_POST['del_circ'])){
        $id = addslashes($_POST['circ_id']);
        $query = "DELETE from circulars where circ_id=$id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 'Circulars Deleted Successfully';
        } else {
            echo 'Circulars Deletion Failed';
        }
    }
}
?>