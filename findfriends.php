<?php

session_start();

if ($_SESSION["userid"] == null){header("Location: index.php");
}
else{

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
  <li><a href="">Blog Post</a></li>
</ul>
<!---header ends---->


<h3 class = "friends">Search friends</h3> 
   <p class="friends">If you know your friends user name you can search for them</p> 
	    <form  method="post" action=""  id="searchform"> 
	      <input  type="text" name="name" pattern="[a-zA-Z0-9]+"> 
      <input  type="submit" name="submit" value="Search"> 
    </form> 
	</div class = "content">
	<?php
	if(isset($_POST['submit'])){ 
	
		$sessionuser = $_SESSION["userid"];
		
		echo "$sessionuser";
		$userid = $_POST['name'];

		$stmt = "select * from Users where u_name like '%$userid%'";
		$result = mysqli_query($conn, $stmt);

			
			
		
		while($row=mysqli_fetch_assoc($result)){
		
		$friend = $row['u_name'];	
		if($row['u_name'] == $sessionuser){'';}
		else{	
			
			
		echo "<div class='friend-container'>
		<div id='post-image'>
		<img src = 'getimage.php?varname=".$row['u_name']."' width = '100' height = '100' />
		</div>
		<p id = 'title'><strong> ".$row["u_name"]. "</strong></p>";
		
		include 'getfriendstatus.php';
		
		if($status == "accepted"){echo "<p> Friend</p>" ;}
		
		elseif($status == "pending"){echo"<p> pending request</p>";}
				
		else{echo "
		<form metod = 'post' action = 'sendrequest()'>
		<input type='submit' class='login-button' value = 'Add as Friend' name = 'friend'>
		</form>";}
		
		unset($status);
		echo "</div>";
		
		}
		
		} 
		}
	
	?>
	</div>
  </body> 
	</html>