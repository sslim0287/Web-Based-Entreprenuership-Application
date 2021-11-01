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
        <p>Manage Trending Data | Admin</p>
        <hr  style="border: 1px solid #58587d;">
        <p style="font-size: 30px;">Manage Jobs Data </p>
    </div>
    <br>

        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Add New Job</button> <br><br>
        <table class="table table-bordered text-center" style="background-color: #fff; font-size:20px;border:3px solid #1f4352;">
        <tr>
            <th>id</th>
            <th>Jobs</th>
            <th>Min Salary (RM)</th>
            <th>Max Salary (RM)</th>
            <th style="width: 250px;">Action</th>  
        </tr>
       <?php
        $get_job= "select * from jobs ";
        $run_job = mysqli_query($con,$get_job);
        while($row_job = mysqli_fetch_array($run_job)){
            $job_id = $row_job['id'];
            $job_name = $row_job['name'];
            $min_salary = $row_job['min_salary'];
            $max_salary = $row_job['max_salary'];

            echo "
            <tr>
                <th>$job_id </th>
                <th>$job_name</th>
                <th>$min_salary</th>
                <th>$max_salary</th>
                <th>
                    <form action='editJob.php' method='post'>
                    <input type='hidden' name='id' value='$job_id'>
                    <input type='submit' class='btn btn-info' name='edit' value='Edit'/>
                    </form>
                    <a href='functions/deleteJob.php?job_id=$job_id' style='float:right; margin-top:-35px;margin-left:-200px;margin-right:100px; '><button class='btn btn-danger'>Delete</button></a>
                    </th>
            </tr>
            ";
            include("functions/deleteJob.php");

        }
?>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal For Adding Jobs </h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="f">
                                <strong style="margin-right: 65px;">Job Name:</strong>
                                <input type="text" name="title" required/><br> <br> 
                                <strong>Add Minimum Salary: </strong>
                                <input type="number" name="min_salary" required/><br> <br> 
                                <strong>Add Maximum Salary: </strong>
                                <input type="number" name="max_salary" required/><br> <br> 
                                <input class="btn btn-default" type="submit" name="jobData" value="Submit" style="width: 100px;" ><br><br>
                            </form>
                            <?php
                                if(isset($_POST['jobData'])){
                                    $bfn = htmlentities($_POST['title']);

                                    $job_name = $_POST['title'];
                                    $min_salary = $_POST['min_salary'];
                                    $max_salary = $_POST['max_salary'];

                                    $user= $_SESSION['user_email'];
                                    $get_admin= "select * from admin where admin_email='$user'";
                            
                                    $run_admin = mysqli_query($con,$get_admin);
                                    $row_admin = mysqli_fetch_array($run_admin);
                            
                                    $admin_id = $row_admin['id'];

                                    if($bfn == ''){
                                        echo "<script>alert('Please enter something')</script>";
                                        echo "<script>window.open('manageData.php' , '_self')</script>";
                                        exit();
                                    }else{
                                        $add = "INSERT INTO jobs (name, min_salary, max_salary,admin_id) VALUES ('$job_name', '$min_salary', '$max_salary','$admin_id')";

                                        $run = mysqli_query($con,$add);

                                        if($run){
                                            echo "<script>alert('Working, Job is added ... ')</script>";
                                            echo "<script>window.open('manageData.php' , '_self')</script>";            
                                        }else{
                                            echo "<script>alert('Error while adding jobs information')</script>";
                                            echo "<script>window.open('manageData.php' , '_self')</script>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            

    </table>
    </div>

</body>
</html>