<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.php");
exit;
?>

<?php require "templates/header.php";?>
<!--
    *
    *  Destroy all SESSION data that contains user information
    *  Logout user
    *
 -->
Logout Page

<?php require "templates/footer.php";?>
