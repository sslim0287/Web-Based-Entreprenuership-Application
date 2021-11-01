<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>
<html>
<head>
    <title>Edit Post</title>
    <meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class="row">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
        <?php
            if(isset($_GET['thread_id'])){
                if(isset($_GET['board_id'])){
                $get_thread_id = $_GET['thread_id'];
                $get_board_id = $_GET['board_id'];

                $get_thread = "select * from threads where thread_id='$get_thread_id' AND board_id='$get_board_id'";
                $run_thread = mysqli_query($con,$get_thread);
                $row = mysqli_fetch_array($run_thread);

                $thread_con = $row['thread_content'];
                }
            }

        ?>
        <form action="" method="post" id="f">
            <center><h2  style="text-align: center; font-size:30px;color:cornflowerblue;background-color:cornsilk;
				width:600px;border: 3px solid #4c4741;border-radius:25px;height:60px;padding-top:10px;">Edit Your Thread Content: </h2></center><br>
            <textarea class="form-control" name="content" cols="1000" rows="30" style="resize: none;" required><?php echo $thread_con; ?></textarea><br>
            <input type="submit" name="update" value="Update Post" class="btn btn-info"/>
        </form>

        <?php
        
        if(isset($_POST['update'])){
            $content = $_POST['content'];
        
            $update_thread = "update threads set thread_content='$content' where thread_id='$get_thread_id' AND board_id='$get_board_id'";
            $run_update = mysqli_query($con,$update_thread);
            
            if($run_update){
                echo "<script>alert('A Thread has been Updated!')</script>";
                echo "<script>window.open('forum.php', '_self')</script>";
            }
        }
        
        ?>
    </div>
    
</div>    
</body>
</html>