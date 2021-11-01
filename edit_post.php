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
<style>
    #update_image{
        border:2px solid #19596c;
        border-radius: 5px;
        background-color: burlywood;
        color:linen;
    }
</style>
<body>
<div class="row">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
        <?php
            if(isset($_GET['post_id'])){
                $get_id = $_GET['post_id'];

                $get_post = "select * from posts where post_id='$get_id'";
                $run_post = mysqli_query($con,$get_post);
                $row = mysqli_fetch_array($run_post);

                $post_con = $row['post_content'];
            }

        ?>
        <form action="" method="post" id="f" enctype='multipart/form-data'>
            <center><h2  style="text-align: center; font-size:30px;color:cornflowerblue;background-color:cornsilk;
				width:300px;border: 3px solid #4c4741;border-radius:25px;height:60px;padding-top:10px;">Edit Your Post: </h2></center><br>
            <textarea class="form-control" name="content" cols="1000" rows="30" style="resize: none;" required><?php echo $post_con; ?></textarea><br>
            <label id='update_image'> Select Image
				<input type='file' name='u_image' size='60' />
				</label><br><br>
            <input type="submit" name="update" value="Update Post" class="btn btn-info"/>
        </form>
        
             




        <?php
        
        if(isset($_POST['update'])){
            
            $content = $_POST['content'];

            $u_image = $_FILES['u_image']['name'];
            $image_tmp = $_FILES['u_image']['tmp_name'];
            $random_number = rand(1,100);
           
            if($u_image==''){
                $update_post = "update posts set post_content='$content',upload_image='' where post_id='$get_id'";
                $run_update = mysqli_query($con,$update_post);
               
            }else{
            move_uploaded_file($image_tmp, "imagepost/$u_image.$random_number");
            $update_post = "update posts set post_content='$content',upload_image='$u_image.$random_number' where post_id='$get_id'";
            $run_update = mysqli_query($con,$update_post);
            }
            if($run_update){
                echo "<script>alert('A Post has been Updated!')</script>";
                echo "<script>window.open('home.php', '_self')</script>";
            }
            
        }
        
        ?>
    </div>
    
</div>    
</body>
</html>