<?php
$con = mysqli_connect("localhost","root","","network") or die("Connection was not established");

if(isset($_GET['thread_id'])){
    if(isset($_GET['board_id'])){
    $thread_id = $_GET['thread_id'];
    $board_id = $_GET['board_id'];

    $delete_thread = "DELETE from threads where thread_id='$thread_id' AND board_id='$board_id'";

    $run_delete = mysqli_query($con,$delete_thread);

    if($run_delete){
        echo "<script>alert('A Thread has been deleted!')</script>";
        echo "<script>window.open('../forum.php', '_self')</script>";
    }
}
}

?>