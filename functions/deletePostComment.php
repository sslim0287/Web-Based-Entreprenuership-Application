<?php
$con = mysqli_connect("localhost","root","","network") or die("Connection was not established");

if(isset($_GET['post_id'])){
    if(isset($_GET['com_id'])){

    $post_id = $_GET['post_id'];
    $com_id = $_GET['com_id'];

    $delete_post_comment = "DELETE from comments where post_id='$post_id' AND com_id='$com_id' ";

    $run_delete = mysqli_query($con,$delete_post_comment);

    if($run_delete){
        echo "<script>alert('A Post comment has been deleted!')</script>";
        echo "<script>window.open('../single.php?post_id=$post_id', '_self')</script>";
    }
    }
}

?>