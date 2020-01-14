<html>
    <head>
    </head>
    <body>
        <?php
        $conn=mysqli_connect("localhost","root","","opencart");
        $data = file_get_contents("https://control.textlocal.in/feeds/inbox/?id=1049281&inbox=10&hash=ba1475525039fbdb31c9dbd7a60a0e51a66332a7485b5527f959cb1f5b0479da");
        $x = new SimpleXmlElement($data);
        echo "<pre>".$x."</pre>";
        $i=1;
        foreach($x->channel->item as $entry) {
            $i++;
            if($i==10){
            break;
            }
            // echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";
            echo $entry->description."<br>";
            $str= $entry->description;
            // $str=explode(" ",$str);
            $time=$entry->pubDate;
            $mob=$entry->title;
            $valid="Select * from oc_farmer where oc_f_num='$mob'";
            $v=mysqli_query($conn,$valid);
            $rowcountf=mysqli_num_rows($v);
            if($rowcountf==1)
            {  
                $query="select * from oc_msg where mobile='$mob' and msgtime='$time'";
                // echo $query."<br>";
                $q=mysqli_query($conn,$query);
                $rowcount=mysqli_num_rows($q);
                // echo $rowcount."<br>";
                if($rowcount < 1)
                {
                    $query1="INSERT INTO `oc_msg`(`mobile`, `msg`, `msgtime`) VALUES ('$mob','$str','$time')";
                    // echo "$query1";
                    $q1=mysqli_query($conn,$query1);
                    if($q1){
                        echo "Not Found Inserted"."<br>";
                    }
                    $a = explode(' ', $str);
                    $model = "SELECT * from oc_pro where pro_id=$a[1]";
                    $model=mysqli_query($conn,$model);
                    $model = mysqli_fetch_assoc($model);
                    $add_pro = "INSERT INTO `oc_product`(`model`,`phnum`, `sku`, `upc`, `ean`, `jan`, `isbn`, `mpn`, `location`, `quantity`, `stock_status_id`, `image`, `manufacturer_id`, `shipping`, `price`, `points`, `tax_class_id`, `date_available`, `weight`, `weight_class_id`, `length`, `width`, `height`, `length_class_id`, `subtract`, `minimum`, `sort_order`, `status`, `viewed`, date_added,date_modified	) VALUES ('".$model['pro_name']. "', '$mob', '', '', '', '', '', '', 1, 7, '" . $model['pro_img'] . "', 0, 1, '$a[3]', 0, 0, '".date("Y-m-d"). "', 0, 1, 0, 0, 0, 1, 1, 1, 1, 1,1,'2009-02-03 16:06:50','2009-02-03 16:06:50')";
                    $add_pro = mysqli_query($conn,$add_pro);
                    $in_id = mysqli_insert_id($conn);

                    $add_disc = "INSERT INTO `oc_product_description`(`product_id`, `language_id`, `name`, `description`, `tag`, `meta_title`, `meta_description`, `meta_keyword`) VALUES ($in_id,1,'". $model['pro_name']. "($a[2]" ."Kg)". "','','','" . $model['pro_name'] . "','','')";
                    mysqli_query($conn, $add_disc);
                    
                    $add_cat= "INSERT INTO oc_product_to_category(product_id,category_id) values($in_id,'".$model['pro_category']."')";
                    mysqli_query($conn, $add_cat);
                    
                    $add_layout = "INSERT INTO `oc_product_to_layout`(`product_id`, `store_id`, `layout_id`) VALUES ($in_id,0,0)";
                    mysqli_query($conn, $add_layout);
                    
                    $add_store="INSERT INTO `oc_product_to_store`(`product_id`, `store_id`) VALUES ($in_id,0)";
                    mysqli_query($conn, $add_store);

                }
                else{
                    echo "Already Inserted"."<br>";
                }
            }
            else{
                echo "Invalid user";
            // Authorisation details.
            $username = "naveenaduri111@gmail.com";
            $hash = "ba1475525039fbdb31c9dbd7a60a0e51a66332a7485b5527f959cb1f5b0479da";

            // Config variables. Consult http://api.textlocal.in/docs for more info.
            $test = "0";

            // Data for text message. This is the text message data.
            $sender = "TXTLCL"; // This is who the message appears to be from.
            $numbers = "$mob"; // A single number or a comma-seperated list of numbers
            $message = "You are not a valid user.Please register in the website";
            // 612 chars or less
            // A single number or a comma-seperated list of numbers
            $message = urlencode($message);
            $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
            $ch = curl_init('http://api.textlocal.in/send/?' . $data);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch); // This is the result from the API
            // echo $result;
            curl_close($ch);
            }
            
        } ?>
    </body>
</html>