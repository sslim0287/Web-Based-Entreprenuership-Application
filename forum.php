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
	<title>Forum Section</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">

</head>
<style>
     #topic{
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
<div style="width: 100%; display: table;margin-left:30%;">
    <div style="display: table-row; ">
        <div style="width: 50%; display: table-cell; ">

	<div id="topicSection" style="margin-left: 20px; font-size:30px;">
        
			<div id="title">&nbspPopular Topics</div>
            <br>
            <!--<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Add New Topic Board</button> <br>--><br>

            <div id="topic">
		<?php
		$boards = $con->query("SELECT * FROM boards");
		while ($board_data = $boards->fetch_assoc()) {
		$threads = $con->query("SELECT * FROM threads WHERE board_id = ".$board_data['board_id']."");
		?>
		
        <table style="margin-left: 30px;">
            <tr>
                <th><b>#</b> <a href="view-topic.php?board_id=<?php echo $board_data['board_id'] ?>"><?php echo $board_data['board_name'] ?></a></th>
            </tr>
            <tr>
                <th>
                [<b><?php echo $threads->num_rows ?></b> Topics] <br><br>
                </th>
            </tr>
		</table>
        <?php }
		if ($boards->num_rows == null) {
		echo "<br>no topic board created yet";
		}
		?>
        </div>
	</div>
    </div>
       
    </div>
    </div>


		<div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal For Adding Forum Topic</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="f">
                            <strong>Add New Topic Board</strong>
                            <textarea class="form-control" name="topic" placeholder="Add a topic name" cols="80" rows="4" style="resize: none;" required></textarea><br>
                            <input class="btn btn-default" type="submit" name="sub" value="Submit" style="width: 100px;"><br><br>
                        </form>
                        <?php
                            if(isset($_POST['sub'])){
                                $bfn = htmlentities($_POST['topic']);
                                $title = $_POST['topic'];
                                if($bfn == ''){
                                    echo "<script>alert('Please enter something')</script>";
                                    echo "<script>window.open('forum.php' , '_self')</script>";
                                    exit();
                                }else{
                                    $add = "INSERT INTO boards (board_name) VALUES ('$title')";

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


</body>
</html>


                    