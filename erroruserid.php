<?php
if(isset($_POST['login'])){
	header( "Location: login.php" );
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
<h2 class = "header"> Userid does not exist, check userid or sign up </h2>
  <div class="container">
  <div class="form-container flip">
<div class="form-group">
		<form  action="" method="post">

		<input type="submit" class="login-button" value = "Go back" name = "login" >
			</form>
			
			
		</div>
	