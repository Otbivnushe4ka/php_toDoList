<?php
if (isset($_POST['id']) && isset($_POST['completed']) != '') {
	include 'dbConn.php';

	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$completed = mysqli_real_escape_string($conn, $_POST['completed']);

	$sql = "UPDATE tasks SET completed=$completed WHERE id=$id";
	mysqli_query($conn, $sql);

	mysqli_close($conn);
}
