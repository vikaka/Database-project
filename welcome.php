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




if(isset($_POST['Post_timeline'])){
 

$userid = $_SESSION["userid"];
$title = $_POST["title"];
$content = $_POST["content"];
$location = $_POST["location"];	
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$postid = uniqid($_SESSION["userid"]);
$visible = $_POST["visible"];


$imagename=$_FILES["image"]["name"]; 
$imagetmp=addslashes(file_get_contents($_FILES['image']['tmp_name']));



$post_insert = "INSERT INTO `socnet`.`Post` (`post_id`, `u_name`, `title`, `content`, `timestamp`, `access`) VALUES ('$postid', '$userid', '$title', '$content', NOW(), '$visible');";
$insert_image="INSERT INTO `socnet`.`post_media` (`post_id`,`media`,`media_name`) VALUES ('$postid','$imagetmp','$imagename');";
$post_location = "INSERT INTO `socnet`.`post_location` (`Post_id`, `location_name`, `latitude`, `longitude`) VALUES ('$postid', '$location', '$latitude', '$longitude');";


$run_post= mysqli_query($conn,$post_insert);
$run_image= mysqli_query($conn,$insert_image);
$run_location = mysqli_query($conn,$post_location);

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
	<div id = "user_timeline">
		<div id = "user_details">
		
		<?php
		$userid = $_SESSION["userid"];
		
		$get_user = "select * from Users where u_name = '$userid'";
		$run_user = mysqli_query($conn,$get_user);
		$row = mysqli_fetch_array($run_user);
		
		$URL = $row['Picture'];
		$country = $row['Country'];
		echo "
		<p><img src = 'getimage.php?varname=".$userid."' width='200' height = '200'/><p>
		<p><strong> $userid </strong></p>
		<p><strong> $country </strong></p>
		<li><a href='profile.php'>Edit profile</a></li>
		<li><a href='logout.php'>Logout</a></li>
		";
		?>
		
		</div>
	</div>
	<div id = "content_timeline">
			<form action = "" method="post" id = "f" enctype="multipart/form-data">
			<h2> Where does your adventure take you today ?</h2>
			<input type ="text" name="title" placeholder="Write a title.." size = "65"></input></br>
			<textarea cols = "70" rows="4" name="content">What are you upto ?</textarea></input></br>
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
			<input type='submit' class='postbutton' value = 'Post to timeline' name = 'Post_timeline'></input></br>
			
			</form>
			<div id ="posts">
			<h3> Look what your friends are upto </h3>
				<?php
				
				$get_posts = "select * from Post";
				$run_posts = mysqli_query($conn,$get_posts);
				
				$get_postsimage = "select * from post_media";
				$run_postsimage = mysqli_query($conn,$get_postsimage);
				
				
				if (mysqli_num_rows($run_posts) > 0) {
					while($posts = mysqli_fetch_assoc($run_posts)) {
						$postsimage = mysqli_fetch_assoc($run_postsimage);
						$postid = $posts['post_id'];
						echo "
						<a href= 'posts.php?postid=".$postid."'>
						<div class='post-container' >
						<div id='post-image'>
						<img src = 'getimage.php?varname=".$posts['u_name']."' />
						</div>
						<p id = 'title'><strong> ".$posts["u_name"]. "</strong></p>
						<p> ".$posts["title"]." </p>
						<p> ".$posts["content"]." </p>
						<img src = 'getpostimage.php?postname=".$posts['post_id']."' width = '100' height ='100'/>
						</div>
						</a>";
						
						
					}
				} else {
					echo "No posts to display";
				}
				
				?>
			</div>
		</div>
	</div>	
		




</body>
</html>