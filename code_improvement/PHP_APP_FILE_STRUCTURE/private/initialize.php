<?php

// HANDY CONSTANTS
define('APP_ROOT', dirname(__DIR__));
define('PRIVATE_PATH', APP_ROOT . '/private');
define('PUBLIC_PATH', APP_ROOT . '/public');

require_once(PRIVATE_PATH . '/credentials.php');
require_once(PRIVATE_PATH . '/db_connection.php');
require_once(PRIVATE_PATH . '/functions.php');

?>
