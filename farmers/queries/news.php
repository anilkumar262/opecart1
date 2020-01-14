<?php
session_start();if(isset($_SESSION['fac_id'])){

    include '../../departments/connect.php';
    if(isset($_FILES['attach'])){

        if ($_FILES['attach']['error'] > 0) {
            $title = addslashes($_POST['news_title']);
            $disc = addslashes($_POST['news_disc']);
            $news_disc = str_replace("'",'`',news_disc);        
            $query = "INSERT INTO `news`(`news_title`, `news_disc`, `news_filename`) VALUES ('$title','$disc','0')";
            $result = mysqli_query($conn,$query);
            if($result){
                header('Location: ../news-add.php?s');
            }
            else{
                header('Location: ../news-add.php?e');
            }
        }
        else{
            $title = addslashes($_POST['news_title']);
            $disc = addslashes($_POST['news_disc']);
            $max_id = 'SELECT max(news_id) from news';
            $max_id = mysqli_query($conn,$max_id);
            $max_id = mysqli_fetch_assoc($max_id);
            $max_id = $max_id['max(news_id)']+1;
            echo $max_id;
        
            $file = $_FILES['attach'];
            if (isset($_FILES['attach'])) {
                $file_name = $_FILES['attach']['name'];
                $file_size = $_FILES['attach']['size'];
                $file_tmp = $_FILES['attach']['tmp_name'];
                $file_type = $_FILES['attach']['type'];
                $file_ext = strtolower(end(explode('.', $file_name)));
                
                if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, "../uploads/news/$max_id.".$file_ext); //The folder where you would like your file to be saved
                }
            
            $query = "INSERT INTO `news`(`news_id`, `news_title`, `news_disc`, `news_filename`) VALUES ($max_id,'$title','$disc','uploads/news/$max_id.$file_ext')";
            // echo $query;
            $result = mysqli_query($conn,$query);
            }
            if ($result) {
                header('Location: ../news-add.php?s');
            } else {
                header('Location: ../news-add.php?e');
            }   
        }
    }
    if(isset($_POST['news_id'])){
        $id = addslashes($_POST['news_id']);
        $query = "DELETE from news where news_id=$id";
        $result=mysqli_query($conn,$query);
        if($result){
            echo 'News Deleted Successfully';
        }
        else{
            echo 'News Deletion Failed';
        }
    }
}
?>