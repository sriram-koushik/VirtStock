<?php
// set the expiration date as required.. Here we take it to a point where the psgcookie is not set  
setcookie ("psgcookie", "", time() - 13000);
//setcookie ("psgcookie", "");
header("Location: login.php");
?>