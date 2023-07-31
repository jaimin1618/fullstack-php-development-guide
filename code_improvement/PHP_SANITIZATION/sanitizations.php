<?php
$sanitize = false;

$test_html = "<div style=\"color:red;font-size:30px;\">" .
               "This <strong>string</strong> contains &" .
               "<span style=\"color:green;\">HTML</span>" .
               "<br />";
$test_script = "<script> alert(\" <! Hacked !> \"); </script>";

if (isset($_GET['button'])) { $sanitize = true; }
if (isset($_GET['reset'])) { $sanitize = false; }

if ($sanitize) {
    echo htmlspecialchars($test_html);
    // echo htmlentities($test_html);
    // echo strip_tags($test_html);
    
    echo htmlspecialchars($test_script);
    // echo htmlentities($test_html);
    // echo strip_tags($test_html);
} else {
    echo $test_html . "<br>";
    echo $test_script;
}


// Just like these, We have urlencode() and json_encode() FOR URL AND JSON

// Use addslashes to prevent SQL infection

?>

<form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    <button type="submit" name="button">Sanitize</button>
</form>

<form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    <button type="submit" name="reset">Reset</button>
</form>




