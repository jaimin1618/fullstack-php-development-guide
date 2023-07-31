<?php
 
// $user_input = "echo 'Hello'"; // this "echo" is BASH cmd echo NOT php echo
$user_input = "mkdir newfolder"; // this "echo" is BASH cmd echo NOT php echo | SEE THIS
// escapeshellcmd($user_input);


echo "Command: " . $user_input . "<br/>";
echo "<br/>";

$result = exec($user_input); // exec WILL execute CMD command | it is VERY HARMFUL to use, because user can give dangerous input
echo "Result: " . $result . "<br/>";


?>