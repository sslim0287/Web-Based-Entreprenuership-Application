<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	echo"<script>alert('You have to login first in order to see the content!')</script>";
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
	<title>Trending Page</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style>

	.chart{
		background-color: #FFF;
		width: 80%;
		height: 80%;
		margin-left: 200px;
		border: 5px solid #000;
		padding-left: 30px;
	}
</style>
<body>
<h1 style="color:#82490c; text-align: center; border: 3px solid #a5d5c9; background-color: #f9edec; width:400px;margin-left:750px;border-radius:25px;padding-top:8px;height:60px;">Trending Data</h1>
<div class="row" style="padding-left: 20px; padding-right:20px;">
	<div class="chart">
      <h1 style="margin-left: 20px;"> Trending Jobs | Salary Per Year </h1>
	  <hr>
	  <br><br>
      <canvas id="canvasJobsType"></canvas>
      <br><br>
	  </div>
	  <br>
</div>
<div class="row" style="padding-left: 20px; padding-right:20px;">
	<div class="chart">
	<h1>Trending Businesses | Profit Per Month </h1>
      <canvas id="canvasBusinessesType"></canvas>
	</div>
	<br>

</div>

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script type="text/javascript" src="js/app5.js"></script>
    <script type="text/javascript" src="js/app6.js"></script>


</body>
</html>