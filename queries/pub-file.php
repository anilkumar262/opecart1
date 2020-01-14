<?php
session_start();if (isset($_SESSION['fac_id'])) {

    if(isset($_FILES['attach']))
        {
            if ($_FILES['attach']['error'] > 0) {
                    header('Location: ../pub-csv.php?e');    
            }
            else
            {
                
                //  echo $max_id;

                $file = $_FILES['attach'];
                if (isset($_FILES['attach'])) 
                {
                    $file_name = $_FILES['attach']['name'];
                    $file_size = $_FILES['attach']['size'];
                    $file_tmp = $_FILES['attach']['tmp_name'];
                    $file_type = $_FILES['attach']['type'];
                    $file_ext = strtolower(end(explode('.', $file_name)));
                    if($file_ext!='csv')
                    {
                        header('Location: ../pub-csv.php?e');  
                    }
                    else{
                            if (empty($errors) == true) {
                                move_uploaded_file($file_tmp, "../uploads/publicationcsv/$fac_id.".$file_ext); //The folder where you would like your file to be saved
                                header('Location: ../pub-csv.php?s');
                            }
                        
                        // $query = "INSERT INTO `circulars`(`circ_id`, `circ_title`, `circ_disc`, `circ_filename`) VALUES ($max_id,'$title','$disc','uploads/circular/$max_id.$file_ext')";
                        // echo $query;
                        // $result = mysqli_query($conn,$query);
                            else {
                                    header('Location: ../pub-csv.php?e');
                            }
                        }    
                }
            }
        }
    }
?>