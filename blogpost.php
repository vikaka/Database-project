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



if(isset($_POST['Post_blog'])){
 

$userid = $_SESSION["userid"];
$title = $_POST["title"];
$content = $_POST["content"];
$location = $_POST["location"];	
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$articleid = uniqid($_SESSION["userid"]);
$visible = $_POST["visible"];


$imagename=$_FILES["image"]["name"]; 
$imagetmp=addslashes(file_get_contents($_FILES['image']['tmp_name']));



$article_insert = "INSERT INTO `socnet`.`Article` (`article_id`, `u_name`, `title`, `content`, `timestamp`, `access`) VALUES ('$articleid', '$userid', '$title', '$content', NOW(), '$visible');";
$insert_image="INSERT INTO `socnet`.`article_media` (`article_id`,`media`,`media_name`) VALUES ('$articleid','$imagetmp','$imagename');";
$article_location = "INSERT INTO `socnet`.`article_location` (`article_id`, `location_name`, `latitude`, `longitude`) VALUES ('$articleid', '$location', '$latitude', '$longitude');";


$run_post= mysqli_query($conn,$article_insert);
$run_image= mysqli_query($conn,$insert_image);
$run_location = mysqli_query($conn,$article_location);

}
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" type="text/css" href ="css/welcomestyle.css">
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Nunito:400,300,700'>
<link rel = "stylesheet" type="text/css" href ="css/stylesheet.css">
	
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyDiTiqk3yK3W9-oV1hHQhQXCctlQIiLO18"></script>
        <script>
            var autocomplete;
            function initialize() {
              autocomplete = new google.maps.places.Autocomplete(
                  /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
                  { types: ['geocode'] });
              google.maps.event.addListener(autocomplete, 'place_changed', function() {
              });
            }
        </script></head>
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

<div class = "content">
	
	<div id = "content_timeline">
			<form action = "" method="post" id = "f" enctype="multipart/form-data">
			<h2> What have you been upto ?</h2>
			<input type ="text" name="title" placeholder="Write a title.." size = "65"></input></br>
			<textarea cols = "100" rows="25" name="content">Tell us more ?</textarea></input></br>
			<input id="autocomplete" placeholder="Add Location" onFocus="geolocate()" name = "location" type="text">
			<label for="files" class="btn">Select Image</label>
			<input  type="file" name = "image" id="fileToUpload"></input></br>
			<input type="hidden" data-geo="lat" value="" name="latitude">
			<input type="hidden" data-geo="lng" value="" name="longitude">
			<select id="visible" type="select" name="visible">
				
				<option value="Public">Public</option>
				<option value="fof">Friends of Friends</option>
				<option value="Friends">Friends</option>
				<option value="onlyme">Only Me</option>
			</select>	
			<input type='submit' class='postbutton' value = 'Post to Blog' name = 'Post_blog'></input></br>
			
			</form>
			<div id ="posts">
			<h3> Blogs from your network </h3>
				<?php
				
				$get_article = "call articles_list('$userid');";
				$run_article = mysqli_query($conn,$get_article);
				
				
				
				if (mysqli_num_rows($run_article) > 0) {
					while($articles = mysqli_fetch_assoc($run_article)) {
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
				} else {
					echo "No articles to display";
				}
				
				?>
			</div>
		</div>
	</div>	
		




</body>
</html>