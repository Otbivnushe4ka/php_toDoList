<?php
if (isset($_POST['id'])) {
    include 'dbConn.php';

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "DELETE FROM tasks WHERE id=$id";
    mysqli_query($conn, $sql);

    mysqli_close($conn);
}
