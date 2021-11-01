<!DOCTYPE html>
<?php
session_start();
include("includes/connection.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>
<html>
<head>
	<title>Forgoten Password</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<style>
    body{
        background-color: #17b8aa;
    font-family: 'Ubuntu', sans-serif;
    overflow-x: hidden;
    }
    .main_content{
        width: 50%;
        height: 40%;
        margin: 10px auto;
        background-color: white;
        border: 2px solid #000;
        border-radius: 30px;
        padding: 40px 50px;
    }
    .header{
        border: 0px solid #000;
        margin-bottom: 5px;
    }
    
    #signup{
        width: 60%;
        border-radius: 30px;
    }
</style>
<body>
<div class="row">
	<div class="col-sm-12">
    <div class="well" style="background-color:burlywood;border-color:black;">
			<a style="text-decoration: none;" href="main.php"><center><h1 style="color:darkslateblue;"><b>Web-Based Entrepreneur Application</b></h1></center></a>
		</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="main_content">
            <div class="header">
                <h3 style="text-align: center;"><strong>Change Your Password</strong></h3><hr>
            </div>
            <div class="l_pass">
                <form action="" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="pass" placeholder="Enter Your New Password" required>
                    </div><br>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="pass1" placeholder="Re-Enter Your New Password" required>
                    </div><br>
                    <center><button id="signup" class="btn btn-info btn-lg" name="change">Change Password</button></center>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
    if(isset($_POST['change'])){

        $user = $_SESSION['user_email'];
        $get_user = "select * from users where user_email='$user'";
        $run_user = mysqli_query($con,$get_user);
        $row = mysqli_fetch_array($run_user);

        $user_id = $row['user_id'];

        $pass = htmlentities(mysqli_real_escape_string($con,md5($_POST['pass'])));
        $pass1 = htmlentities(mysqli_real_escape_string($con,md5($_POST['pass1'])));

        if($pass == $pass1){
            if(strlen($pass) >= 6 && strlen($pass) <= 60){
                $update = "update users set user_pass='$pass' where user_id='$user_id'";

                $run = mysqli_query($con,$update);

                echo"<script>alert('Your Password is changed a moment ago')</script>";
                echo"<script>window.open('home.php', '_self')</script>";

            }else{
                echo"<script>alert('Your Password should be more than 6 characters!')</script>";

            }
        }else{
            echo"<script>alert('Your Password did not match')</script>";
            echo"<script>window.open('change_password.php', '_self')</script>";
        }

    }
?>
