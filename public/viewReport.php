<?php
/*
 *  Display all textbooks in the database.
 *  Provide Links to Purchase Textbook if Buyer
 *  Else, provide link to Sell textbook if Seller
 *
 */

session_start();

// Prevent the user from accessing the page without being logged in.
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
    header("location: login.php");
    exit;
}

// Redirect if user is not Admin type
// Page should only be viewable by the Administrators
// TODO: uncomment when admin account is created
// if ($_SESSION["usertype"] !== "Admin") {
//     header("location: index.php");
//     exit;
// }

try {
    // Try to connect to DB. Select all from bookinfo table.
    require_once "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $db_username, $db_password, $db_options);

    // TODO: make sure this matches table
    $sql = "SELECT * FROM reports WHERE report_creator = '" . $_SESSION["id"] . "' ";

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
        <h2 class="pull-left">View User Reports</h2>
        <a href="index.php" class="btn btn-success pull-right">Back To Textbooks</a>
	</div>

	<?php
// Display a table with all results from the query
if ($result && $statement->rowCount() > 0) {?>
			<table class="table table-bordered table-striped table-hover">
				<thead class="thead-dark/">
					<tr>
                        <th>Status</th>
                        <!-- <th>Creator</th> -->
						<th>Title</th>
						<th>Description</th>
						<th>Reply</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($result as $row) {?>
					<tr>
                        <td><?php echo escape($row["report_status"]); ?></td>
                        <!-- <td><?php echo escape($row["report_creator"]); ?></td> -->
						<td><?php echo escape($row["report_title"]); ?></td>
						<td><?php echo escape($row["description"]); ?></td>
						<td><?php echo escape($row["comments"]); ?></td>
						<!-- TODO: display edit/delete buttons if admin or owner of book (seller) -->
					</tr>
				<?php }?>
				</tbody>
			</table>
		<!-- Nothing was retrieved from the query -->
		<?php } else {?>
			<blockquote>No Reports Available.</blockquote>
		<?php }
?>

</div>

<?php require "templates/footer.php";?>
