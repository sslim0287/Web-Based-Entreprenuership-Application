<?php
    $get_id = $_GET['thread_id'];

    $get_tcom = "SELECT *
                 FROM thread_comments LEFT JOIN users
                 ON thread_comments.comment_user = users.user_name 
                 WHERE thread_id = '$get_id' ORDER by 1 DESC";

    
    $run_tcom = mysqli_query($con,$get_tcom);

    while($row = mysqli_fetch_array($run_tcom)){
        $t_com_id = $row['id'];
        $t_com_userId = $row['user_id'];
        $t_com = $row['comment'];
        $t_com_name = $row['comment_user'];
        $t_com_fname = $row['f_name'];
        $t_com_lname = $row['l_name'];
        $date = $row['date'];

        echo "
            <div class='row'>
                <div class='col-md-6 col-md-offset-3'>
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

                        if($t_com_name == $own_username){
                            echo "  
                            <h4 style='float:left;'><a style='color: #5b9e9e; text-decoration:none;' href='user_profile.php?u_id=$userown_id'><strong>$own_fname $own_lname</strong></a> <i> commented </i> on $date</h4>
                            <a style='margin-left:100px; ' href='editThreadComment.php?thread_id=$thread_id&id=$t_com_id' class='btn btn-info'/>Edit Comment</a>
                            <a style='margin-left:30px; ' href='functions/deleteThreadComment.php?thread_id=$thread_id&id=$t_com_id' class='btn btn-danger'/>Delete Comment</a><br><br>
                            <p class='text-primary' style='font-size: 20px;color: #be845e'>";
                            echo nl2br($t_com);
                            echo" </p>";

                        }else{
                        echo"
                            <h4 style='float:left;'><a style='color: #5b9e9e; text-decoration:none;' href='user_profile.php?u_id=$t_com_userId'><strong>$t_com_fname $t_com_lname </strong></a> <i> commented </i> on $date</h4><br><br>
                            
                            <p class='text-primary' style='font-size: 20px;color: #be845e'>";
                            echo nl2br($t_com);
                            echo" </p>
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