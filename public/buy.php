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




try {
    // Try to connect to DB. Select all from bookinfo table.
    require_once "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $db_username, $db_password, $db_options);

    $sql = "SELECT * FROM bookinfo " ;

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
foreach($result as $row) {
    // output data of each row
    if($row['book_id']==$bookid) {
        echo "name: " . $row["book_name"]. " - author: " . $row["book_author"]. " - price: " . $row["book_price"]. "<br>";
    }
}
?>

<?php require "templates/footer.php";?>
