<?php
// Authorisation details.
$username = "naveenaduri111@gmail.com";
$hash = "ba1475525039fbdb31c9dbd7a60a0e51a66332a7485b5527f959cb1f5b0479da";

// Config variables. Consult http://api.textlocal.in/docs for more info.
$test = "0";

// Data for text message. This is the text message data.
$sender = "TXTLCL"; // This is who the message appears to be from.
$numbers = "91$num"; // A single number or a comma-seperated list of numbers
$message = "OTP : $random";
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
?>