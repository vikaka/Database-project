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

$article_id = $_GET["articlename"];



$stmt = "select * from article_media where article_id = '$article_id'";
$result = mysqli_query($conn, $stmt);


$row = mysqli_fetch_array($result);

header("Content-type: image/jpeg");
  echo $row['media'];



?>