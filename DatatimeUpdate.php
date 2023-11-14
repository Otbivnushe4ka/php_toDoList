<?php
if (isset($_POST['id']) && isset($_POST['made_datetime'])) {
	include 'dbConn.php';

	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$made_datetime = mysqli_real_escape_string($conn, $_POST['made_datetime']);

	$sql = "UPDATE lists SET to_datetime='$made_datetime' WHERE id=$id";
	mysqli_query($conn, $sql);

	mysqli_close($conn);
}