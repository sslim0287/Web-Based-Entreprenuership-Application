<?php
    $get_id = $_GET['post_id'];

    $get_com = "SELECT * from comments LEFT JOIN users
                ON comments.comment_author = users.user_name
                WHERE post_id = '$get_id' ORDER by 1 DESC";


    $run_com = mysqli_query($con,$get_com);

    while($row = mysqli_fetch_array($run_com)){
        $com_userId = $row['user_id'];
        $com = $row['comment'];
        $com_id = $row['com_id'];
        $com_name = $row['comment_author'];
        $com_fname = $row['f_name'];
        $com_lname = $row['l_name'];
        $date = $row['date'];
        
                
        
        echo "
            <div class='row'>
                <div class='col-md-6 col-md-offset-3' >
                    <div class='panel panel-info' style='border:3px solid #000; font-size:20px; color: #584136'>
                    <div class='panel-body'>
                        <div>";

                        $user = $_SESSION['user_email'];
                        $get_user = "select * from users where user_email='$user'";
                        $run_user = mysqli_query($con,$get_user);
                        $row = mysqli_fetch_array($run_user);
        
                        $userown_id = $row['user_id'];
                        $own_username = $row['user_name'];
                        $own_fname = $row['f_name'];
                        $own_lname = $row['l_name'];

                        if($com_name == $own_username){
                            echo"
                        <h4 style='float:left;'><a style='color: #5b9e9e; text-decoration:none;' href='user_profile.php?u_id=$userown_id'><strong>$com_fname $com_lname </strong></a> <i> commented </i> on $date</h4>
                        <a style='margin-left:100px; ' href='editPostComment.php?post_id=$post_id&com_id=$com_id' class='btn btn-info'/>Edit Comment</a>
                        <a style='margin-left:30px; ' href='functions/deletePostComment.php?post_id=$post_id&com_id=$com_id' class='btn btn-danger'/>Delete Comment</a><br><br>
                        <p class='text-primary' style='font-size: 20px;color: #be845e'>";
                        echo nl2br($com);
                        echo"</p> ";
                       

        }else{
            echo"
          
                        <h4><a style='color: #5b9e9e; text-decoration:none;' href='user_profile.php?u_id=$com_userId'><strong>$com_fname $com_lname </strong></a> <i> commented </i> on $date</h4>
                        <p class='text-primary' style='font-size: 20px;color: #be845e'>";
                        echo nl2br($com);
                        echo"</p>
                        ";}
                        echo"
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    ";
    
}

?>

