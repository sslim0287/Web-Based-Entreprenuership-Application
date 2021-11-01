<!DOCTYPE html>
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
    body {
    background-color: #17b8aa;
    font-family: 'Ubuntu', sans-serif;
    overflow-x: hidden;

    }

    .main_content{
        width: 50%;
        height: 40%;
        margin: 10px auto;
        background-color: white;
        border: 3px solid #000;
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
                <h3 style="text-align: center;"><strong>Forgot Password</strong></h3><hr>
            </div>
            <div class="l_pass">
                <form action="" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="email" class="form-control" name="email" placeholder="Enter Your Email" required>
                    </div><br>
                    <hr>
                    <pre class="text">Enter Your Best Friend Name</pre>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input id="msg" type="text" class="form-control" name="recovery_account" placeholder="Someone" required>
                    </div><br>
                    <a style="text-decoration: none; float:right; color: #187FAB;" data-toggle="tooltip" title="Signin" href="signin.php">Back to Sign In Page</a><br><br>
                    <center><button id="signup" class="btn btn-info btn-lg" name="submit">Submit</button></center>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
session_start();

include("includes/connection.php");

	if (isset($_POST['submit'])) {

		$email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
        $recovery_account = htmlentities(mysqli_real_escape_string($con,$_POST['recovery_account']));
		$select_user = "select * from users where user_email='$email' AND recovery_account='$recovery_account'";
		$query= mysqli_query($con, $select_user);
		$check_user = mysqli_num_rows($query);

		if($check_user == 1){
			$_SESSION['user_email'] = $email;

			echo "<script>window.open('change_password.php', '_self')</script>";
		}else{
			echo"<script>alert('Your Email or Best Friend name is incorrect')</script>";
		}
	}
?>