<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    include 'dbConn.php';

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $sname = mysqli_real_escape_string($conn, $_POST['sname']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']) == "male" ? 1 : 2;

    // email checking
    $sql_check = "SELECT email
        FROM users 
        WHERE email='$email'";
    $result = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result) < 1) {
        // data inserting
        $sql = "INSERT INTO users (fname, sname, gender_id, email, password) VALUES ('$fname', '$sname', '$gender', '$email', '$password')";
        mysqli_query($conn, $sql);

        // pick users id from db
        $sql_user = "SELECT id, email, password
        FROM users
        WHERE password='$password' AND email='$email'";

        $result = mysqli_query($conn, $sql_user);
        $user = mysqli_fetch_assoc($result);
        // make a session
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
    } else {
        header("Location: login.php");
    }
    mysqli_close($conn);
}
