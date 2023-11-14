<?php
if (isset($_POST['name']) && $_POST['name'] != '') {
	include 'dbConn.php';

	session_start();
	$id = $_SESSION['user_id'];
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	date_default_timezone_set('Europe/Riga');
	$date = date("Y-m-d H:i:s");

	$sql = "INSERT INTO lists (name, user_id, made_datetime) VALUES ('$name', '$id', '$date')";
	
	mysqli_query($conn, $sql);

	mysqli_close($conn);
}

header('Location: index.php');
