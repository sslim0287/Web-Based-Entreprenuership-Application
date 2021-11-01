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
    <title>Edit Post Comment</title>
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
            if(isset($_GET['post_id'])){
                if(isset($_GET['com_id'])){

                $get_post_id = $_GET['post_id'];
                $get_com_id = $_GET ['com_id'];
                

                $get_post = "SELECT *
                               from posts LEFT JOIN comments
                               ON posts.post_id = comments.post_id
                               WHERE posts.post_id='$get_post_id' AND comments.com_id='$get_com_id'";
                               
                $run_post_com = mysqli_query($con,$get_post);
                $row = mysqli_fetch_array($run_post_com);

                $post_com = $row['comment'];

                }
            }

        ?>
        <form action="" method="post" id="f">
            <center><h2  style="text-align: center; font-size:30px;color:cornflowerblue;background-color:cornsilk;
				width:600px;border: 3px solid #4c4741;border-radius:25px;height:60px;padding-top:10px;">Edit Your Post Comment: </h2></center><br>
            <textarea class="form-control" name="content" cols="1000" rows="30" style="resize:none;" required><?php echo $post_com; ?></textarea><br>
            <input type="submit" name="update" value="Update Post" class="btn btn-info"/>
        </form>

        <?php
        
        if(isset($_POST['update'])){
            $content = $_POST['content'];
        
            $update_post_com = "update comments set comment='$content' where post_id='$get_post_id' AND com_id='$get_com_id'";
            $run_update = mysqli_query($con,$update_post_com);
            
            if($run_update){
                echo "<script>alert('A Post Comment has been Updated!')</script>";
                echo "<script>window.open('single.php?post_id=$get_post_id', '_self')</script>";
            }
        }
        
        ?>
    </div>
    
</div>    
</body>
</html>