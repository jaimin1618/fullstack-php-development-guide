<?php

// Making secure cookie example

// setcookie(name, value, expire(seconds), path, domain, secure, httponly);

// use NULL for passing default parameters => setcookie(name, value, NULL, NULL, domain);

$expire = time() + 60 * 60 * 24 * 7; // 1 week
$path = NULL;
$domain = NULL;
$secure = isset($_SERVER['HTTPS']); // if HTTPS site => cookie is secured otherwise NOT
$httponly = true; // STOPPING script actions

setcookie("cookie[one]", "cookie_one", $expire, $path, $domain, $secure, $httponly);
setcookie("cookie[two]", "cookie_two", $path, $domain, $secure, $httponly);
setcookie("cookie[three]", "cookie_three", $path, $domain, $secure, $httponly);

?>


<pre>
    <h1>USING COOKIE FROM PHP CODE</h1> <hr>
    
    <?php if (isset($_COOKIE['cookie'])): ?>
        <ul>
        <?php foreach ($_COOKIE['cookie'] as $name => $val): ?>
            <li><?php echo $name; ?> : <?php echo $val; ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</pre>
    
