
<?php
session_start();if (isset($_SESSION['fac_id'])) {

    include '../../departments/connect.php';
    $fac_id=$_SESSION['fac_id'];
    $pub_fac1 = "Delete from `publication` where fac_id=$fac_id";
    // echo $pub_fac1;
    $pub_fac1 = mysqli_query($conn,$pub_fac1);
    $pub_fac2 = "Delete from `pub_mapping` where pub_id not in(select pub_id from publication)";
    // echo $pub_fac2;
    $pub_fac2 = mysqli_query($conn,$pub_fac2);


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
                            if (empty($errors) == true) 
                            {
                                move_uploaded_file($file_tmp, "../uploads/publicationcsv/$fac_id.".$file_ext); //The folder where you would like your file to be saved
                                    $fp=fopen("../uploads/publicationcsv/$fac_id.csv",'r');
                                    $data=fgetcsv($fp, ",");
                                    while($data=fgetcsv($fp, ",")){
                                        // print_r($data);
                                        // echo $data[0]."<br>";
                                        // echo $data[1]."<br>";
                                        // echo $data[2]."<br>";
                                        // echo $data[3]."<br>";
                                        // echo $data[4] . "<br>";
                                        // echo $data[5] . "<br>";
                                        //  echo $data[6] . "<br><br>";
                                        // echo $data[7] . "<br>";
                                        //     echo "<br><br>";
                                        if($data[6]==''){ $data[6]=1977; }
                                            $data[0]=str_replace(';','.,', $data[0]);
                                            $q= "INSERT INTO `publication`(`fac_id`,`pub_title`, `pub_author`, `pub_year`, `pub_type_name`, `pub_publisher`, `pub_volume`, `pub_number`, `pub_pages`) VALUES ('$fac_id','$data[1]','$data[0]','$data[6]','$data[2]','$data[7]','$data[3]','$data[4]','$data[5]')";
                                            // echo $q."<br>";
                                            $q = mysqli_query($conn,$q);	
                                            $pub_id = mysqli_insert_id($conn);
                                            $pub_fac = "INSERT INTO `pub_mapping`(`pub_id`, `fac_id`) VALUES ($pub_id,{$_SESSION['fac_id']})";
                                            // echo $pub_fac."<br>";
                                            $pub_fac = mysqli_query($conn,$pub_fac); 
                                            if($q && $pub_fac){
                                                $flag=1;
                                                // echo 'Publication Added Successfully';
                                            }		
                                            else{
                                                $flag=0;
                                                break;
                                                // echo 'Publication Addition failed';
                                            }                           
                                        }
                                        if($flag=='1'){
                                            header('Location: ../pub-csv.php?s');
                                        }
                                        if($flag=='0'){
                                            header('Location: ../pub-csv.php?e');
                                            
                                        }
                                // header('Location: ../pub-csv.php?s');

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
    