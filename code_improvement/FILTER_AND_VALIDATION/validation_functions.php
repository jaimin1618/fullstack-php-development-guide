<?php
// Core validation functions, used for error reportings
// We generally make LOOP and pass all params from it + passing them from another validation functions
$errors = [];
function validate_presence_on ($required_fields) {
    global $errors;
    foreach ($required_fields as $field) {
        if (!has_presence($_POST[$field])) {
            $errors[$field] = "$field cannot be blank";
        }
    }
}

function has_presence ($value) {
    $value = trim($value);
    return isset($value) && $value !== "";
}

function has_format_matching ($value, $regex='//') {
    return preg_match($regex, $value);
}

function is_in_array ($value, $set=[]) {
    return in_array($value, $set);
}

function has_uniqueness ($value, $table, $column) {
    $escaped_value = mysqli_escape_string($value); // $conn->escape_string();
    $sql = "SELECT COUNT(*) AS Count FROM {$table} WHERE {$column}='{$escaped_value}'";
    // if (Count > 0) Value is already present
}

function input_filter ($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Filter | Validation | Sanitization</title>
    </head>
    <body>
        
        <div style="border:1px solid blue;margin:5% auto;width:30%;padding:20px 30px;">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                Test Email:
                <input type="email" name="email" value="<?php echo $_GET['email']??''; ?>"> <button type="submit" name="EMAIL">Check Email Format</button>
            </form>
            <?php
            // CHECKING EMAIL FORMAT
            if (isset($_GET['EMAIL'])) {
                $email = input_filter($_GET['email']);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "VALID EMAIL";
                } else {
                    echo "NOT VALID EMAIL";
                }
            }
            ?>
            
            
        </div>
        
        
    </body>
</html>