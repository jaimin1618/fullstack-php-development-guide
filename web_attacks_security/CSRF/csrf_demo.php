<?php
require_once('functions.php');
require_once('csrf_token.php');

if (request_is_post()) {
    if (is_csrf_token_valid()) {
        $msg = "VALID FORM SUBMISSION";
        if (csrf_token_is_recent()) {
            $msg .= " (recent)";
            
            /*
                HERE OUR MAIN/PROCESS CODE GOES ABOUT WHAT TO DO WITH GIVEN INPUTS
            */
            
        } else {
            $msg .= " (not recent)";
        }
    } else {
        $msg = "CSRF TOKEN MISSING OR MISMATCHED";
    }
} else {
    $msg = "Please login";
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>CSRF Demo</title>
    </head>
    <body>
        
        <?php echo $msg; ?> <br>
        <form action="" method="POST">
            <?php echo csrf_token_tag(); /*something like @csrf in LARAVEL*/ ?>
            <!--
                csrf_token_tag() provides;
                - GENERATE TOKEN
                - STORE IT IN SESSION
                - OUTPUT HTML TAG WITH VALUE=generated token.
            -->
            
            Username: <input type="text" name="username" value=""> <br>
            Password: <input type="password" name="password" value=""> <br>
            <input type="submit" name="submit" value="Submit">
        </form>
        
    </body>
</html>


<?php foreach ($_POST as $key => $val) {
    echo $key . ' : ' . $val . '<br>';
} ?>