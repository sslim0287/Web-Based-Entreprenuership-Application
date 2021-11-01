<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	echo"<script>alert('You have to login first in order to see the content!')</script>";
	echo "<script>window.open('main.php', '_self')</script>";
}
?>
<html>
<head>
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_name = $row['user_name'];
	?>
	<title><?php echo "$user_name"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style>
    #thread{
         background-color: lightcyan;
        max-height: 600px;
        overflow: scroll;
        overflow-x: hidden;
        overflow-y: auto;
        width: 750px;
        border: 3px solid #92DFF3;

    }
    #title{
        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-size: 35px;
        background-color: lightyellow;
        border: 3px solid lightslategrey;
        text-align: center;
        width: 750px;
    }
</style>
<body>
    <div id="viewTopic" style="margin-left: 30%; font-size:30px;">
			
		<?php
		$board_id = $_GET['board_id'];
        $get_board = $con->query("SELECT * FROM boards WHERE board_id = $board_id");
        $board_data = $get_board->fetch_assoc();      
		
        $threads = $con->query("SELECT * FROM threads WHERE board_id = $board_id");
       echo ' <div id="title"> '.$board_data['board_name'].' threads</div>  <br>';
       echo '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Add New Forum Board</button> <br> <br>';
       echo '<div id="thread"> ';

        while ($thread_data = $threads->fetch_assoc()) { ?>

        <table style="margin-left: 30px;">

        <tr>
            <th><li>
        <a href="view-content.php?thread_id=<?php echo $thread_data['thread_id'] ?>&board_id=<?php echo $board_id ?>">
        <?php echo $thread_data['thread_title'] ?></a> </li></th>
        </tr>
        </table>
        
        <?php }
        if ($threads->num_rows == null) {?>
        <?php echo "<center>No threads posted yet</center>";
        }
        ?>
    </div>
	</div>
		<div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal For Adding Forum Thread</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="f">
                            <strong>Title:</strong> <br>
                            <input type="text" name="title" required/><br>  
                            <strong>Add New Forum Board</strong>
                            <textarea class="form-control" name="content" placeholder="Add content" cols="80" rows="4" style="resize: none;" required></textarea><br>
                            <input class="btn btn-default" type="submit" name="subContent" value="Submit" style="width: 100px;"><br><br>
                        </form>
                        <?php
                            if(isset($_POST['subContent'])){
                                $bfn = htmlentities($_POST['content']);

                                $board_id = $_GET['board_id'];
                                $title = $_POST['title'];
                                $content = $_POST['content'];

                                $user= $_SESSION['user_email'];
                                $get_user= "select * from users where user_email='$user'";
                        
                                $run_user = mysqli_query($con,$get_user);
                                $row_user = mysqli_fetch_array($run_user);
                        
                                $user_id = $row_user['user_id'];
                                $thread_author = $row_user['user_name'];

                                if($bfn == ''){
                                    echo "<script>alert('Please enter something')</script>";
                                    echo "<script>window.open('forum.php' , '_self')</script>";
                                    exit();
                                }else{
                                    $add = "INSERT INTO threads (board_id, thread_title, thread_content,thread_author,date) VALUES ('$board_id', '$title', '$content','$thread_author',NOW())";

                                    $run = mysqli_query($con,$add);

                                    if($run){
                                        echo "<script>alert('Working, Topic is added ... ')</script>";
                                        echo "<script>window.open('forum.php' , '_self')</script>";            
                                    }else{
                                        echo "<script>alert('Error while adding topic information')</script>";
                                        echo "<script>window.open('forum.php' , '_self')</script>";
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

	
</div>
</body>
</html>