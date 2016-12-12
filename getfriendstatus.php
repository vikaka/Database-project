<?php


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



$check_status = "call friendstatus('$sessionuser','$friend');";
$result_status = mysqli_query($conn, $check_status);
$run_status = mysqli_fetch_assoc($result_status);

if(mysqli_num_rows($result_status)==1){$status = $run_status['status'];}
else{
$status = "error";
}


?>