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

$sessionuser = $_SESSION["userid"];
$friend = $_GET["varname"];


if(isset($_POST["friend"])){


$friend_req= "INSERT INTO `socnet`.`Friends` (`u_name1`, `u_name2`, `status`, `timestamp`) VALUES ('$sessionuser', '$friend', 'pending', NOW());";
$send_req = mysqli_query($conn,$friend_req);
}
?>

		
		
<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" type="text/css" href ="css/welcomestyle.css">
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Nunito:400,300,700'>
<link rel = "stylesheet" type="text/css" href ="css/stylesheet.css">
</head>
<body onload="initialize()">
<ul>
  <li><a href="" class= "header">Travelpad</a></li>
  <li><a href="welcome.php">Home</a></li>
  <li><a href="friends.php">Friends</a></li>
  <li><a href="friendreq.php">Friend requests</a></li>
  <li><a href="findfriends.php">Find Friends</a></li>
  <li><a href="postsearch.php">Search posts</a></li>
  <li><a href="blogpost.php">Blog Post</a></li>
</ul>
<!---header ends---->


<h3 class = "friends">Search friends</h3> 
	<?php
		
		$stmt = "select * from Users where u_name = '$friend'";
		$result = mysqli_query($conn, $stmt);
		$row = mysqli_fetch_assoc($result);
			
		echo "
		<div class='friend-container'>
		<div id='post-image'>
		<img src = 'getimage.php?varname=".$row['u_name']."' width = '100' height = '100' />
		</div>
		<p id = 'title'><strong> ".$row["u_name"]. "</strong></p>";
		include 'getfriendstatus.php';
		
		if($status == "accepted"){echo "<p> Friend</p>" ;}
		
		elseif($status == "pending"){echo"<p> pending request</p>";}
				
		else{echo "
		<form method = 'post' action = ''>
		<input type='submit' class='login-button' value = 'Add as Friend' name = 'friend'>
		</form>";}
		
		unset($status);
		echo "</div>";

		
		
		
	
	?>
	</div>
  </body> 
	</html>
		