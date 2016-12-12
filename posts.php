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

$postid = $_GET["postid"];


}

?>

<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" type="text/css" href ="css/welcomestyle.css">
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Nunito:400,300,700'>
<link rel = "stylesheet" type="text/css" href ="css/stylesheet.css">
	
</head>
<body >
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

<div class = "content">
	
	<div id = "content_timeline">
			
			<div id ="posts">
			<h3> Look what your friends are upto </h3>
				<?php
				
				$get_posts = "select * from Post where post_id = '$postid'";
				$run_posts = mysqli_query($conn,$get_posts);
				
				
				
				if (mysqli_num_rows($run_posts) > 0) {
					$posts = mysqli_fetch_assoc($run_posts);
						echo "
						<div class='post-container'>
						<div id='post-image'>
						<img src = 'getimage.php?varname=".$posts['u_name']."' />
						</div>
						<p id = 'title'><strong> ".$posts["u_name"]. "</strong></p>
						<p> ".$posts["title"]." </p>
						<p> ".$posts["content"]." </p>
						<img src = 'getpostimage.php?postname=".$posts['post_id']."' width = '100' height ='100'/>
						<form action = '' method='post' id = 'f'>
						<input type='submit' class='login-button' value = 'Like' name = 'like'>
						<input type='submit' class='login-button' value = 'Dislike' name = 'dislike'><br>
						<input type ='text' name='comment' placeholder='Write a comment' size = '30'></input>
						<input type='submit'  class = 'login-button' name = 'Post_comment'></input>
						</form>
						</div>";
						
						
						
						if(isset($_POST['like'])){
							$add_like = "INSERT INTO `socnet`.`post_comment` (`post_id`, `comment_type`, `u_name`, `timestamp`) VALUES ('$postid', 'like', '$userid' , NOW());";
							$run_like = mysqli_query($conn,$add_like);
							}
						if(isset($_POST['dislike'])){
							$add_dislike = "INSERT INTO `socnet`.`post_comment` (`post_id`, `comment_type`, `u_name`, `timestamp`) VALUES ('$postid', 'dislike', '$userid' , NOW());";
							$run_dislike = mysqli_query($conn,$add_like);
							}
						if(isset($_POST['comment'])){
							$comment = $_POST["comment"];
							$add_comment = "INSERT INTO `socnet`.`post_comment` (`post_id`, `comment_type`, `u_name`, `timestamp`) VALUES ('$postid', '$comment', '$userid' , NOW());";
							$run_comment = mysqli_query($conn,$add_like);
							}
					}
				 else {
					echo "No posts to display";
				}
				
				?>
			</div>
		</div>
	</div>	
		




</body>
</html>