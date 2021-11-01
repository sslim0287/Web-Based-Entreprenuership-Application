<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/signup.css">

</head>
<style>
	body{
		overflow-x: hidden;
	}
	.main-content{
		width: 50%;
		height: 40%;
		margin: 10px auto;
		background-color: #fff;
		border: 2px solid #e6e6e6;
		padding: 40px 50px;
	}
	.header{
		border: 0px solid #000;
		margin-bottom: 5px;
	}
	.well{
		background-color: #187FAB;
	}
	#signup{
		width: 60%;
		border-radius: 30px;
	}

</style>
<body>
<div class="row">
	<div class="col-sm-12">
		<div class="well">
		<a style="text-decoration: none;" href="main.php"><center><h1 style="color: white;">Web-Based Entrepreneur Application</h1></center></a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
	<div class="container">
  	<section id="content">
		
			
	  				<h1 style="text-align: center;"><strong>Join Now</strong></h1>
				
			<div class="l-part">
				<form action="" method="post">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
						<input type="text" class="form-control" placeholder="First Name" name="first_name" required="required">
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
						<input type="text" class="form-control" placeholder="Last Name" name="last_name" required="required">
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="password" type="password" class="form-control" placeholder="Password" name="u_pass" required="required">
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id="email" type="email" class="form-control" placeholder="Email" name="u_email" required="required">
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
						<select class="form-control" name="u_country" required="required">
							<option disabled>Select your State</option>
							<option>Kedah</option>
							<option>Kelantan</option>
							<option>Penang</option>
							<option>Pahang</option>
							<option>Perak</option>
							<option>Perlis</option>
							<option>Malacca</option>
							<option>Terengganu</option>
							<option>Negeri Sembilan</option>
							<option>Selangor</option>
							<option>Johor</option>
							<option>Sabah</option>
							<option>Sarawak</option>

						</select>
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
						<select class="form-control" name="job_field"  required="required">
							<option disabled>Select your Job Field</option>
                            <option>Architecture and engineering</option>
                            <option>Arts, culture and entertainment</option>
                            <option>Business, management and administration</option>
                            <option>Communications</option>
                            <option>Community and social services</option>
                            <option>Education</option>
                            <option>Science and technology</option>
                            <option>Installation, repair and maintenance</option>
                            <option>Farming, fishing and forestry</option>
                            <option>Health and medicine</option>
                            <option>Law and public policy</option>
                            <option>Sales</option>
                            <option>Others</option>


						</select>
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
						<select class="form-control input-md" name="u_gender" required="required">
							<option disabled>Select your Gender</option>
							<option>Male</option>
							<option>Female</option>
						</select>
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input type="date" class="form-control input-md" placeholder="Email" name="u_birthday" required="required">
					</div><br>
					<a style="text-decoration: none;float: right;color: #187FAB;" data-toggle="tooltip" title="Signin" href="signin.php">Already have an account?</a><br><br>

					<center><button id="signup" class="btn btn-info btn-lg" name="sign_up" style="margin-bottom:40px;">Signup</button></center>
					<?php include("insert_user.php"); ?>
				</form>
			</div>
		</div>
	  </section>
		</div>
	</div>
</div>
</body>
</html>
