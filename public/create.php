<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try {
        $connection = new PDO($dsn, $db_username, $db_password, $db_options);

        $new_user = array(
            "book_genre" => $_POST['Genre'],
            "book_name" => $_POST['Name'],
            "book_author" => $_POST['Author'],
            "book_price" => $_POST['Price'],
            "is_available" => 'Available'
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "bookinfo",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

}
?>

<?php require "templates/header.php";?>

<?php if (isset($_POST['submit']) && $statement) {?>
	<blockquote><?php echo $_POST['Genre']; ?> successfully added.</blockquote>
<?php }?>

<h2>Add a user</h2>

<form method="post">
	<label for="Genre">Genre</label>
	<input type="text" name="Genre" id="Genre">
	<label for="Name">Name</label>
	<input type="text" name="Name" id="Name">
	<label for="Author">Author</label>
	<input type="text" name="Author" id="Author">
	<label for="Price">Price</label>
	<input type="text" name="Price" id="Price">
	
	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php";?>
