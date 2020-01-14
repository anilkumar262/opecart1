<?php 

    $name = $_POST['name'];
    $phnum = $_POST['phnum'];
	$pr_id = $_POST['pr_id'];
	$conn=mysqli_connect("localhost","root","","opencart");
	$f_phnum = "SELECT * FROM `oc_product` WHERE product_id=$pr_id";
	$f_phnum = mysqli_query($conn,$f_phnum);
    $f_phnum = mysqli_fetch_assoc($f_phnum);
	$enquiry = "INSERT INTO `oc_enquiry`(`pr_id`, `c_name`, `c_phnum`, `f_phnum`) VALUES ($pr_id,'$name',$phnum,'".$f_phnum['phnum']."')";
    echo $enquiry;
	$enquiry = mysqli_query($conn,$enquiry);
	if($enquiry)
	{
		echo "Your details are successfully submitted...The farmer will contact you";
	}
	else{
		echo "Error! Retry";
	}
	
?>