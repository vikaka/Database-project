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
  <li><a href="blogpost.php">Blog Post</a></li>
</ul>
<!---header ends---->


<h3 class = "friends">Search Posts</h3> 
   <p class="friends">If you want to find something in particular </p> 
	    <form  method="post" action=""  id="searchform"> 
	     <select type = "select" name = "type" >
		<option value="Posts"selected> Activity Posts</option>
		<option value="Articles">Blog Posts</option></select><br> 
		  <input  type="text" name="content" > 
      <input  type="submit" name="submit" value="Search"> 
    </form> 
	</div class = "content">
	<div id ="posts">
		
	<?php
		if(isset($_POST['submit'])){ 
	
		$sessionuser = $_SESSION["userid"];
		
				if($_POST['type'] == 'Posts'){
				$cont = $_POST['content'];
				$get_posts = "select * from Post where content like '%$cont%'";
				$run_posts = mysqli_query($conn,$get_posts);
				
				
				
				if (mysqli_num_rows($run_posts) > 0) {
					while($posts = mysqli_fetch_assoc($run_posts)) {
						$postid = $posts['post_id'];
						echo "
						<a href= 'posts.php?postid=".$postid."'>
						<div class='post-container' >
						<div id='post-image'>
						<img src = 'getimage.php?varname=".$posts['u_name']."' />
						</div>
						<p id = 'title'><strong> ".$posts["u_name"]. "</strong></p>
						<p> ".$posts["content"]." </p>
						</div>
						</a>";
					}
						
					}
					else {
					echo "No posts to display";
				}
				}
					else{
				$cont = $_POST['content'];
				$get_articles = "select * from Article where title like '%$cont%' and content like '%$cont%'";
				$run_articles = mysqli_query($conn,$get_articles);
				
				
				
				if (mysqli_num_rows($run_articles) > 0) {
					while($articles = mysqli_fetch_assoc($run_articles)) {
						$articleid = $articles['article_id'];
						echo "
						<a href= 'articles.php?articleid=".$articleid."'>
						<div class='post-container' >
						<div id='post-image'>
						<img src = 'getimage.php?varname=".$articles['u_name']."' />
						</div>
						<p id = 'title'><strong> ".$articles["u_name"]. "</strong></p>
						<p> ".$articles["title"]." </p>
						<p> ".$articles["content"]." </p>
						</div>
						</a>";
					}
						
					}
				else {
					echo "No posts to display";
				}
				}
				
		}		
		
				
				?>
				</div>
				</body>
				</html>
	
	