<?php require_once('credentials.php');

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_errno > 0) {
    $conn_error = $conn->connect_error;
    die("Database connection failed:");
}

?>
