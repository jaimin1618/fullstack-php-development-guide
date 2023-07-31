<?php

function request_is_get () {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function request_is_post () {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function request_is_ajax () {
    $header = apache_request_headers();
    return isset($header['X-Requested-With']) && $header['X-Requested-With']=='XMLHttpRequest';
}




?>