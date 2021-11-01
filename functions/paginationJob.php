<style>
.pagination a{
	color: black;
	float: left;
	padding: 8px 16px;
	text-decoration: none;
	transition: background-color .3s;
}
.pagination a:hover:not(.active){background-color: #ddd;}
</style>
<?php
	
	$query = "select * from posts where post_content like '%#Job%' OR upload_image like '%#Job%'";

	$result = mysqli_query($con, $query);

	$total_posts = mysqli_num_rows($result);

	$total_pages = ceil($total_posts / $per_page);

	echo"
		<center>
		<div class='pagination'>
		<a href='job.php?page=1'>First Page</a>
	";

	for ($i=1; $i <= $total_pages ; $i++) { 
		echo"<a href='job.php?page=$i'>$i</a>";
	}

	echo"<a href='job.php?page=$total_pages'>Last Page</a></div>";
?>