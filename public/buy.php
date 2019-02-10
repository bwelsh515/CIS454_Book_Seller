<?php require "templates/header.php";?>
<!--
    *
    *  Allow the User to Purchase the selected Textbook.
    *  Retrieve the Textbook info that was selected from DB
    *  Set the is_available field to 'Shipped'
    *  If Successful, display success message
    *  Else, report error
    *
 -->
<?php
session_start();
$bookid = $_GET['bookid'];
echo $bookid;
?>


<?php require "templates/footer.php";?>
