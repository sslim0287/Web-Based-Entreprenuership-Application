<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	echo"You have to login first in order to see the content!";
	echo "<script>window.open('main.php', '_self')</script>";
}
?>
<html>
<head>
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_name = $row['user_name'];
	?>
	<title>Home Page</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class="row">
	<div id="insert_post" class="col-sm-12">
	<div style="font-style:italic; float:left; border-radius:20px;background-color:lavender; font-size:20px;border:3px solid #2ea7ca;width:180px;padding-left:10px;" title="include #Advertise to promote your own business
include #Job to promote your own jobs oppurtunity" class="visible">Hover this text for <br> <center><b>Hint</b></center></div>

		<center>
		<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
		<textarea style="resize:none;width: 800px;" class="form-control" id="content" rows="6" name="content" placeholder="Make a Post" required></textarea><br>
		<label class="btn btn-warning" id="upload_image_button">Select Image
		<input type="file" name="upload_image" size="30">
		</label>
		<button id="btn-post" class="btn btn-success" name="sub">Post</button>
		</form>
		<?php insertPost(); ?>
		</center>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<h2 style="text-align: center; font-size:30px;color:cornflowerblue;background-color:cornsilk;
				width:300px;margin-left:800px;border: 3px solid #4c4741;border-radius:25px;height:60px;padding-top:10px;"><strong>News Feed</strong></h2><br>
		
		<?php echo get_posts(); ?>
	</div>
</div>


</body>
</html>