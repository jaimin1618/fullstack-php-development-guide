<?php

function extract_get_params($allowed_params=[]) {
    $allowed_array = [];
    foreach ($allowed_params as $param) {
        if (isset($_GET[$param])) {
            // APPLY FILTERS AND SANITIZATIONS HERE THEN GO FURTHER
            // IF DATA DOESN'T PASS TEST DO NOT LET THEM ENTER IN YOUT LIST
            // WHEN LIST IS POOR/LESS SEND ARRAY CONTAINING ERRORS ON CLIENT SIDE
            
            $allowed_array[$param] = $_GET[$param];
        } else {
            $allowed_array[$param] = NULL;
        }
    }
    return $allowed_array;
}

/*
GET WHAT YOU WANT ONLY | Even if someone tries to add more parameter/variables,
on $_GET request, you can REJECT THEM using above code
*/

$params = extract_get_params(['username', 'email', 'password']);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Sending $_GET request</title>
    </head>
    <body>
        <style>
            input {
                margin:10px;
                font-family:sans-serif;
            }
            
        </style>

        <?php if (isset($_GET['submit'])): ?>
            <h3>
                <pre>SEE HOW MANY THINGS ARE COMMING IN GET REQUEST: <br>
                <?php print_r($_GET); ?>
                </pre>
            </h3>

            <h3>
                <pre>LET US FILTER ONLY THINGS WE WANT: <br>
                <?php print_r($params); ?>
                </pre>
            </h3>
            
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                <input type="submit" name="reset" value="Reset">
                <?php if (isset($_GET['reset'])) { unset($_GET); }?>
            </form>
            
        <?php else: ?>

                    <div style="border:2px solid blue;width:35%;margin:10% auto;font-family:sans-serif;">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                            Username: <input type="text" name="username" value=""> <br>
                            Email: <input type="text" name="email" value=""> <br>
                            Password: <input type="password" name="password" value=""> <br>
                            Gender: <input type="radio" name="" value="male"> Male | <input type="radio" name="" value="female"> Female <br>
                            <input type="submit" name="submit" value="Submit"> <br>
                        </form>
                    </div>
            
        <?php endif; ?>

</body>
</html>