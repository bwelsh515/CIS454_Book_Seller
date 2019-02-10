<?php require "templates/header.php";?>
<!--
    *
    *  Destroy all SESSION data that contains user information
    *  Logout user
    *
 -->
 <?php
session_start();
if(session_destroy()) {
      header("Location: login.php");
   }
?>
Logout Page

<?php require "templates/footer.php";?>
