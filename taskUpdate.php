<?php
if (isset($_POST['id'])) {
	include 'dbConn.php';

	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$item = mysqli_real_escape_string($conn, $_POST['item']);

	$sql = "UPDATE tasks SET item='$item' WHERE id=$id";
	mysqli_query($conn, $sql);

	mysqli_close($conn);
}