<?php

$page = 'private/class';
// When user tries to go PRIVATE you can sent them to invalid URL
$valid_pages = Array('index.php', 'about.php', 'auth/login.php');

if (!in_array($page, $valid_pages)) {
    die('Invalid Page'); // or redirect
}


// You can create ALLOWED ONLY STRING (removes php speacial chars) function which prevents PHP code injection
$x = preg_replace("/[^A-Za-z0-9_]/", "", $string);

// replace special chars
$invalid_chars = ['/', '\"', '.', ';'];
$x = str_replace($invalid_chars, "", $string);

?>