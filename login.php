<?php
session_start();

if ($_SESSION["userid"] != null){header("Location: welcome.php");
}
else{



if(isset($_POST['login'])){

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

$userid = $_POST["user_id"];
$upass = hash('sha256',$_POST["password"]);

$stmt = "select * from Users where u_name = '$userid'";
$result = mysqli_query($conn, $stmt);


$row = mysqli_fetch_assoc($result);



if(mysqli_num_rows($result) > 0)
          {
			  
             if($upass == $row["password"])
             {
                $_SESSION['userid'] = $userid;
				$sql = "UPDATE `socnet`.`Users` SET `login_timestamp`=Now() WHERE `u_name`= '$userid';";
				$up_time = mysqli_query($conn,$sql);
                header( "Location: welcome.php" );
             }
             else
             {
                header( "Location: errorpassword.php" );
             }
          }
else
	{
				header( "Location: erroruserid.php" );
	
	}


}

}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
  <title>TravelPad</title>
  <script src="https://d3js.org/d3.v4.min.js" type="text/javascript"></script>

	<link rel = "stylesheet" type="text/css" href ="css/stylesheet.css">
	<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Nunito:400,300,700'>
</head>
<body>
<h1 class = "header"> TravelPad </h1>
<div class="container">
  <div class="form-container flip">
	<form class = "login-form" action="" method="post">

	<h3 class="title">Hello. Welcome Back !</h3>
		<div class="form-group" id="username">
        <input class="form-input" tooltip-class="username-tooltip" placeholder="Username" name = "user_id" required="true"></input>
        <span id="username-tool"class="tooltip username-tooltip">What's your username?</span>
		</div>
		
		<div class="form-group" id="password">
        <input type="password" class="form-input" name = "password" tooltip-class="password-tooltip" placeholder="Password"></input>
        <span class="tooltip password-tooltip">What's your password?</span>
      </div>
      <div class="form-group">
		<input type="submit" class="login-button" value = "Login" name = "login">
		
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

</body>
</html>
