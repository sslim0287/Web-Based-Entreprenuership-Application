<?php
$con = mysqli_connect("localhost","root","","network") or die("Connection was not established");

if(isset($_GET['job_id'])){
    $job_id = $_GET['job_id'];

    $delete_job = "DELETE from jobs where id='$job_id'";

    $run_delete = mysqli_query($con,$delete_job);

    if($run_delete){
        echo "<script>alert('A Job has been deleted!')</script>";
        echo "<script>window.open('../manageData.php', '_self')</script>";
    }
}

?>