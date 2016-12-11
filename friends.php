<?php
session_start();
if ($_SESSION["userid"] == null){header("Location: index.php");
}
else{
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
  <li><a href="">Blog Post</a></li>
</ul>

<h2 class="friends"> You're connected with </h2>