<?php
/*
 *  Allow the User to Purchase the selected Textbook.
 *  Retrieve the Textbook info that was selected from DB
 *  Set the is_available field to 'Shipped'
 *  If Successful, display success message
 *  Else, report error
 */
session_start();

// Prevent the user from accessing the page without being logged in.
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
    header("location: login.php");
    exit;
}

require_once "../config.php";
require "../common.php";

$book_name = $book_price = "";
$book_id = $_GET['bookid'];
$purchased = false;

try {
    // Try to connect to DB. Select all from bookinfo table.
    $connection = new PDO($dsn, $db_username, $db_password, $db_options);
    $sql = "SELECT * FROM bookinfo WHERE book_id = :id";
    if ($stmt = $connection->prepare($sql)) {
        $stmt->bindParam(":id", $book_id);
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                if ($row = $stmt->fetch()) {
                    $book_name = $row['book_name'];
                    $book_price = $row['book_price'];
                }
            }
        }
    }

} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $db_username, $db_password, $db_options);
        $sql = "UPDATE bookinfo SET is_available = 'Shipped' WHERE book_id = :id";
        if ($stmt = $connection->prepare($sql)) {
            $stmt->bindParam(":id", $book_id);
        }
        if ($stmt->execute()) {
            $purchased = true;
        }
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/header.php";?>
<div class="container">
    <div class="page-header clearfix">
        <h2 class="pull-left">Buy a Textbook</h2>
        <a href="index.php" class="btn btn-success pull-right">Back To Textbooks</a>
    </div>
<?php if (!$purchased) {?>
    <div class="wrapper">
        <form method="post">
            <p>Are you sure you want to purchase <strong><?php echo $book_name; ?></strong> for <strong>$<?php echo $book_price; ?></strong>?</p>
            <div class="btn-toolbar">
                <a href="index.php" class="btn btn-danger pull-right">No</a>
                <input type="submit" name="submit" class="btn btn-primary btn-md pull-right" value="Yes">
            </div>
        </form>

    </div>
<?php } else {?>
<!-- TODO: Add User Location into Success Message -->
<h3>You have successfully purchased the textbook. The textbook is being sent to your address.</h3>
</div>
<?php }?>

<?php require "templates/footer.php";?>
