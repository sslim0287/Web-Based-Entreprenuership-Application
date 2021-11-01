<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://meet.jit.si/external_api.js"></script>
    <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">

    <script>
        $(document).ready(function(){
            var domain = "meet.jit.si";
            var maths = Math.random();
            var options = {
                roomName: "Room " + maths,
               
                parentNode: document.querySelector('#meet')
            }
            var api = new JitsiMeetExternalAPI(domain,options);
        });
    </script>

</head>
<style>
    #meet{
        margin-top: -20px;
        height:950px;
    }
</style>
<body>
    
    <div id="meet">
        
    </div>
</body>
</html>