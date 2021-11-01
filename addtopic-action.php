<?php
include 'includes/connection.php';
if (isset($_POST['add_title'])) {
$title = $_POST['title'];

$add_title = $con->query("INSERT INTO boards (board_name) VALUES ('$title')");
if ($add_title) {
header("Location: forum.php");
} else {
echo $con->error;
}
}
?>