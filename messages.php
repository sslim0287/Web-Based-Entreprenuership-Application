<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
if(isset($_GET["userId"]))
{
    $_SESSION["userId"] = $_GET["userId"];
}
$users = mysqli_query($con,"SELECT * FROM users WHERE user_id = '".$_SESSION["userId"]."'") or die("Failed to query database");
$user = mysqli_fetch_assoc($users);
?>
<html>
<head>
	<title>Messages</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">

</head>
<style>
    #user{
        max-height: 400px;
        overflow: scroll;
        overflow-x: hidden;
        overflow-y: auto;

    }
</style>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4" style="background-color: white;margin-left:20px;margin-top:50px;border: 3px solid #92DFF3;">
                <!--<p>Hi <?php echo $user["f_name"]; ?> </p>-->
                <input type="text" id="fromUser" value=<?php echo $user["user_id"]; ?> hidden />
                <center><h2>Send Message to: </h2></center>
                
                <hr style="  
                border: 0;
                height: 1px;
                background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
                <ul>
                    <div id="user">
                    <?php
                        
                        $msgs = mysqli_query($con,"SELECT * FROM users") or die("Failed to query database");
                        while($msg = mysqli_fetch_assoc($msgs))
                        {
                            echo '<li style=" list-style-type: none; ">
                            <img class="img-circle" src = "users/'.$msg["user_image"].'" width="90px" height="80px" title="'.$msg["user_name"].'">&nbsp
                            <a style="font-size:20px;color:#d6a38e;" href="?toUser='.$msg["user_id"].'">'.$msg["f_name"].'&nbsp'.$msg["l_name"].'</a></li>
                            <hr style="
                            border: 0;
                            border-bottom: 1px dashed #ccc;
                            background: #999;
                            ">';
                        }
                    ?>
                    </div>
                </ul>
            </div>
            <div class="col-md-4">
                        <div class="modal-dialog" style="margin-left: 100px; width: 1000px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>
                                        <?php
                                            if(isset($_GET["toUser"]))
                                            {
                                                $userName = mysqli_query($con,"SELECT * FROM users WHERE user_id='".$_GET["toUser"]."'") or die("Failed to query database");
                                                $uName = mysqli_fetch_assoc($userName);
                                                echo '<input type="text" value='.$_GET["toUser"].' id="toUser" hidden/>';
                                                echo ''.$uName["f_name"].'&nbsp'.$uName["l_name"].'';
                                                
                                            }else
                                            {
                                                $userName = mysqli_query($con," SELECT * FROM users ") or die("Failed to query database");
                                                $uName = mysqli_fetch_assoc($userName);
                                                $_SESSION["toUser"] = $uName["user_id"];
                                                echo '<input type="text" value='.$_SESSION["toUser"].' id="toUser" hidden/>';
                                                echo ''.$uName["f_name"].'&nbsp'.$uName["l_name"].'';
                                            }

                                        ?>
                                    </h4>
                                </div>
                            <div class="modal-body" id="msgBody" style="height: 550px; overflow-y:scroll; overflow-x:hidden;background-color:#fcf8f9;">
                                <?php
                                    if(isset($_GET["toUser"])){
                                        $chats = mysqli_query($con,"SELECT * FROM messages WHERE (FromUser = '".$_SESSION["userId"]."' AND ToUser = '".$_GET["toUser"]."') OR (FromUser = '".$_GET["toUser"]."' AND ToUser = '".$_SESSION["userId"]."')") 
                                        or die("Failed to query database");
                                        $chat = mysqli_fetch_assoc($chats);

                                    }else{
                                        $chats = mysqli_query($con,"SELECT * FROM messages WHERE (FromUser = '".$_SESSION["userId"]."' AND ToUser = '".$_SESSION["toUser"]."') 
                                        OR (FromUser = '".$_SESSION["toUser"]."' AND ToUser = '".$_SESSION["userId"]."')  ") 
                                        or die("Failed to query database");
                                        while($chat = mysqli_fetch_assoc($chats))
                                        {
                                            if($chat["FromUser"] == $_SESSION["userId"]){
                                            echo "<div style='text-align:right;'>
                                            <h5 style='background-color:#c3c7c1; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max-width:70%;font-size:20px;font-family:Verdana;'>
                                            ".$chat["Message"]."
                                            </h5>
                                            </div>";
                                            }else{
                                            echo "
                                            
                                            <div style='text-align:left;'>
                                            <h5 style='background-color:#debcaa; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max-width:70%;font-size:20px;font-family:Verdana;'>
                                            ".$chat["Message"]."
                                            </h5>
                                            </div>";
                                            }
                                        }
                                    }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <textarea id="message" class="form-control" style="height: 70px; resize:none;" required></textarea>
                                <br>
                                <button id="send" class="btn btn-primary" style="height:50px;">Send</button>
                            </div>
                            </div>
                        </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $("#send").on("click",function(){
            $.ajax({
               url:"insertMessage.php",
               method:"POST",
               data:{
                   fromUser: $("#fromUser").val(),
                   toUser: $("#toUser").val(),
                   message: $("#message").val()
               },
               dataType:"text",
               success:function(data)
               {
                   $("#message").val("");
               }
            });
        });

        setInterval(function(){
            $.ajax({
               url:"realTimeChat.php",
               method:"POST",
               data:{
                   fromUser:$("#fromUser").val(),
                   toUser:$("#toUser").val()
               },
               dataType:"text",
               success:function(data) 
               {
                   $("#msgBody").html(data);
               }
            });
        }, 2000);
    });

   
</script>
</html>