<?php

// PHP Functions library
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}

?>