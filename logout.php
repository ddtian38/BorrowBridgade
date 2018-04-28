<?php
session_start();
unset($_SESSION["user"]);
// remove all session variables
session_unset(); 
// destroy the session 
session_destroy(); 
echo "<h1>Destroying Session Files and Logging Out...</h1>";
header( "refresh:2;url= login.html" );
?>
