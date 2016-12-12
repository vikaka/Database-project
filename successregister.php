<?php
if(isset($_POST['register'])){
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
<h1 class = "header">Welcome to TravelPad !</h1>

<div class="container">
  <div class="form-container flip">
	<form class = "login-form" action="" method="post">

	<h3 class="title">You are now a Member</h3>
		
      <div class="form-group">

		<input type="submit" class="login-button" value = "Go to Login" name = "register">

		
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


