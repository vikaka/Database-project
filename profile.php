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


$userid = $_SESSION["userid"];

$get_profile = "select * from Users where u_name = '$userid'";
$run_profile = mysqli_query($conn,$get_profile);

$profile = mysqli_fetch_assoc($run_profile);

$email = $profile["email"];
$dob = $profile["dob"];
$country = $profile["Country"];

if(isset($_POST['update'])){

$imagename=$_FILES["profilepic"]["name"]; 
$imagetmp=addslashes(file_get_contents($_FILES['profilepic']['tmp_name']));

$insert_image="UPDATE `socnet`.`Users` SET `Picture` = '$imagetmp' where u_name = '$userid' ;";
$run_insert = mysqli_query($conn,$insert_image);


}


}
?>
<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" type="text/css" href ="css/stylesheet.css">
<link rel = "stylesheet" type="text/css" href ="css/welcomestyle.css">

</head>
<body>

<ul class = "menu">
  <li><a href="" class= "header1">Travelpad</a></li>
  <li><a href="welcome.php">Home</a></li>
  <li><a href="friends.php">Friends</a></li>
  <li><a href="friendreq.php">Friend requests</a></li>
  <li><a href="findfriends.php">Find Friends</a></li>
  <li><a href="postsearch.php">Search posts</a></li>
  <li><a href="">Blog Post</a></li>
</ul>

<div class="container">
  <div class="form-container flip">
	<form class = "login-form" action="" method="post" enctype="multipart/form-data">

	<h3 class="title">Edit Profile</h3>
		<div class="display-id" id="username">
        <p class="profile-display"> <?php echo $userid ?></p>
        </div>
		
		
	<div class="form-group" id="email">
        <input class="form-input" type = "email" tooltip-class="email-tooltip" placeholder="E-mail" name = "email" value = "<?php echo $email ?>" required="true"></input>
        <span id="email-tool"class="tooltip email-tooltip">Enter Your Email Id</span>
		</div>
		
	<div class="form-group" id="DOB">
        <input class="form-input" type="date" name = "DOB" tooltip-class="DOB-tooltip" value = "<?php echo $dob ?>"required="true"></input>
        <span id="DOB-tool"class="tooltip DOB-tooltip">Select your DOB</span>
	</div>

	<input  type="file" name = "profilepic" id="fileToUpload"></input></br>	
	
		

	
      <div class="form-group">

		<input type="submit" class="login-button" value = "update" name = "update">

		
		</div>
		</form>
	
		
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
		<script src='https://code.jquery.com/jquery-2.1.4.min.js'></script>
		<script type="text/javascript">
		$('.tooltip').hide();

		$('.form-input').focus(function() {
		   $('.tooltip').fadeOut(250);
		   $("."+$(this).attr('tooltip-class')).fadeIn(500);
		});

		$('.form-input').blur(function() {
		   $('.tooltip').fadeOut(250);
		});
				
		
		
		
		</script>	