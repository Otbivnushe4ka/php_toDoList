<?php
if (isset($_POST['item']) && $_POST['item'] != '') {
	include 'dbConn.php';

	$lists_id = mysqli_real_escape_string($conn, $_POST['lists_id']);
	$item = mysqli_real_escape_string($conn, $_POST['item']);
	date_default_timezone_set('Europe/Riga');
	$date = date("Y-m-d H:i:s");

	$sql = "INSERT INTO tasks (lists_id, item, made_datetime) VALUES ('$lists_id', '$item', '$date')";
	
	mysqli_query($conn, $sql);

	mysqli_close($conn);
}
