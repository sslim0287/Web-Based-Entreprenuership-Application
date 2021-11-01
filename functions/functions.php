<?php

$con = mysqli_connect("localhost","root","","network") or die("Connection was not established");

//function for inserting post

function insertPost(){
	if(isset($_POST['sub'])){
		global $con;
		global $user_id;

		$content = htmlentities($_POST['content']);
		$upload_image = $_FILES['upload_image']['name'];
		$image_tmp = $_FILES['upload_image']['tmp_name'];
		$random_number = rand(1, 100);

		if(strlen($content) > 1000){
			echo "<script>alert('Please Use 1000 or less than 1000 words!')</script>";
			echo "<script>window.open('home.php', '_self')</script>";
		}else{
			if(strlen($upload_image) >= 1 && strlen($content) >= 1){
				move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
				$insert = "insert into posts (user_id, post_content, upload_image, post_date) values('$user_id', '$content', '$upload_image.$random_number', NOW())";

				$run = mysqli_query($con, $insert);

				if($run){
					echo "<script>alert('Your Post updated a moment ago!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";

					$update = "update users set posts='yes' where user_id='$user_id'";
					$run_update = mysqli_query($con, $update);
				}

				exit();
			}else{
				if($upload_image=='' && $content == ''){
					echo "<script>alert('Error Occured while uploading!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";
				}else{
					if($content==''){
						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
						$insert = "insert into posts (user_id,post_content,upload_image,post_date) values ('$user_id','No','$upload_image.$random_number',NOW())";
						$run = mysqli_query($con, $insert);

						if($run){
							echo "<script>alert('Your Post updated a moment ago!')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}

						exit();
					}else{
						$insert = "insert into posts (user_id, post_content, post_date) values('$user_id', '$content', NOW())";
						$run = mysqli_query($con, $insert);

						if($run){
							echo "<script>alert('Your Post updated a moment ago!')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}
					}
				}
			}
		}
	}
}

function get_posts(){
	global $con;
	$per_page = 4;

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}

	$start_from = ($page-1) * $per_page;

	$user = $_SESSION['user_email'];
    $get_user = "select * from users where user_email='$user'";
    $run_user = mysqli_query($con,$get_user);
    $row = mysqli_fetch_array($run_user);

    $userown_id = $row['user_id'];

	$get_posts = "SELECT *
				FROM social_follow LEFT JOIN posts
				ON social_follow.followed_user_id = posts.user_id
				WHERE social_follow.follower_id = $userown_id ORDER by posts.post_date DESC LIMIT $start_from, $per_page
				";

	$run_posts = mysqli_query($con, $get_posts);

	while($row_posts = mysqli_fetch_array($run_posts)){

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = substr($row_posts['post_content'], 0,1000);
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id='$user_id' AND posts='yes'";
		$run_user = mysqli_query($con,$user);
		while($row_users = mysqli_fetch_array($run_user)){
		$user_name = $row_users['user_name'];
		$f_name = $row_users['f_name'];
		$l_name = $row_users['l_name'];
		$user_image = $row_users['user_image'];

		//now displaying posts from database

		if($content=="No" && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h2><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h2>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h2><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h2>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h3>";
						echo nl2br("$content");
						echo"
						</h3>
						
						<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else{
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h2><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h2>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h3>";
						echo nl2br("$content");
						echo"
						</h3>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
		}
	}
    include("pagination.php");
}

function single_post(){
	if(isset($_GET['post_id'])){
		global $con;

		$get_id = $_GET['post_id'];

		$get_posts = "select * from posts where post_id='$get_id'";

		$run_posts = mysqli_query($con,$get_posts);
		
		$row_posts = mysqli_fetch_array($run_posts);

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id='$user_id' AND posts='yes'";

		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$f_name = $row_user['f_name'];
		$l_name = $row_user['l_name'];
		$user_image = $row_user['user_image'];

		//user name who comment on the session
		$user_com = $_SESSION['user_email'];
		$get_com = "select * from users where user_email='$user_com'";

		$run_com = mysqli_query($con,$get_com);
		$row_com = mysqli_fetch_array($run_com);

		$user_com_id = $row_com['user_id'];
		$user_com_name = $row_com['user_name'];

		//get post id from url

		if(isset($_GET['post_id'])){
			$post_id = $_GET['post_id'];
		}

		$get_posts = "select * from users where post_id='$post_id'";
		$run_user = mysqli_query($con,$get_posts);

		$post_id = $_GET['post_id'];

		$post = $_GET['post_id'];
		$get_user = "select * from posts where post_id='$post'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);
		$p_id = $row['post_id'];

		// if post id is not equal to original post after click on the post
		if($p_id != $post_id){
			echo "<script>alert('ERROR')</script>";
			echo "<script>window.open('home.php' , '_self')</script>";

		}else{
			if($content=="No" && strlen($upload_image) >= 1){
				echo"
				<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div id='posts' class='col-sm-6'>
						<div class='row'>
							<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
							</div>
							<div class='col-sm-6'>
								<h2><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h2>
								<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
							</div>
							<div class='col-sm-4'>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
							<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
							</div>
						</div><br>
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
				";
			}
	
			else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
				echo"
				<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div id='posts' class='col-sm-6'>
						<div class='row'>
							<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
							</div>
							<div class='col-sm-6'>
								<h2><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h2>
								<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
							</div>
							<div class='col-sm-4'>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
							<h3>";
							echo nl2br("$content");
							echo"
							</h3>
							<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
							</div>
						</div><br>
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
				";
			}
	
			else{
				echo"
				<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div id='posts' class='col-sm-6'>
						<div class='row'>
							<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
							</div>
							<div class='col-sm-6'>
								<h2><a style='text-decoration:none; cursor:pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h2>
								<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
							</div>
							<div class='col-sm-4'>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
							<h3>";
							echo nl2br("$content");
							echo"
							</h3>
							</div>
						</div><br>
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
				";
			} // end of else condition

			include("comment.php");

			echo " 
			<div class='row'>
				<div class='col-md-6 col-md-offset-3'>
					<div class='panel panel-info' style='border:3px solid #345a5a;'>
						<div class='panel-body'>
							<form action='' method='post' class='form-inline'>
							<textarea style='border:3px solid #5b9e9e;' placeholder='Write your comment here!' class='pb-cmnt-textarea' name='comment' required></textarea>
							<button class='btn btn-info pull-right' name='reply'>Comment</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			";

			if(isset($_POST['reply'])){
				$comment = htmlentities($_POST['comment']);

				if($comment == ""){
					echo "<script>alert('Enter your comment')</script>";
					echo "<script>window.open('single.php?post_id=$post_id' , '_self')</script>";
				}else{
					$insert = "insert into comments (post_id,comment,comment_author,date) values ('$post_id','$comment','$user_com_name',NOW())";

					$run = mysqli_query($con,$insert);

					echo "<script>alert('Your comment added')</script>";
					echo "<script>window.open('single.php?post_id=$post_id' , '_self')</script>";
				}
			}
		}
	}
}

function results(){
	global $con;

	if(isset($_GET['search'])){
		$search_query = htmlentities($_GET['user_query']);
	}
	$get_posts = "select * from posts where post_content like '%$search_query%' OR upload_image like '%$search_query%'";

	$run_posts = mysqli_query($con,$get_posts);

	while($row_posts = mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id='$user_id' AND posts='yes'";

		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$first_name = $row_user['f_name'];
		$last_name = $row_user['l_name'];
		$user_image = $row_user['user_image'];

		//displaying posts

		if($content=="No" && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
						</div>
					</div><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h3>";
						echo nl2br("$content");
						echo"
						</h3>
						<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
						</div>
					</div><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else{
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h3>";
						echo nl2br("$content");
						echo"
						</h3>
						</div>
					</div><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
	}
}

function search_user(){
	global $con;

	$per_page = 2;

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}

	$start_from = ($page-1) * $per_page;

	if(isset($_GET['search_user_btn'])){
		$search_query = htmlentities($_GET['search_user']);
		if($search_query == ''){
			echo "<script>alert('Please Enter Something!')</script>";
			echo "<script>window.open('members.php', '_self')</script>";
		}else{
		$get_user = "select * from users where f_name like '%$search_query%' OR l_name like '%$search_query%' OR user_name like '%$search_query%' OR user_country like '%$search_query%' OR job_field like '%$search_query%' ";
		}
	}else{
		$get_user = "SELECT * from users LIMIT $start_from, $per_page";
		include("paginationMembers.php");
	}

	$run_user = mysqli_query($con,$get_user);
	while($row_user = mysqli_fetch_array($run_user)){
		$user_id = $row_user['user_id'];
		$f_name = $row_user['f_name'];
		$l_name = $row_user['l_name'];
		$job_field = $row_user['job_field'];
		$username = $row_user['user_name'];
		$user_image = $row_user['user_image'];
		$user_country = $row_user['user_country'];

		echo "
		<div class='row'>
			<div class='col-sm-3'>
			</div>
			<div class='col-sm-6'>
				<div class = 'row' id='find_people'>
					<div class='col-sm-4'>
						<a href='user_profile.php?u_id=$user_id'>
						<img src='users/$user_image' width ='150px' height='140px' title='$username' style='float:left; margin:1px;'/>
						</a>
					</div><br><br>
					<div class='col-sm-8' style='margin-top:-50px;'>
						<a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>
						<strong><h3 style='color:#44927e;'>$f_name $l_name </h3></strong>
						<strong><h3>$job_field</h3></strong>
						<strong><h3 style='color:#a25c0f;'>$user_country </h3></strong>
						</a>
					</div>
					<div class='col-sm-3'>
					</div>
				</div>
			</div>
			<div class='col-sm-4'>
			</div>
		</div><br>
		";

	}
	
}

function promote(){
	global $con;
	$per_page = 5;

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}

	$start_from = ($page-1) * $per_page;
	$get_posts = "SELECT * from posts where post_content like '%#Advertise%' OR upload_image like '%#Advertise%' ORDER by post_date DESC LIMIT $start_from, $per_page";

	$run_posts = mysqli_query($con,$get_posts);

	while($row_posts = mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id='$user_id' AND posts='yes'";

		$run_user = mysqli_query($con,$user);
		while($row_users = mysqli_fetch_array($run_user)){
			$user_name = $row_users['user_name'];
			$first_name = $row_users['f_name'];
			$last_name = $row_users['l_name'];
			$user_image = $row_users['user_image'];

		//now displaying posts from database

		if($content=="No" && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h2><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h2>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h2><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h2>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h3>";
						echo nl2br("$content");
						echo"
						</h3>
						
						<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else{
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h2><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h2>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h3>";
						echo nl2br("$content");
						echo"
						</h3>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
	}
	}
    include("paginationAds.php");
}

function own_post(){
	
			global $con;

			if (isset($_GET['u_id'])){
				$u_id = $_GET['u_id'];
			}

			$get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 5";

			$run_posts = mysqli_query($con,$get_posts);

			while($row_posts = mysqli_fetch_array($run_posts)){
				$post_id = $row_posts['post_id'];
				$user_id = $row_posts['user_id'];
				$content = $row_posts['post_content'];
				$upload_image = $row_posts['upload_image'];
				$post_date = $row_posts['post_date'];

				$user = "select * from users where user_id='$user_id' AND posts ='yes'";

				$run_user = mysqli_query($con,$user);
				while($row_users = mysqli_fetch_array($run_user)){
					$user_name = $row_users['user_name'];
					$first_name = $row_users['f_name'];
					$last_name = $row_users['l_name'];
					$user_image = $row_users['user_image'];

				// display the posts

				if($content == "No" && strlen($upload_image) >= 1){
					echo "
					
					<div id='own_posts'>
						<div class='row'>
							<div class ='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
							</div>
							<div class='col-sm-6'>
								<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h3>
								<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
							</div>
							<div class='col-sm-4'>
							</div>
						</div>
						<div class='row'>
						<div class='col-sm-12'>
						<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
						</div>
						</div><br>
						<a href='functions/delete_post.php?post_id=$post_id' style='margin-left:10px;float:right;'><button class='btn btn-danger'>Delete</button></a>
						<a href='edit_post.php?post_id=$post_id' style='margin-left:10px;float:right;'><button class='btn btn-info'>Edit</button></a>
						<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a><br>

					</div><br>
					";

				}
				
				else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
					echo "
					
					<div id='own_posts'>
						<div class='row'>
							<div class ='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
							</div>
							<div class='col-sm-6'>
								<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h3>
								<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
							</div>
							<div class='col-sm-4'>
							</div>
						</div>
						<div class='row'>
						<div class='col-sm-12'>
						<h3>";
						echo nl2br("$content");
						echo"
						</h3>
						<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
						</div>
						</div><br>
						<a href='functions/delete_post.php?post_id=$post_id' style='margin-left:10px;float:right;'><button class='btn btn-danger'>Delete</button></a>
						<a href='edit_post.php?post_id=$post_id' style='margin-left:10px;float:right;'><button class='btn btn-info'>Edit</button></a>
						<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a><br>

					</div><br><br>
					";

				}

				else {
					echo "
					
					<div id='own_posts'>
						<div class='row'>
							<div class ='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
							</div>
							<div class='col-sm-6'>
								<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h3>
								<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
							</div>
							<div class='col-sm-4'>
							</div>
						</div>
						<div class='row'>
						<div class='col-sm-2'>
						</div>
						<div class='col-sm-12'>
						<h3>";
						echo nl2br("$content");
						echo"
						</h3>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>

					";
					
					global $con;

					if (isset($_GET['u_id'])){
						$u_id = $_GET['u_id'];
					}
					
					$get_posts = "select user_email from users where user_id='$u_id' ";
					$run_user = mysqli_query($con,$get_posts);
					$row = mysqli_fetch_array($run_user);

					$user_email = $row['user_email'];

					$user = $_SESSION['user_email'];
					$get_user = "select * from users where user_email='$user'";
					$run_user = mysqli_query($con,$get_user);
					$row = mysqli_fetch_array($run_user);

					$user_id = $row['user_id'];
					$u_email = $row['user_email'];

					if($u_email != $user_email){
						echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";

					}else{
						echo"
						<a href='functions/delete_post.php?post_id=$post_id' style='margin-left:10px;float:right;'><button class='btn btn-danger'>Delete</button></a>
						<a href='edit_post.php?post_id=$post_id' style='margin-left:10px;float:right;'><button class='btn btn-info'>Edit</button></a>
						<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a><br>

						</div><br><br>
						";
					}

				}

				include("functions/delete_post.php");
			}
		}

			
}

function job(){
	global $con;
	$per_page = 5;

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}

	$start_from = ($page-1) * $per_page;
	
	$get_posts = "SELECT * from posts where post_content like '%#Job%' OR upload_image like '%#Job%' ORDER by post_date DESC LIMIT $start_from, $per_page";

	$run_posts = mysqli_query($con,$get_posts);

	while($row_posts = mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id='$user_id' AND posts='yes'";

		$run_user = mysqli_query($con,$user);
		while($row_users = mysqli_fetch_array($run_user)){
			$user_name = $row_users['user_name'];
			$first_name = $row_users['f_name'];
			$last_name = $row_users['l_name'];
			$user_image = $row_users['user_image'];

		//displaying posts


		if($content=="No" && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h2><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h2>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h2><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h2>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h3>";
						echo nl2br("$content");
						echo"
						</h3>
						
						<center><img id='posts-img' src='imagepost/$upload_image' style='margin-top:30px;max-width:300px; height:300px;'></center>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else{
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h2><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h2>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h3>";
						echo nl2br("$content");
						echo"
						</h3>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
	}
	}
	include("paginationJob.php");
}


?>