<?php require_once('../private/initialize.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Public page</title>
    </head>
    <body>
        
        
    
        
        <h2>This is home page</h2>
        <small>you WILL FIND this index.php in every folder inside public so that you cannot see file structure</small>
        
        <?php
        
        echo "<b><pre>";
        echo "USING PUBLIC/PRIVATE/APP_ROOT for sourcing from private<br>";
        echo APP_ROOT . "<br>";
        echo PUBLIC_PATH . "<br>";
        echo PRIVATE_PATH . "<br>";
        echo "</pre></b>";
        
        ?>
        
    </body>
</html>