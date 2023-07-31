<?php

// Here, We have functions which can prevent session hijack attacks
session_start();

function end_session () {
    // Use both for ALL BROWSWER compatibility
    session_unset();
    session_destroy();
}

/*
There are 3 FUNCTION to check
1) Does request IP matched stored value
2) Does request user agent matched stored value
3) has too much time since login
*/

function request_ip_matches_session () {
    if (!isset($_SESSION['ip']) || !isset($_SERVER['REMOTE_ADDR'])) {
        return false;
    }
    if ($_SESSION['ip'] === $_SERVER['REMOTE_ADDR']) {
        return true;
    }
    return false;
}

function request_user_agent_matches_session () {
    if (!isset($_SESSION['user_agent']) || !isset($_SERVER['HTTP_USER_AGENT'])) {
        return false;
    }
    if ($_SESSION['user_agent'] === $_SERVER['HTTP_USER_AGENT']) {
        return true;
    }
    return false;
}

function last_login_is_recent () {
    $max_elapsed = 60 * 60 * 24; // 1 D
    if (!isset($_SERVER['last_login'])) {
        return false;
    }
    if ($_SERVER['last_login'] + $max_elapsed >= time()) {
        return true;
    }
    return false;
}


// CHECKING ALL 3 CONDITION for session validity
function is_session_valid () {
    $ip = true;
    $user_agent = true;
    $last_login = true;
    
    if ($ip && !request_ip_matches_session()) { return false;  }
    if ($user_agent && !request_user_agent_matches_session()) { return false; }
    if ($last_login && !last_login_is_recent()) { return false;  }
    return true;
}


function confirm_session_valid () {
    if (!is_session_valid()) {
        end_session();
        header("Location: login.php");
        exit;
    }
}

function is_logged_in () {
    return (isset($_SESSION['logged_in']) && $_SESSION['logged_in']);
    // $_SESSION['logged_in'] is TRUE/FALSE in value
}

function confirm_user_logged_in () {
    if (!is_logged_in()) {
        end_session();
    }
    header("Location: login.php");
    exit;
}

function after_successful_login () {
    session_regenerate_id(); // PHP buildin function to REGENERATE session id | which should NOT be given to hacker
    
    $_SESSION['logged_in'] = true;
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION['last_login'] = time();
}


function after_successful_logout () {
    $_SESSION['logged_in'] = false;
    end_session();
}


function before_every_protected_page () {
    confirm_user_logged_in();
    confirm_session_valid();
}




?>