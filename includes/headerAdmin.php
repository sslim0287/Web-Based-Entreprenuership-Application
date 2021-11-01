<?php
include("includes/connection.php");
include("functions/functions.php");

if(!isset($_SESSION['user_email'])){
	echo"You have to login first in order to see the content!";
	echo "<script>window.open('main.php', '_self')</script>";
}
?>
<nav class="navbar navbar-default">
	<div class="container-fluid" style="background-color: #b8c1e7;">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a style="color:#2D383D; font-size:20px; font-weight:bold;" class="navbar-brand" href="dashboard.php">Web-Based Entrepreneur Application</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	
	      	<?php 
			$user = $_SESSION['user_email'];
			$get_user = "select * from admin where admin_email='$user'"; 
			$run_user = mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);
					
			$admin_id = $row['id']; 
			$admin_name = $row['admin_name'];
			
			?>

	       	<li><a style="font-weight:bold; color: #fcfcf4; font-size:20px;"  href="dashboard.php">Dashboard</a></li>
			<li><a style="font-weight:bold; color: #fcfcf4; font-size:20px;"  href="manageData.php">Manage Jobs Data</a></li>
			<li><a style="font-weight:bold; color: #fcfcf4; font-size:20px;"  href="manageData2.php">Manage Businesses Data</a></li>
			<li><a style="font-weight:bold; color: #fcfcf4; font-size:20px;"  href='manageUser.php'>Manage User</a></li>
			<li><a style="font-weight:bold; color: #fcfcf4; font-size:20px;"  href="meetingAdmin.php" target="_blank">Meeting</a></li>
			<li><a style="font-weight:bold; color: #fcfcf4; font-size:20px;"  href='logout.php'>Logout</a></li>
					
			</ul>
			
		</div>
	</div>
</nav>