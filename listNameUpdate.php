<?php
if (isset($_POST['id']) && isset($_POST['name'])) {
	include 'dbConn.php';

	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);

	$sql = "UPDATE lists SET name='$name' WHERE id=$id";
	mysqli_query($conn, $sql);

	mysqli_close($conn);
}