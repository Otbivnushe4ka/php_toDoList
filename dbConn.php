<?php
// $_ENV = parse_ini_file('file.env');
// $conn = mysqli_init();
// $conn->ssl_set('/path/to/certificate.pem', null, null, null, null);
// $conn->real_connect($_ENV["HOST"], $_ENV["USERNAME"], $_ENV["PASSWORD"], $_ENV["DATABASE"]);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist_vlad";
$conn = new mysqli($servername, $username, $password, $dbname);