<?php
session_start();

if ($_SESSION["userid"] != null){header("Location: welcome.php");
}
else{}

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
<body class ="front">


<h1 class = "Indexheader"> Welcome to TravelPad </h1>

<p class = "welcome"> The Ultimate destination to connect with fellow travellers </p>

<div class = "reg-container flip">
		<form class = "login-form" action="register.php">
		<input type="submit" class="reg-button" value = "New Users - Sign Up">
		</form>
		</div>
		

<div class = "reg-container flip">
		<form class = "login-form" action="login.php">
		<input type="submit" class="reg-button" value = "Login">
		</form>
		</div>
		

</body>
</html>
