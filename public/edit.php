<?php
/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
    header("location: login.php");
    exit;
}

require "../config.php";
require "../common.php";

$id = "";
$is_available = "Available";
$book = [
    "book_genre" => "",
    "book_name" => "",
    "book_author" => "",
    "book_price" => "",
];

if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $db_username, $db_password, $db_options);
        $book = [
            "book_genre" => $_POST['book_genre'],
            "book_name" => $_POST['book_name'],
            "book_author" => $_POST['book_author'],
            "book_price" => $_POST['book_price'],
        ];

        $sql = "UPDATE bookinfo
            SET  book_id = :id,
              book_genre = :book_genre,
              book_name = :book_name,
              book_author = :book_author,
              book_price = :book_price,
              is_available = :is_available
            WHERE book_id = :id";

        $statement = $connection->prepare($sql);
        $statement->execute($book);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['bookid'])) {
    try {
        $connection = new PDO($dsn, $db_username, $db_password, $db_options);
        $id = $_GET['bookid'];
        $sql = "SELECT * FROM bookinfo WHERE book_id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php";?>

<?php if (isset($_POST['submit']) && $statement): ?>
	<blockquote><?php echo escape($_POST['book_name']); ?> successfully updated.</blockquote>
<?php endif;?>

<h2>Edit the book</h2>

<form method="post">
    <?php foreach ($book as $key => $value): ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>">
    <?php endforeach;?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php";?>
