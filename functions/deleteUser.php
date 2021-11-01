<?php
$con = mysqli_connect("localhost","root","","network") or die("Connection was not established");

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];

    $delete_user = "DELETE from users where user_id='$user_id'";

    $run_delete = mysqli_query($con,$delete_user);

    if($run_delete){
        echo "<script>alert('A User has been deleted!')</script>";
        echo "<script>window.open('../manageUser.php', '_self')</script>";
    }
}

?>