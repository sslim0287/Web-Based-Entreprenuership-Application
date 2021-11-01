<!DOCTYPE html>
<html>
<head>
	<title>Signin</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style/signinAdmin.css">

</head>

<body>
<div class="row">
	<div class="col-sm-12">
		<div class="well" style="background-color:burlywood;border-color:black;">
			<a style="text-decoration: none;" href="main.php"><center><h1 style="color:darkslateblue; text-decoration: none;">Web-Based Entrepreneur Application</h1></center></a>
		</div>
	</div>
</div>
<div class="main">
	<div class="col-sm-12">
		<div class="main-content">
			<div class="header">
				<p class="sign" style="text-align: center;"><strong>Sign In - Admin Only</strong></p>
			</div>
			<div class="l-part">
				<form action="" method="post" class="form1">
					<input type="email" name="email" placeholder="Email" required="required" class="un"><br>
					<div class="overlap-text">
						<input type="password" name="pass" placeholder="Password" required="required" class="pass"><br>
					</div>

					<button id="signin" class="submit" name="login" style="margin-top: 20px;" >Login</button>
					<?php include("loginAdmin.php"); ?>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>