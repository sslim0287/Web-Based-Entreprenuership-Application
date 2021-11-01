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
    <title>View Your Post</title>
    <meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">
    

</head>
<body>
    <div class="row">
        <div class="col-sm-12">
            <center><h2  style="text-align: center; font-size:30px;color:cornflowerblue;background-color:cornsilk;
				width:300px;border: 3px solid #4c4741;border-radius:25px;height:60px;padding-top:10px;">Comments</h2><br></center>
            <?php single_post(); ?>
        </div>
    </div>
</body>
</html>