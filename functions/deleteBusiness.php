<?php
$con = mysqli_connect("localhost","root","","network") or die("Connection was not established");

if(isset($_GET['business_id'])){
    $business_id = $_GET['business_id'];

    $delete_business = "DELETE from businesses where id='$business_id'";

    $run_delete = mysqli_query($con,$delete_business);

    if($run_delete){
        echo "<script>alert('A Business has been deleted!')</script>";
        echo "<script>window.open('../manageData2.php', '_self')</script>";
    }
}

?>