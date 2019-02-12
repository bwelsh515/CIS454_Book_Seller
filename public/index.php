<?php
/*
 *  Display all textbooks in the database.
 *  Provide Links to Purchase Textbook if Buyer
 *  Else, provide link to Sell textbook if Seller
 *
 */

session_start();
$change = "";
$sql = "SELECT * FROM bookinfo";

// If the sort button is pressed, change the SQL statement
if (isset($_POST['filter'])) {
    $sql = "SELECT * FROM bookinfo ORDER BY book_name";
}

// Prevent the user from accessing the page without being logged in.
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
    header("location: login.php");
    exit;
}

try {
    // Try to connect to DB. Select all from bookinfo table.
    require_once "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $db_username, $db_password, $db_options);

    // $sql = "SELECT * FROM bookinfo";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

?>

<?php require "templates/header.php";?>
<div class="container">
	<div class="page-header clearfix">
		<h2 class="pull-left">Textbooks For Sale</h2>
		<div class="btn-toolbar">
			<a href="logout.php" class="btn btn-danger pull-right">Logout</a>
			<!-- only display 'Add new Textbook' button if SELLER -->
			<?php if ($_SESSION["usertype"] == "Seller") {?>
				<a href="sell.php" class="btn btn-success pull-right">Add New Textbook</a>
			 <?php }?>
			 <?php if ($_SESSION["usertype"] !== "Admin") {?>
				<a href="create_report.php" class="btn btn-warning pull-right">Submit a Report</a>
			 <?php } else {?>
				<a href="reports.php" class="btn btn-warning pull-right">View User Reports</a>
			 <?php }?>
		</div>
	</div>
	<div>
		<form method="POST">
			<input type="submit" name="filter" class="btn btn-primary" value="Filter Textbooks By Name">
		</form>
	</div>
	<br></br>
	<?php
// Display a table with all results from the query
if ($result && $statement->rowCount() > 0) {?>
			<table class="table table-bordered table-striped table-hover">
				<thead class="thead-dark/">
					<tr>
						<th>Genre</th>
						<th>Name</th>
						<th>Author</th>
						<th>Price</th>
						<th>Availability</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($result as $row) {?>
					<tr>
						<td><?php echo escape($row["book_genre"]); ?></td>
						<td><?php echo escape($row["book_name"]); ?></td>
						<td><?php echo escape($row["book_author"]); ?></td>
						<td>$<?php echo escape($row["book_price"]); ?></td>
						<td><?php echo escape($row["is_available"]); ?></td>
						<!-- TODO: display edit/delete buttons if admin or owner of book (seller) -->
						<!-- Display a Buy Button if textbook is available and user is buyer -->
						<td>
							<div class="btn-toolbar">
						<?php if (escape($row["is_available"] == "Available" && $_SESSION["usertype"] == "Buyer")) {
    echo "<a href=\"buy.php?bookid=" . urlencode($row['book_id']) . "\" class=\"btn btn-info\">Buy Textbook</a>";
}?>
<?php if (escape($row["is_available"] == "Available" && $_SESSION["usertype"] == "Seller")) {
    echo "<a href=\"edit.php?bookid=" . urlencode($row['book_id']) . "\" class=\"btn btn-info\">Edit Textbook</a>";
    echo "<a href=\"delete.php?bookid=" . urlencode($row['book_id']) . "\" class=\"btn btn-info\">Delete Textbook</a>";
}?>


						</td>
					</tr>
				<?php }?>
				</tbody>
			</table>
		<!-- Nothing was retrieved from the query -->
		<?php } else {?>
			<blockquote>No Textbooks currently for Sale.</blockquote>
		<?php }
?>

</div>

<?php require "templates/footer.php";?>
