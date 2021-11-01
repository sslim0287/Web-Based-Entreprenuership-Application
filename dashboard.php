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
    overflow-x: hidden;
    background-color: #ecccb4;
  }

  #chart-container {
    width: 2550px;
    margin-top: 100px;
  }
      .rectangle1{
        float:left;
        background-color: #f4fcf4; 
        border: 30px solid;
        border-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 11 11' width='11' height='11'><g fill='%23489fe2'><rect width='1' height='5'/><rect y='6' width='1' height='5'/><rect x='10' y='6' width='1' height='5'/><rect x='10' width='1' height='5'/><rect width='5' height='1'/><rect y='10' width='5' height='1'/><rect x='6' y='10' width='5' height='1'/><rect x='6' width='5' height='1'/></g></svg>") 5;
        margin-left: 20px;
        width:30%;
        height:200px;
      }

      .rectangle2{
        float:left; 
        background-color: #fcfaf6; 
        border: 30px solid;
        border-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 11 11' width='11' height='11'><g fill='%23489fe2'><rect width='1' height='5'/><rect y='6' width='1' height='5'/><rect x='10' y='6' width='1' height='5'/><rect x='10' width='1' height='5'/><rect width='5' height='1'/><rect y='10' width='5' height='1'/><rect x='6' y='10' width='5' height='1'/><rect x='6' width='5' height='1'/></g></svg>") 5;
        margin-left: 50px;
        width:30%;
        height:200px;
      }

      .rectangle3{
        float:right;
        background-color: #f4f5f4; 
        border: 30px solid;
        border-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 11 11' width='11' height='11'><g fill='%23489fe2'><rect width='1' height='5'/><rect y='6' width='1' height='5'/><rect x='10' y='6' width='1' height='5'/><rect x='10' width='1' height='5'/><rect width='5' height='1'/><rect y='10' width='5' height='1'/><rect x='6' y='10' width='5' height='1'/><rect x='6' width='5' height='1'/></g></svg>") 5;
        margin-right: 20px;
        width:30%;
        height:200px;
      }

      .column1 {
        float: left;
        width: 33.33%;
        padding: 5px;
      }



</style>
<body>
<?php
$db_conx = mysqli_connect("localhost","root","","network");
if(!$db_conx){ die(mysqli_connect_error());}

$list = "";
$list2 = "";
$list3 = "";
$sql = "
        SELECT user_id, COUNT(*) as count
        FROM users
       ";

$query = mysqli_query($db_conx, $sql) or die(mysqli_error($db_conx));
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
    $list .=" <br>" .$row["count"]. "<br>"; 
}

$sql2 = "
      SELECT post_id, COUNT(*) as count
      FROM posts
       ";

$query2 = mysqli_query($db_conx, $sql2) or die(mysqli_error($db_conx));
while($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)){
    $list2 .=" <br>" .$row["count"]. "<br>"; 
}

$sql3 = "
        SELECT thread_title, COUNT(*) as count
        FROM threads
       ";

$query3 = mysqli_query($db_conx, $sql3) or die(mysqli_error($db_conx));
while($row = mysqli_fetch_array($query3, MYSQLI_ASSOC)){
    $list3 .=" <br>" .$row["count"]. "<br>"; 
}

mysqli_close($db_conx);

?>
        <h1 style="margin-left:34%; text-align: center;
                  border:3px solid #b97c59;width:600px;
                  height:80px; padding-top:15px; background-color:#f9f9f9;
                  font-family:Verdana, Geneva, Tahoma, sans-serif;">Admin Dashboard Panel</h1>
        <br><br>
             <div>
                  <div class="rectangle1">
                     <h1> Total Users: <center><b> <?php echo $list;?></b></center></h1>
                  </div>       

                  <div class="rectangle2">
                     <h1>Total Posts: <center><b><?php echo $list2;?></b> </center> </h1> 
                  </div>

                  <div class="rectangle3">
                      <h1>Total Forum Threads:  <center><b> <?php echo $list3;?></b> </center> </h1> 
                  </div>
              </div>
             

<div class="card-body" style="padding-left: 10px;padding-right: 10px;">
    <table class="table table-bordered text-center">
        <br>
        
        

    </table>
    </div>
    <div id="chart-container">
      <div class="column1" style="background-color: moccasin;margin-left:20px; margin-right:100px;border:3px solid #000; border-radius:20px;">
      <h1 style="margin-left: 20px;text-align:center;padding-top:10px;"> Gender Statistics</h1>
      <hr style="border: 1px dashed #3f56ba;"><br>
      <canvas id="canvasGender"></canvas>
      </div>
      <div class="column1"  style="background-color: moccasin;margin-left:20px; margin-right:100px;border:3px solid #000; border-radius:20px;">
      <h1 style="margin-left: 20px;text-align:center;padding-top:10px;height:50px;"> Country Statistics</h1>
      <hr style="border: 1px dashed #3f56ba;"><br>
      <canvas id="canvasCountry"></canvas>
      </div>
    </div>
    
    <div id="chart-container">
      <div class="column1" style="background-color: moccasin;margin-left:20px; margin-right:100px;border:3px solid #000; border-radius:20px;margin-top:30px;margin-bottom:30px;">
      <h1 style="margin-left: 20px;text-align:center;padding-top:10px;"> Job Statistics</h1>
      <hr style="border: 1px dashed #3f56ba;"><br>
      <canvas id="canvasJob"></canvas>
      </div>
      <div class="column1" style="background-color: moccasin;margin-left:20px; margin-right:100px;border:3px solid #000; border-radius:20px;margin-top:30px;margin-bottom:30px;">
      <h1 style="margin-left: 20px;text-align:center;padding-top:10px;"> User Register Date Statistics</h1>
      <hr style="border: 1px dashed #3f56ba;"><br>
      <canvas id="canvasRegDate"></canvas>
      </div>
    </div>
         
    
      
    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="js/app1.js"></script>
    <script type="text/javascript" src="js/app2.js"></script>
    <script type="text/javascript" src="js/app3.js"></script>
    <script type="text/javascript" src="js/app4.js"></script>


</body>
</html>