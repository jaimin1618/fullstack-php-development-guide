<?php

function sql_prep ($string) {
    global $conn;
    if ($conn) {
        return mysqli_real_escape_string($conn, $string); // IF FALSE, THEN ADD '/' end end
        // $conn->escape_string($query)
    } else {
        return addslashes($string);
    }
}

// Usage
// $username = sql_prep($_POST['username']);

?>