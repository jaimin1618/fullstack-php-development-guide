<?php

// logger file
$log_file = 'errors.log';

// logger function
function logger($level="ERROR", $msg="") {
    global $log_file;
    
    $log_msg = "$level: $msg" . PHP_EOL;  // All log will be in new line
    
    // write to file
    file_put_contents($log_file, $log_msg, FILE_APPEND | LOCK_EX);
}

// usage of error
logger("ERROR", "An Unknown error occurred");
logger("DEBUG", "X is 1");

echo "Logged";
?>