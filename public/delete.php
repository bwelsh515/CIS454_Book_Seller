<?php

/**
 * Delete a user
 */

require "../config.php";
require "../common.php";

if (isset($_GET[" id"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $book_id = $_GET["book_id"];

    $sql = "DELETE FROM users WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "User successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM bookinfo";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<h2>Delete users</h2>

<?php if ($success) echo $success; ?>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th> Genre</th>
      <th> Name</th>
      <th> Author</th>
      <th> Price</th>
      <th>Is Available</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["book_id"]); ?></td>
      <td><?php echo escape($row["book_genre"]); ?></td>
      <td><?php echo escape($row["book_name"]); ?></td>
      <td><?php echo escape($row["book_author"]); ?></td>
      <td><?php echo escape($row["book_price"]); ?></td>
      <td><?php echo escape($row["is_available"]); ?></td>
     
      <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>