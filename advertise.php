<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>
<html>
<head>
	<title>Advertise Page</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class="row">
    <center><h2 style="text-align: center; font-size:30px;color:cornflowerblue;background-color:cornsilk;
				width:300px;border: 3px solid #4c4741;border-radius:25px;height:60px;padding-top:10px;">Advertise Area</h2></center>
    <?php promote(); ?>
</div>
</body>
</html>