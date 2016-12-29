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

$userid = $_SESSION["userid"];

$articleid = $_GET["articleid"];


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
				<?php
				
				$get_articles = "select * from Article where article_id = '$articleid'";
				$run_articles = mysqli_query($conn,$get_articles);
				
				$get_likes = "select count(*) from article_likes where article_id = '$articleid' and type = 'like';";
				$run_likes = mysqli_query($conn,$get_likes);
				$likes = mysqli_fetch_assoc($run_likes);
				
				$get_dislikes = "select count(*) from article_likes where article_id = '$articleid' and type = 'dislike';";
				$run_dislikes = mysqli_query($conn,$get_dislikes);
				$dislikes = mysqli_fetch_assoc($run_dislikes);
				
				
				$get_userlikes = "select count(*) from article_likes where article_id = '$articleid' and u_name = '$userid';";
				$run_userlikes = mysqli_query($conn,$get_userlikes);
				$userlikes = mysqli_fetch_assoc($run_userlikes);
				
				$get_location = "select * from article_location where article_id = '$articleid';";
				$run_location = mysqli_query($conn,$get_location);
				$location = mysqli_fetch_assoc($run_location);
				
				
					$articles = mysqli_fetch_assoc($run_articles);
						echo "
						<div class='post-container'>
						<div id='post-image'>
						<img src = 'getimage.php?varname=".$articles['u_name']."' />
						</div>
						<p id = 'title'><strong> ".$articles["u_name"]. "</strong></p>
						<p> ".$articles["title"]." </p>
						<p> ".$articles["content"]." </p>
						<img src = 'getarticleimage.php?postname=".$articleid."' width = '100' height ='100'/><br>
						<p> at ".$location["location_name"]."</P>
						<p> Visible to :".$articles["access"]." </p>
						<form action = '' method='post' id = 'f'>
						<input type='submit' class='login-button' value = 'Like' name = 'like'>
						<input type='submit' class='login-button' value = 'Dislike' name = 'dislike'><br>
						<input type ='text' name='comment' placeholder='Write a comment' size = '30'></input>
						<input type='submit'  class = 'login-button' name = 'Article_comment'></input>
						</form>
						<p> ".$likes["count(*)"]." like(s)</p><p> ".$dislikes["count(*)"]." dislike(s)</p>
						</div>";
						
						if(isset($_POST['like'])){
							if($userlikes["count(*)"]>0){$update_like = "UPDATE `socnet`.`article_likes` SET `type`='like' WHERE `article_id`='$articleid' and`u_name`='$userid';";
							$run_1like = mysqli_query($conn,$update_like);}
							else{
							$add_like = "INSERT INTO `socnet`.`article_likes` (`article_id`, `type`, `u_name`, `timestamp`) VALUES ('$articleid', 'like', '$userid' , NOW());";
							$run_like = mysqli_query($conn,$add_like);}
							}
						if(isset($_POST['dislike'])){
							if($userlikes["count(*)"]>0){$update_dislike = "UPDATE `socnet`.`article_likes` SET `type`='dislike' WHERE `article_id`='$articleid' and`u_name`='$userid';";
							$run_1dislike = mysqli_query($conn,$update_dislike);}
							else{						
							$add_dislike = "INSERT INTO `socnet`.`article_likes` (`article_id`, `type`, `u_name`, `timestamp`) VALUES ('$articleid', 'dislike', '$userid' , NOW());";
							$run_dislike = mysqli_query($conn,$add_dislike);}
							}
						if(isset($_POST['Article_comment'])){
							$comment = $_POST["comment"];
							$add_comment = "INSERT INTO `socnet`.`article_comment` (`article_id`, `comment`, `u_name`, `timestamp`) VALUES ('$articleid', '$comment', '$userid' , NOW());";
							$run_comment = mysqli_query($conn,$add_comment);
							}
						
						
					?>
</div><div id ="posts">
			<h3> Comments</h3>
				<?php
				
				$get_comments = "select * from article_comment where article_id = '$articleid'";
				$run_comments = mysqli_query($conn,$get_comments);
				
				
				
				if (mysqli_num_rows($run_comments) > 0) {
					$comments = mysqli_fetch_assoc($run_comments);
						echo "
						<div class='post-container'>
						<div id='post-image'>
						<img src = 'getimage.php?varname=".$comments['u_name']."' />
						</div>
						
						<p id = 'title'><strong> ".$comments["u_name"]. "</strong></p><br>
						<p> ".$comments["comment"]." </p><br>
						<p> Posted at ".$comments["timestamp"]."</p>
						
						
						";			
						
						
						
						}
				 else {
					echo "No comments to display";
				}
				
				?>
			</div></div>
		</div>
	</div>	
		




</body>
</html>