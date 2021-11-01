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
	<title>Edit Account Settings</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class="row">
	<div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table table-bordered table-hover" 
            style="margin-top:50px;background-color:honeydew; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; 
                   font-size:20px; border: 3px solid #D2D2D2;">
                <tr align="center">
                    <td colspan="6" class="active" style="word-spacing: 5px;"><h2>Edit Your Profile</h2></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Change Your First Name</td>
                    <td>
                        <input style="font-size:20px;" class="form-control" type="text" name="f_name" required value="<?php echo $first_name; ?>">

                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Change Your Last Name</td>
                    <td>
                        <input style="font-size:20px;" class="form-control" type="text" name="l_name" required value="<?php echo $last_name; ?>">

                    </td>
                </tr>
                
                <tr>
                    <td style="font-weight: bold;">Description</td>
                    <td>
                        <input style="font-size:20px;" class="form-control" type="text" name="describe_user" required value="<?php echo $describe_user; ?>">

                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Job Field</td>
                    <td>
                        <select style="font-size:15px;" class="form-control" name="job_field">
                            <option><?php echo $job_field;?></option>
                            <option>Architecture and engineering</option>
                            <option>Arts, culture and entertainment</option>
                            <option>Business, management and administration</option>
                            <option>Communications</option>
                            <option>Community and social services</option>
                            <option>Education</option>
                            <option>Science and technology</option>
                            <option>Installation, repair and maintenance</option>
                            <option>Farming, fishing and forestry</option>
                            <option>Health and medicine</option>
                            <option>Law and public policy</option>
                            <option>Sales</option>
                            <option>Others</option>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Enter New Password</td>
                    <td>
                        <input style="font-size:20px;" class="form-control" type="password" name="u_pass" id="mypass"  value="">
                        <input type="checkbox" onclick="show_password()"><strong>Show Password</strong>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Email</td>
                    <td>
                        <input style="font-size:20px;" class="form-control" type="email" name="u_email" required value="<?php echo $user_email; ?>">

                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">State of Malaysia</td>
                    <td>
                        <select style="font-size:15px;" class="form-control" name="state">
                            <option><?php echo $user_country;?></option>
                            <option>Kedah</option>
							<option>Kelantan</option>
							<option>Penang</option>
							<option>Pahang</option>
							<option>Perak</option>
							<option>Perlis</option>
							<option>Malacca</option>
							<option>Terengganu</option>
							<option>Negeri Sembilan</option>
							<option>Selangor</option>
							<option>Johor</option>
							<option>Sabah</option>
							<option>Sarawak</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Gender</td>
                    <td>
                        <select style="font-size:20px;" class="form-control" name="u_gender">
                            <option><?php echo $user_gender;?></option>
                            <option>Male</option>
							<option>Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Birthdate</td>
                    <td>
                        <input style="font-size:20px;" class="form-control input-md" type="date" name="u_birthday" required value="<?php echo $user_birthday; ?>">

                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Forgotten Password</td>
                    <td>
                        <button type="button" style="font-size:20px;" class="btn btn-default" data-toggle="modal" data-target="#myModal">Change</button>
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Forgotten Password</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="recovery.php?id=<?php echo $user_id;?>" method="post" id="f">
                                        <strong>Who is your Best Friend?</strong>
                                        <textarea class="form-control" name="content" placeholder="Someone" cols="80" rows="4" style="resize: none;" ></textarea><br>
                                        <input class="btn btn-default" type="submit" name="sub" value="Submit" style="width: 100px;"><br><br>
                                        <pre>Answer the above question in order to retrieve your account<br>when you forgot your password.</pre><br><br>
                                    </form>
                                    <?php
                                        if(isset($_POST['sub'])){
                                            $bfn = htmlentities($_POST['content']);

                                            if($bfn == ''){
                                                echo "<script>alert('Please enter something')</script>";
                                                echo "<script>window.open('edit_profile.php?u_id=$user_id' , '_self')</script>";
                                                exit();
                                            }else{
                                                $update = "update users set recovery_account = '$bfn' where user_id='$user_id'";

                                                $run = mysqli_query($con,$update);

                                                if($run){
                                                    echo "<script>alert('Working ... ')</script>";
                                                    echo "<script>window.open('edit_profile.php?u_id=$user_id' , '_self')</script>";            
                                                }else{
                                                    echo "<script>alert('Error while updating information')</script>";
                                                    echo "<script>window.open('edit_profile.php?u_id=$user_id' , '_self')</script>";
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
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="6">
                        <input class="btn btn-info" type="submit" name="update" style="width: 250px;font-size:20px;" value="Update">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="col-sm-2"></div>
</div>

<script>
    function show_password(){
        var x = document.getElementById("mypass");
        if(x.type === "password"){
            x.type = "text";
        }else{
            x.type = "password";
        }
    }
</script>
</body>
</html>
<?php
    if(isset($_POST['update'])){
        $f_name = htmlentities($_POST['f_name']);
        $l_name = htmlentities($_POST['l_name']);
        $describe_user = htmlentities($_POST['describe_user']);
        $job_field = htmlentities($_POST['job_field']);
        if($_POST['u_pass'] == ''){
            $u_pass = $user_pass;
        }else if($_POST['u_pass'] != ''){
            if(strlen($_POST['u_pass']) < 9){
            $u_pass = $user_pass;
			echo"<script>alert('Password should be minimum 9 characters!')</script>";
            echo "<script>window.open('edit_profile.php?u_id=$user_id' , '_self')</script>";            
            }else{
                $u_pass = htmlentities(MD5($_POST['u_pass']));
                }
		}
        $u_email = htmlentities($_POST['u_email']);
        $u_country = htmlentities($_POST['state']);
        $u_gender = htmlentities($_POST['u_gender']);
        $u_birthday = htmlentities($_POST['u_birthday']);


        $update = "update users set f_name='$f_name' , l_name='$l_name' ,  
        describe_user='$describe_user' , job_field='$job_field' , user_pass='$u_pass' , 
        user_email='$u_email' , user_country='$u_country' , user_gender='$u_gender' , 
        user_birthday='$u_birthday' where user_id='$user_id'";

        $run = mysqli_query($con,$update);

        if($run){
            echo "<script>alert('Your Profile Updated! Please login again to try your new changes.')</script>";
            echo "<script>window.open('main.php' , '_self')</script>";            
        }
    }
?>