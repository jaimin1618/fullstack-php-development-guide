<?php

/**
 * making sure see errors if there are errors in our code
 */
ini_set('display_errors', 0);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_URI'] === '/') {
    header("Content-Type: text/html");
    echo html_entity_decode("<html><head><title>Main</title></head><body><h1>Home Page: GET /</h1></body></html>");
}

require_once __DIR__ . '/../init.php';
