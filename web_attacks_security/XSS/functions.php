<?php
// IF YOU USE THESE, XSS WON'T BE AFFECTIVE ON YOUR WEBSITE

// general sanitization should be used easily so add this function in Library
function h($string) {
    return htmlspecialchars($string);
}

function j($string) {
    return json_encode($string);
}

function u($string) {
    return urlencode($string);
}

?>