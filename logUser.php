<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    include 'dbConn.php';

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // email ans password checking
    $sql_check = "SELECT id, email, password
        FROM users 
        WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        // make a session
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
    }else {
        header("Location: login.php");
    }
    
    mysqli_close($conn);
}
