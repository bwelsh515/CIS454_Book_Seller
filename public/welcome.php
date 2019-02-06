<?php
/* 
* Display all textbooks in the database.
* 
*/
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
		<a href="create.php" class="btn btn-success pull-right">Add New Textbook</a>
	</div>
	<?php
		// Display a table with all results from the query
		if ($result && $statement->rowCount() > 0) {?>
			<table class="table table-bordered table-striped table-hover">
				<thead>
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
						<?php if ($row["is_available"] == 1) {
							echo "<td>Available</td>";
						} else {
							echo "<td>Shipped</td>";
						}
						?>
						<td></td> <!-- TODO: add action buttons -->
					</tr>
				<?php }?>
				</tbody>
			</table>
		<!-- Nothing was retrieved from the query -->
		<?php } else {?>
			<blockquote>No Textbooks currently for Sale.</blockquote>
		<?php }
	?>

	<a href="index.php">Back to home</a>
</div>

<?php require "templates/footer.php";?>