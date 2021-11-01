<!DOCTYPE html>
<?php
session_start();
include("includes/headerAdmin.php");

if(!isset($_SESSION['user_email'])){
	echo"<script>alert('You have to login first in order to see the content!')</script>";
	echo "<script>window.open('main.php', '_self')</script>";
}
?>
<html>
<head>
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users JOIN admin where user_email='$user' OR admin_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

	?>
	<title><?php echo "Dashboard"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/table.css">
</head>
<style>
      body{
        background-color: #ecccb4;

    }
    .title{
        text-align: center;
        border: 5px solid #9893ae;
        font-size: 40px;
        background-color: #fcf8f5;
        font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }
</style>
<body>
<div class="card-body" style="padding-left: 10px;padding-right: 10px;">
        
        <div class="title">
        <p>Manage User | Admin</p>
       
        </div>
        <br>
        <table class="table table-bordered text-center" style="background-color: #fff; font-size:20px;border:3px solid #1f4352;">

        <tr>
            <th>id</th>
            <th>Username</th>
            <th>Name</th>
            <th>Usertype</th>
            <th>Created</th>
            <th>Action</th>  
        </tr>
       <?php
        $get_user1 = "select * from users ";
        $run_user1 = mysqli_query($con,$get_user1);
        while($row_user = mysqli_fetch_array($run_user1)){
            $user_id = $row_user['user_id'];
            $f_name = $row_user['f_name'];
            $l_name = $row_user['l_name'];
            $job_field = $row_user['job_field'];
            $username = $row_user['user_name'];
            $user_image = $row_user['user_image'];
            $user_country = $row_user['user_country'];
            $usertype = $row_user['usertype'];
            $reg_date = $row_user['user_reg_date'];
    
            echo "
            <tr>
                <th>$user_id </th>
                <th>$username</th>
                <th>$f_name $l_name</th>
                <th>$usertype</th>
                <th>$reg_date</th>
                <th>
                   
                    <a href='functions/deleteUser.php?user_id=$user_id' style=''><button class='btn btn-danger'>Delete</button></a>
                </th>
            </tr>
            ";
            include("functions/deleteUser.php");
    
        }
       ?>
        

    </table>
    </div>
</body>
</html>