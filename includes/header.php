<?php
include("includes/connection.php");
include("functions/functions.php");

if(!isset($_SESSION['user_email'])){
	echo"You have to login first in order to see the content!";
	echo "<script>window.open('main.php', '_self')</script>";
}
?>
<nav class="navbar navbar-default">
	<div class="container-fluid" style="background-color: #6A5448; ">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a style="color:#DBF3FA; font-size:20px;" class="navbar-brand" href="home.php">Web-Based Entrepreneur Application</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	
	      	<?php 
			$user = $_SESSION['user_email'];
			$get_user = "select * from users where user_email='$user'"; 
			$run_user = mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);
					
			$user_id = $row['user_id']; 
			$user_name = $row['user_name'];
			$first_name = $row['f_name'];
			$last_name = $row['l_name'];
			$describe_user = $row['describe_user'];
			$job_field = $row['job_field'];
			$user_pass = $row['user_pass'];
			$user_email = $row['user_email'];
			$user_country = $row['user_country'];
			$user_gender = $row['user_gender'];
			$user_birthday = $row['user_birthday'];
			$user_image = $row['user_image'];
			$user_cover = $row['user_cover'];
			$recovery_account = $row['recovery_account'];
			$register_date = $row['user_reg_date'];
			$usertype = $row['usertype'];
					
					
			$user_posts = "select * from posts where user_id='$user_id'"; 
			$run_posts = mysqli_query($con,$user_posts); 
			$posts = mysqli_num_rows($run_posts);
			?>

	        <li><a style="color: #FFF; font-size:18px;" href='profile.php?<?php echo "u_id=$user_id" ?>'><?php echo "$first_name"; ?></a></li>
	       	<li><a style="color: #FFF; font-size:18px;" href="home.php">Home</a></li>
			<li><a style="color: #FFF; font-size:18px;" href="members.php">Find People</a></li>
			<li><a style="color: #FFF; font-size:18px;" href="forum.php">Forum</a></li>
			<?php 
			
			$users = mysqli_query($con,"SELECT * FROM users WHERE user_id  = $user_id") or die("Failed to query database" );
			if( mysqli_num_rows($users) > 0 ){
				$row = mysqli_fetch_assoc($users);
				$userId = $row["user_id"]; 
				echo '			
					<li><a style="color: #FFF; font-size:18px;" href="messages.php?userId='.$userId.'">Messages</a></li>				
				';
			}
			
			?>
			<li><a style="color: #FFF; font-size:18px;" href="news.php">News</a></li>
			<li><a style="color: #FFF; font-size:18px;" href="trend.php">Trending Business</a></li>
			<li><a style="color: #FFF; font-size:18px;" href="meeting.php" target="_blank">Meeting</a></li>
			
					<?php
						echo"

						<li class='dropdown'>
							<a style='color:#D3D3D3;' href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span><i class='glyphicon glyphicon-chevron-down'></i></span></a>
							<ul class='dropdown-menu'>
								<li>
									<a href='edit_profile.php?u_id=$user_id'>Edit Account</a>
								</li>
									<li>
										<a href='advertise.php'>Advertise Area</a>
									</li>
									<li>
										<a href='job.php'>Job Area</a>
									</li>
								<li role='separator' class='divider'></li>
								<li>
									<a href='logout.php'>Logout</a>
								</li>
							</ul>
						</li>
						";
					?>
			</ul>
			
		</div>
	</div>
</nav>