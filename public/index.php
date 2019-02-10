<?php
/*
 *  Display all textbooks in the database.
 *  Provide Links to Purchase Textbook if Buyer
 *  Else, provide link to Sell textbook if Seller
 *
 */

session_start();

try {
    // Try to connect to DB. Select all from bookinfo table.
    require_once "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $db_username, $db_password, $db_options);

    $sql = "SELECT * FROM bookinfo";

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
		<!-- TODO: only display button if SELLER -->
		<div class="btn-toolbar">
			<a href="logout.php" class="btn btn-danger pull-right">Logout</a>
			<a href="sell.php" class="btn btn-success pull-right">Add New Textbook</a>
		</div>
	</div>
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
						<!-- TODO: Add Check if user_type is Buyer -->
						<!-- Display a Buy Button if textbook is available and user is buyer -->
						<?php if (escape($row["is_available"] == "Available")) {
    $_SESSION['book_name'] = $row['book_name'];
    echo "<td><a href=\"buy.php?bookid=" . urlencode($row['book_id']) . "\" class=\"btn btn-info\">Buy Textbook</a></td>";

} else {
    echo "<td></td>";
}?>
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
