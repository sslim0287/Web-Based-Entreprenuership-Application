<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	<script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style/quote.css">
	<link rel="stylesheet" type="text/css" href="style/stylish_border.css">


</head>
<style>
	
	body{
		overflow-x: hidden;
		background-image: url(images/123.jpg);
		background-repeat: no-repeat;
		background-size: cover;
		position: absolute;
		top:0px;
		left:0px;
		width: 100%;
		height: 100%;
	}
	
	
	#signup{
		width: 60%;
		border-radius: 30px;
	}
	#login{
		width: 60%;
		background-color: #fff;
		border: 1px solid #1da1f2;
		color: #1da1f2;
		border-radius: 30px;
	}
	#login:hover{
		width: 60%;
		background-color: #fff;
		color: #1da1f2;
		border: 2px solid #1da1f2;
		border-radius: 30px;
	}
	
</style>
<body>
<nav class="navbar navbar-default" style="background-image:linear-gradient(#86FAF2,  #00A6D7); padding-bottom:5px;border-color:black;">
	<div class="container-fluid">
		<div class="header">
			<a class="navbar-brand" href="main.php" style="margin-top: -12px;color:black;"><h3>Web-Based Entrepreneur Application</h3></a>
		
			<div class="header-right" >
	      	<ul class="nav navbar-nav">
			<li><a href="signup.php" style="margin-left: 1000px; margin-top: -12px;color: #BFFF00;-webkit-text-stroke: 0.25px white;"><h3>Sign up</h3></a></li>
			<li><a href="signin.php" style="margin-left: 50px; margin-top: -12px;color: #BFFF00;-webkit-text-stroke: 0.25px white;"><h3>Login</h3></a></li>
			<li><a href="signinAdmin.php" style="margin-left: 50px; margin-top: -12px;color: #BFFF00;-webkit-text-stroke: 0.25px white;"><h3>Admin</h3></a></li>


			</ul>
			</div>
		</div>
		
	</div>
</nav>	
	<div class="row"  style="display: flex; height: 100px;">
		<div class="component">
		<div class="gradient-border" id="box">
				<div class="col-sm-6"  style="width: 50%;">
					<div class="quote">
						You don't learn to walk by following rules. You learn by doing and falling over. <br>
					<cite> - Richard Branson</cite>
					</div>
					<div class="quote">
					 You have to see failure as the beginning and the middle, but never entertain it as an end. <br>
					<cite> - Jessica Herrin</cite>
					</div>
					<div class="quote">
					&nbsp&nbspDon’t let others convince you that the idea is good when your gut tells you it’s bad. <br>
					<cite> - Kevin Rose</cite>
					</div>
					<div class="quote">
					&nbsp&nbsp&nbsp&nbspDon’t try to do everything by yourself, but try to connect with people and resources. <br>
					<cite> - Chieu Cao</cite>
				</div>
		</div>
		</div>	
		</div>

			<div class="" style="margin-right:125px;margin-top:70px;">
			<img style="width: 800px;height: 250px;"src="images/mainimage.png">
			</div>
		
	</div>

	


<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("quote");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 5000); // Change every 5 seconds
}
</script>
</body>
</html>

