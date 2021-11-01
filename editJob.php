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
        overflow-y: hidden;
    }
</style>
<body>
<?php
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection, 'network');

    $id = $_POST['id'];

    $query = "SELECT * FROM jobs WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        while($row = mysqli_fetch_array($query_run))
        {
            ?>
            <div class="container">
                <div class="jumbotron"  style="margin-top: -150px;border: 5px solid #1f4352;background-color: mintcream;">
                    <div class="row">
                        <div class="col-md-12" >
                            
                        <h2 style="width:500px;height:100px;">Update Jobs Data</h2>
                            <hr>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <div class="form-group" style="font-size: 20px;">
                                    <label for=""> Job Name </label>
                                    <input type="text" style="font-size: 20px;" name="job_name" class="form-control" value="<?php echo $row['name'] ?>" placeholder="Enter Job Name" required>
                                </div>
                                <div class="form-group" style="font-size: 20px;">
                                    <label for=""> Minimum Salary </label>
                                    <input type="text" style="font-size: 20px;" name="min_salary" class="form-control" value="<?php echo $row['min_salary'] ?>" placeholder="Enter Minimum Salary" required>
                                </div>
                                <div class="form-group" style="font-size: 20px;">
                                    <label for=""> Maximum Salary </label>
                                    <input type="text" style="font-size: 20px;" name="max_salary" class="form-control" value="<?php echo $row['max_salary'] ?>" placeholder="Enter Maximum Salary" required>
                                </div>

                                <button type="submit" name="update" class="btn btn-primary"> Update Data </button>

                                <a href="manageData.php" class="btn btn-danger"> BACK </a>
                            </form>

                        </div>
                    </div>
                    
                    <?php
                    if(isset($_POST['update']))
                    {
                        $job_name = $_POST['job_name'];
                        $min_salary = $_POST['min_salary'];
                        $max_salary = $_POST['max_salary'];

                        $query = "UPDATE jobs SET name='$job_name', min_salary='$min_salary', max_salary=' $max_salary' WHERE id='$id'  ";
                        $query_run = mysqli_query($connection, $query);

                        if($query_run)
                        {
                            echo '<script> alert("Data Updated"); </script>';
                            echo "<script>window.open('manageData.php', '_self')</script>";
                        }
                        else
                        {
                            echo '<script> alert("Data Not Updated"); </script>';
                        }
                    }
                    ?>

                </div>
            </div>
            <?php
        }
    }
    else
    {
        // echo '<script> alert("No Record Found"); </script>';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>No Record Found</h4>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</body>
</html>