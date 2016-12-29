<?php

session_start();


$servername = "localhost:3306";
$username = "visheshkakarala";
$password = "kakarala";
$dbname = "socnet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$post_id = $_GET["postname"];



$stmt = "select * from post_media where post_id = '$post_id'";
$result = mysqli_query($conn, $stmt);


$row = mysqli_fetch_array($result);

header("Content-type: image/jpeg");
  echo $row['media'];



?>