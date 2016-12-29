<?php
session_start();

if ($_SESSION["userid"] == null){header("Location: index.php");
}
else{

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

}
?>

<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" type="text/css" href ="css/welcomestyle.css">
</head>
<body>


<ul>
  <li><a href="" class= "header">Travelpad</a></li>
  <li><a href="welcome.php">Home</a></li>
  <li><a href="friends.php">Friends</a></li>
  <li><a href="friendreq.php">Friend requests</a></li>
  <li><a href="findfriends.php">Find Friends</a></li>
  <li><a href="postsearch.php">Search posts</a></li>
  <li><a href="blogpost.php">Blog Post</a></li>
</ul>

<h2 class="friends"> You're connected with </h2>
<?php
$sessionuser = $_SESSION["userid"];
		
		
		$stmt = "select * from Users ";
		$result = mysqli_query($conn, $stmt);

			
			
		
		while($row=mysqli_fetch_assoc($result)){
		
		$friend = $row['u_name'];	
		if($row['u_name'] == $sessionuser){'';}
		else{	
		
		include 'getfriendstatus.php';
			
		if($status == "accepted"){echo "<div class='friend-container'>
		<div id='post-image'>
		<img src = 'getimage.php?varname=".$row['u_name']."' width = '100' height = '100' />
		</div>
		<p id = 'title'><strong> ".$row["u_name"]. "</strong></p>" ;}
		
				
		else{'';}
		
		echo "</div>";
		
		}
		
		} 
?>		