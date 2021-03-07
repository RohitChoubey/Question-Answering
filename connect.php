<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "project";

    $conn = mysqli_connect($server,$user,$password,$db);
	/* print_r($conn);
exit(); */
    if(!$conn){
        die("Connection Failed ". mysqli_connect_error());
    }
?>

