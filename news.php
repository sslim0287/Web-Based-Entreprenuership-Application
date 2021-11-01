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
	<title>News</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap1/bootstrap/dist/css/bootstrap.min.css">
	 <script src="bootstrap1/bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap1/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/news.css">
</head>
<body>
<?php
        $url = 'https://newsapi.org/v2/top-headlines?country=my&category=business&apiKey=5f14abe1ae6c4eae9ea583f35b2ec781';
        $response = file_get_contents($url);
        $NewsData = json_decode($response);
    ?>
    <div class="jumbotron">
        <h2 style="margin-top: -30px;">News Section</h2>
        <a href="news.php"> <h3 style="color: blanchedalmond;float:left;">Business </h3></a>
        <a href="news2.php"> <h3 style="color: blanchedalmond;float:left;margin-left: 100px; ">Technology </h3></a>
        <a href="news3.php"> <h3 style="color: blanchedalmond;float:left;margin-left: 100px; ">Health </h3></a>
        <a href="news4.php"> <h3 style="color: blanchedalmond;float:left;margin-left: 100px; ">Science </h3></a> <br><br>

    </div>
    <div class="container-fluid">
        <?php
            foreach($NewsData->articles as $News)
            {

        ?>
        <div class="row NewsGrid">
            <div class="col-md-3">
                <img src="<?php echo $News->urlToImage?>" alt="News thumbnail" class="rounded">
            </div>
            <div class="col-md-9">
                <h2>Title: <?php echo $News->title ?></h2>
                <h5>Description <?php echo $News->description?></h5>
                <p>Content: <?php echo $News->content?></p>
                <h6>Author: <?php echo $News->author?></h6>
                <h6>Published <?php echo $News->publishedAt?> </h6>
                <h6>Url to News: <?php echo "<a href = '$News->url'>Direct to the News</a>";?></h6>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</body>
</html>