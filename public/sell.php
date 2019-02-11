<?php

/*
 *  Get Textbook information from user via form
 *  Store data into bookinfo DB
 *  Provide Success message
 */
session_start();

// Prevent the user from accessing the page without being logged in.
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
    header("location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try {
        $connection = new PDO($dsn, $db_username, $db_password, $db_options);

        $new_textbook = array(
            "book_genre" => $_POST['Genre'],
            "book_name" => $_POST['Name'],
            "book_author" => $_POST['Author'],
            "book_price" => $_POST['Price'],
            "is_available" => 'Available',
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "bookinfo",
            implode(", ", array_keys($new_textbook)),
            ":" . implode(", :", array_keys($new_textbook))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_textbook);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

}
?>

<?php require "templates/header.php";?>

<?php if (isset($_POST['submit']) && $statement) {?>
	<blockquote><?php echo $_POST['Name']; ?> successfully added.</blockquote>
<?php }?>
<div class="container">
    <div class="page-header clearfix">
        <h2 class="pull-left">Sell a Textbook</h2>
        <div class="btn-toolbar">
			<a href="logout.php" class="btn btn-danger pull-right">Logout</a>
            <a href="index.php" class="btn btn-success pull-right">Back To Textbooks</a>
		</div>
    </div>

    <div class="wrapper">
        <form method="post">
            <div class="form-group row">
                <label for="Genre" class="col-sm-2 col-form-label">Book Genre</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="Genre" id="Genre" placeholder="Enter the Genre of the Book">
                </div>
            </div>
            <div class="form-group row">
                <label for="Name" class="col-sm-2 col-form-label">Book Name</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="Name" id="Name" placeholder="Enter the Name of the Book">
                </div>
            </div>
            <div class="form-group row">
                <label for="Author" class="col-sm-2 col-form-label">Author</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="Author" id="Author" placeholder="Enter the Author of the Book">
                </div>
            </div>
            <div class="form-group row">
                <label for="Price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="Price" id="Price" placeholder="Enter the Price of the Book">
                </div>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-md pull-right" value="Submit">
        </form>
    </div>

</div>

<?php require "templates/footer.php";?>