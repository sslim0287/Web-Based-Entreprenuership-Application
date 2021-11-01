<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	echo"<script>alert('You have to login first in order to see the content!')</script>";
	echo "<script>window.open('main.php', '_self')</script>";
}
?>
<html>
<head>
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_name = $row['user_name'];
	?>
	<title><?php echo "$user_name"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<?php
$board_id = $_GET['board_id'];
$thread_id = $_GET['thread_id'];

$get_board = $con->query("SELECT * FROM boards WHERE board_id = $board_id");
$board_data = $get_board->fetch_assoc();

$get_thread = $con->query("SELECT * FROM threads WHERE thread_id = $thread_id");
$thread_data = $get_thread->fetch_assoc();

?>


			<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div id='posts' class='col-sm-6'>
						<div class='row'>
							<div class='col-sm-2'>
							</div>
							<div class='col-sm-8' style="margin-top: -30px; margin-left: -140px;">
								<h3 style='text-decoration:none; cursor:pointer;color: #3897f0;'>Title: <b><?php echo $thread_data['thread_title'] ?></b></h3>
								<?php
								$user = $_SESSION['user_email'];
								$get_user = "select * from users where user_email='$user'";
								$run_user = mysqli_query($con,$get_user);
								$row = mysqli_fetch_array($run_user);

								$userown_id = $row['user_id'];
								$own_username = $row['user_name'];
								$own_fname = $row['f_name'];
								$own_lname = $row['l_name'];

								$get_name = "SELECT threads.thread_id, threads.thread_title, threads.thread_content, threads.thread_author, threads.date,users.user_name,users.f_name,users.l_name
												FROM threads LEFT JOIN users
												ON threads.thread_author = users.user_name
												WHERE threads.thread_id = $thread_id";
								
								$run_name = mysqli_query($con,$get_name);
								while($row_name = mysqli_fetch_array($run_name)){
									$t_content = $row_name['thread_content'];
									$t_author = $row_name['thread_author'];
									$t_com_fname = $row_name['f_name'];
									$t_com_lname = $row_name['l_name'];
									$date = $row_name['date'];	
								
								if($t_author == $own_username){
									echo "<a style='margin-top:10px; ' href='editThread.php?thread_id=$thread_id&board_id=$board_id' class='btn btn-info'/>Edit Thread</a>";
									echo "<a style='margin-top:10px;margin-left:30px; ' href='functions/deleteThread.php?thread_id=$thread_id&board_id=$board_id' class='btn btn-danger'/>Delete Thread</a>";
									echo "<h4 style='margin-top:30px;'><small style='color:black;'>Created on <strong> $date  </strong> by <strong>$own_fname $own_lname</strong></small></h4>";
								}else{
									echo "<h4 style='margin-top:30px;'><small style='color:black;'>Created on <strong> $date  </strong> by <strong>$t_com_fname $t_com_lname </strong></small></h4>";

								}
							}
								?>   
							</div>
							<div class='col-sm-4'>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12' style="margin-left: 20px;">
							<h3><b>Thread:</b><br><br>
							<?php echo nl2br($thread_data['thread_content']) ?>
							</div></h3>
						</div><br>
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
<?php
				include("functions/thread_comment.php");

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
					echo "<script>window.open('view-content.php?thread_id=$thread_id&board_id=$board_id' , '_self')</script>";
				}else{
					$user= $_SESSION['user_email'];
					$get_user= "select * from users where user_email='$user'";
			
					$run_user = mysqli_query($con,$get_user);
					$row_user = mysqli_fetch_array($run_user);
			
					$user_id = $row_user['user_id'];
					$comment_user = $row_user['user_name'];

					$insert = "insert into thread_comments (thread_id,comment,comment_user,date) values ('$thread_id','$comment','$comment_user',NOW())";

					$run = mysqli_query($con,$insert);

					echo "<script>alert('Your comment added')</script>";
					echo "<script>window.open('view-content.php?thread_id=$thread_id&board_id=$board_id' , '_self')</script>";
				}
			}

?>
</body>
</html>