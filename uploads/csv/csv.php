<?php
$fp=fopen("citations.csv",'r');
while($data=fgetcsv($fp, ",")){
    // print_r($data);
    echo $data[0]."<br>";
    echo $data[1]."<br>";
    echo $data[2]."<br>";
    echo $data[3]."<br>";
    echo $data[4] . "<br>";
    echo $data[5] . "<br>";
    echo $data[6] . "<br>";
    echo $data[7] . "<br>";
        echo "<br><br>";
}
?>