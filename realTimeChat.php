<?php
session_start();
include("includes/connection.php");

$fromUser = $_POST["fromUser"];
$toUser = $_POST["toUser"];
$output = "";

$chats = mysqli_query($con,"SELECT * FROM messages WHERE (FromUser = '".$fromUser."' AND ToUser = '".$toUser."') OR (FromUser = '".$toUser."' AND ToUser = '".$fromUser."')") or die("Failed to query database");
while($chat = mysqli_fetch_assoc($chats))
{
    if($chat["FromUser"] == $fromUser){
        $output .= "<div style='text-align:right;'>
    <h5 style='background-color:#c3c7c1; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max-width:70%;font-size:20px;font-family:Verdana;'>
        ".$chat["Message"]."
    </h5>
    </div>";
    }else{
        $output.= "<div style='text-align:left;'>
    <h5 style='background-color:#debcaa; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max-width:70%;font-size:20px;font-family:Verdana;'>
        ".$chat["Message"]."
    </h5>
    </div>";
    }
}
echo $output;

?>

