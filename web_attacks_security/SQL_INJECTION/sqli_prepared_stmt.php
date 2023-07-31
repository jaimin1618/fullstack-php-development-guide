<?php

$conn = new mysqli('localhost', 'root', '', 'hospital');

if ($conn->connect_errno) {
    die("Connection failed: ($conn->connect_errno) $conn->connect_error");
}

// STEP 1 => Create Query with anonymous (?)
$sql = "SELECT id, username FROM users WHERE username=? AND password=?";

// STEP 2 => Create statement
$stmt = $conn->prepare($sql);

// STEP 3 => Check statement error
if (!$stmt) { die("Prepare failed: ($conn->errno) $conn->error"); }

// STEP 4 => Set variables
$username = 'Jane Doe';
$password = md5("abc123");

// STEP 5 => bind params
$bind_result = $stmt->bind_param('ss', $username, $password);
if (!$bind_result) { echo "Binding failed: ($stmt->errno) $stmt->error"; }

// STEP 6 => Fire request / Execute
$execute_result = $stmt->execute();
if (!$execute_result) { echo "Execute failed: ($stmt->errno) $stmt->error"; }

// STEP 7 => Work with result
// $stmt->store_result();
$stmt->bind_result($id, $username); // get selected columns in variables

// STEP 8 => fetch result
while ($stmt->fetch()) {
    echo "ID: " . $id . "<br>";
    echo "Username: " . $username . "<br>";
    echo "<br>";
}

// STEP 8 => Free result, close statement, close connection
$stmt->free_result();
$stmt->close();
$conn->close();





?>