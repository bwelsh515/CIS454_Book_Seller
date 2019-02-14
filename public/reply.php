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

$report_id = $_GET['reportid'];
$id ="";
$report = [
    "report_id" => "",
    "report_creator" => "",
    "report_title" => "",
    "description" => "",
    "report_status" => "",
    "comments" => "",
];

if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $db_username, $db_password, $db_options);
        $report = [
            "report_id" => $_POST['report_id'],
            "report_creator" => $_POST['report_creator'],
            "report_title" => $_POST['report_title'],
            "description" => $_POST['description'],
            "report_status" => $_POST['report_status'],
            "comments" => $_POST['comments'],
        ];
        $sql = "UPDATE reports
            SET  report_id = :report_id,
              report_creator = :report_creator,
              report_title = :report_title,
              description = :description,
              report_status = :report_status,
              comments = :comments
            WHERE report_id = :report_id";
        $statement = $connection->prepare($sql);
        $statement->execute($report);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['reportid'])) {
    try {
        $connection = new PDO($dsn, $db_username, $db_password, $db_options);
        $id = $_GET['reportid'];
        $sql = "SELECT * FROM reports WHERE report_id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $report = $statement->fetch(PDO::FETCH_ASSOC);
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
	<blockquote>Reply successfully updated.</blockquote>
<?php endif;?>

<div class="container">
    <div class="page-header clearfix">
        <h2 class="pull-left">Reply</h2>
        <div class="btn-toolbar">
			<a href="logout.php" class="btn btn-danger pull-right">Logout</a>
            <a href="reports.php" class="btn btn-success pull-right">Back To ViewReport</a>
		</div>
    </div>

    <div class="wrapper">
        <form method="post">
            <?php foreach ($report as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'report_id' || $key === 'report_creator' || $key === 'report_title' || $key === 'description' || $key === 'report_status'? 'readonly' : null); ?>>
    <?php endforeach; ?> 
                <input type="submit" name="submit" class="btn btn-primary btn-md pull-right" value="Submit">
        </form>
    </div>
</div>

<?php require "templates/footer.php";?>