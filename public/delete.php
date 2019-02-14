<?php

/**
 * Delete a user
 */
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
    header("location: login.php");
    exit;
}
$book_id = $_GET['bookid'];
$success = "";

require "../config.php";
require "../common.php";

if (isset($_GET["bookid"])) {
  try {
    $connection = new PDO($dsn, $db_username, $db_password, $db_options);
  

    $sql = "DELETE FROM bookinfo WHERE book_id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $book_id);
    $statement->execute();

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

?>
<h1 class="text" style=" text-align:center;">This book is successfully deleted</h1>
<a href="index.php" class="btn btn-danger pull-right">Back to previous page</a>

<?php require "templates/footer.php"; ?>
