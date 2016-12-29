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

<h2 class="friends"> You're friend requests </h2>
<?php
$sessionuser = $_SESSION["userid"];
		
		
		$stmt = "select * from Friends where u_name2 = '$sessionuser' and status = 'pending' ";
		$result = mysqli_query($conn, $stmt);
		$i=0;
		
		while($row=mysqli_fetch_assoc($result)){
		
		$u_name1 = $row['u_name1'];
			
		echo "<a href = 'viewfriendreq.php?friendid=".$u_name1."'>
		<div class='friend-container'>
		<div id='post-image'>
		<img src = 'getimage.php?varname=".$row['u_name1']."' width = '100' height = '100' />
		</div>
		<p id = 'title'><strong> ".$row["u_name1"]. "</strong></p>
		</div>
		</a>";
		}
		
				
		
		
?>		