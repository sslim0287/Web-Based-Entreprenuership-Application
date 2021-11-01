<?php
$con = mysqli_connect("localhost","root","","network") or die("Connection was not established");

if(isset($_GET['thread_id'])){
    if(isset($_GET['id'])){

    $thread_id = $_GET['thread_id'];
    $t_com_id = $_GET['id'];


    $delete_thread = "DELETE from thread_comments where thread_id='$thread_id' AND id='$t_com_id' ";

    $run_delete = mysqli_query($con,$delete_thread);

    if($run_delete){
        echo "<script>alert('A Thread comment has been deleted!')</script>";
        echo "<script>window.open('../forum.php', '_self')</script>";
    }
    }
}

?>