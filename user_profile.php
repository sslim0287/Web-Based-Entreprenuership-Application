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
	<title>User Profile</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style>
#own_posts{
        background-color: #fff;
        border: 3px solid #c36e13;
        border-radius: 25px;
        padding: 40px 50px;
        font-family: "Times New Roman", Times, serif;
        font-size: 25px;
        width: 90%;
}
#posts_img{
    height: 300px;
    width: 100%;
}

</style>
<body>
<div class="row">
    <?php
        if(isset($_GET['u_id'])){
            $u_id = $_GET['u_id'];
        }
        if($u_id < 0 || $u_id == ""){
            echo"<script>window.open('home.php','_self')</script>";
        }else{

        ?>

    <div class="col-sm-12">
        <?php
            if(isset($_GET['u_id'])){
                global $con;
                $user_id = $_GET['u_id'];

                $select = "select * from users where user_id='$user_id'";
                $run = mysqli_query($con,$select);
                $row = mysqli_fetch_array($run);

                $name = $row['user_name'];
            }
        ?>    

        <?php
            if(isset($_GET['u_id'])){
                global $con;
                $user_id = $_GET['u_id'];
                
                $select = "select * from users where user_id='$user_id'";
                $run = mysqli_query($con,$select);
                $row = mysqli_fetch_array($run);

                $id = $row['user_id'];
                $image = $row['user_image'];
                $name = $row['user_name'];
                $f_name = $row['f_name'];
                $l_name = $row['l_name'];
                $job_field = $row['job_field'];
                $describe_user = $row['describe_user'];
                $country = $row['user_country'];
                $gender = $row['user_gender'];
                $register_date = $row['user_reg_date'];
                $date = date("M d, Y", strtotime($register_date));

                echo "
                    <div class='row'>
                        <div class='col-sm-1'>
                        </div>
                        <center>
                        <div style='margin-left:-50px; margin-right:50px; border:3px solid #000; background-color: #fae4cc;font-size:20px;
                                    font-family:Arial;' class='col-sm-3'>    
                        <h2><b>Information About</b></h2>
                        <img class='img-circle' src='users/$image' width='150' height='150'>
                        <br><br>
                        <ul class='list-group'>
                            <li class='list-group-item' title='Username'><strong>$f_name $l_name</strong></li>
                            <li class='list-group-item' title='User Status'><strong style='color:grey;'>$describe_user</strong></li>
                            <li class='list-group-item' title='Job Field'><strong>$job_field</strong></li>
                            <li class='list-group-item' title='Gender'><strong>$gender</strong></li>
                            <li class='list-group-item' title='Country'><strong>$country</strong></li>
                            <li class='list-group-item' title='User Registration Date'><strong> $register_date</strong></li>
                        </ul>
                        
                ";

                $user = $_SESSION['user_email'];
                $get_user = "select * from users where user_email='$user'";
                $run_user = mysqli_query($con,$get_user);
                $row = mysqli_fetch_array($run_user);

                $userown_id = $row['user_id'];
                if($user_id == $userown_id){
                    echo "<a href='edit_profile.php?u_id=$userown_id' class='btn btn-info'/>Edit Profile</a><br><br>";
                    echo "<a href='profile.php?u_id=$userown_id' class='btn btn-success'/>Own Profile</a><br><br>";

                }else{
                    $sql = "SELECT * FROM social_follow WHERE follower_id = '$userown_id' AND followed_user_id = '$user_id'";
                    $result = mysqli_query($con,$sql);
                    $count = mysqli_num_rows($result);
                    if($count >0){
                        echo "<form action='' method='post'>
                        <button class='btn btn-success' name='unfollow'>Unfollow</button> </form> <br>
                        <button class='btn btn-info' name='chat'><a href='messages.php?toUser=$user_id&userId=$userown_id' style='color:white;'>Chat</a></button><br><br>";

                        if(isset($_POST['unfollow'])){
                            $delete = "DELETE FROM social_follow WHERE follower_id = '$userown_id' AND followed_user_id = '$user_id'";
                            $run = mysqli_query($con,$delete);

                            echo "<script>alert('You have successfully unfollow this user')</script>";
                            echo "<script>window.open('home.php' , '_self')</script>";
                            }
                    }else{
                        echo "
                        <form action='' method='post'>
                        <button class='btn btn-success' name='follow'>Follow</button> </form><br>
                        <button class='btn btn-info' name='chat'><a href='messages.php?toUser=$user_id&userId=$userown_id'>Chat</a></button><br><br>";
                        


                        if(isset($_POST['follow'])){
                            $insert = "insert into social_follow (follower_id,followed_user_id) values ('$userown_id','$user_id')";
                            $run = mysqli_query($con,$insert);

                            echo "<script>alert('You have successfully follow this user')</script>";
                            echo "<script>window.open('home.php' , '_self')</script>";
                            }       
                    }
                                 
                }
                echo"
                    </div>
                    </center>
                ";
            }
        ?>

			
    <div class="col-sm-8">
            <center><h1><strong><?php echo "$f_name $l_name ";?></strong> Posts</h1></center>
            <?php

                global $con;
                if(isset($_GET['u_id'])){
                    $u_id = $_GET['u_id'];
                }

                $get_posts = "select * from posts where user_id = '$u_id' ORDER BY 1 DESC LIMIT 5";
                $run_posts = mysqli_query($con,$get_posts);
                
                while($row_posts = mysqli_fetch_array($run_posts)){
                    $post_id = $row_posts['post_id'];
                    $user_id = $row_posts['user_id'];
                    $content = $row_posts['post_content'];
                    $upload_image = $row_posts['upload_image'];
                    $post_date = $row_posts['post_date'];

                    $user = "select * from users where user_id='$user_id' AND posts='yes'";
                    $run_user = mysqli_query($con, $user);
                    $row_user = mysqli_fetch_array($run_user);

                    $user_name = $row_user['user_name'];
                    $f_name = $row_user['f_name'];
                    $l_name = $row_user['l_name'];
                    $user_image = $row_user['user_image'];

                    if($content=="No" && strlen($upload_image) >= 1){
                        echo "
                            <div id='own_posts'>
                                <div class='row'>
                                    <div class='col-sm-2'>
                                        <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
                                    </div>
                                        <div class='col-sm-6'>
                                            <h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h3>
                                            <h4><small style='color: black;'>Updated a post on <strong>$post_date</strong></small></h4>
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

                            </div><br><br>
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
                                    <h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h3>
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
                                    <h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h3>
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
                        </div><br><br>
    
                        ";
                    }
                }
                
            ?>
            </div>
    </div>
</div>
<?php } ?>
</body>
</html>