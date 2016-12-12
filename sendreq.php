<?php

session_start();


$servername = "dbclassinstance.czhkgr2thr8b.us-east-2.rds.amazonaws.com:3306";
$username = "visheshkakarala";
$password = "kakarala";
$dbname = "socnet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sessionuser = $_SESSION["userid"];

$friend = $_GET["varname"];

$friend_req= "INSERT INTO `socnet`.`Friends` (`u_name1`, `u_name2`, `status`, `timestamp`) VALUES ('$sessionuser', '$friend', 'pending', NOW());";
$send_req = mysqli_query($conn,$friend_req);

header("Location: {$_SERVER["HTTP_REFERER"]}")
?>
