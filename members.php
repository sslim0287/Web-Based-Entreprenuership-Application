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
	<title>Find People</title>
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
        <h2 style="text-align: center; font-size:30px;color:darkcyan;background-color:cornsilk;
				width:300px;margin-left:800px;border: 3px solid #4c4741;border-radius:25px;height:60px;padding-top:10px;">Find New People</h2><br><br>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
                <form class="search_form" action="">
                    <input type="text" placeholder="Search Friend" name="search_user">
                    <button class="btn btn-info" type="submit" name="search_user_btn">Search</button>
                </form>
            </div>
            <div class="col-sm-4">
            </div>
        </div><br><br>
        <?php search_user(); ?>
    </div>
</div>
</body>
</html>