<?php

session_start();  // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page after logout
header('location: /GreenMarket/Landing_Page/Landingpage.html');
exit();
?>





?>