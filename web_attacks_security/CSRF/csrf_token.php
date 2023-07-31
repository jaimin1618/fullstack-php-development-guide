<?php // Use this functions to generate CSRF token for your USER

// MUST CALL THIS BEFORE USING IT
session_start();

/*Does not store token*/
function csrf_token () {
    // this is generate HASHED TOKEN to indentify user
    return md5(uniqid(rand(), TRUE));
}


/*generte and store CSRF token on session*/
function create_csrf_token () {
    $token = csrf_token();
    $_SESSION['csrf_token'] = $token;
    $_SESSION['token_time'] = time();
    return $token;
}

/*destroy token by removing it from session*/
function destroy_csrf_token () {
    $_SESSION['csrf_token'] = null;
    $_SESSION['token_time'] = null;
    return true;
}

// ============== THIS csrf_token_tag() IS ONLY FUNCTION YOU WRITE ============== //
/*You don't need to write HTML for hidden TOKEN field | Use this*/
function csrf_token_tag () {
    $token = create_csrf_token();
    return "<input class=\"\" id=\"csrf_token\" type=\"hidden\" name=\"csrf_token\" value=\"$token\">";
}

function is_csrf_token_valid () {
    if (isset($_POST['csrf_token'])) {
        $token = $_POST['csrf_token']; // WE GOT IT AFTER FORM SUBMISSION
        $stored_token = $_SESSION['csrf_token'];; // WE SAVED ON USER SESSION
        return $token === $stored_token;
    }
    return false;
}


// WHAT TO DO WHEN TOKEN IS FIALED. Use functions from below
function die_on_csrf_token_failure () {
    if (!is_csrf_token_valid()) {
        die("CSRF token validation failed!");
    }
}

function csrf_token_is_recent () {
    $max_time_elapsed = 60 * 60 * 24; // 1 day
    if (isset($_SESSION['token_time'])) {
        $stored_time = $_SESSION['token_time'];
        return ($stored_time + $max_time_elapsed) >= time();
    }
    destroy_csrf_token();
    return false;
}





?>

