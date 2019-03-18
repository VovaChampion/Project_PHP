<?php

require "annex/config.php";
require "annex/common.php";

$success = null;

if (isset($_POST["submit"])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $id = $_POST["submit"];

    $sql = "DELETE FROM orders_items WHERE order_id = :order_id LIMIT 1";

    // $sql = "DELETE o, oi FROM orders as o JOIN orders_items as oi ON o.order_id=oi.order_id 
    // WHERE o.order_id = :order_id and oi.product_id = :product_id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':order_id', $id);
    //$statement->bindValue(':product_id', $p_id);
    $statement->execute();

    $success = "Order successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM orders_items";

  // $sql = "SELECT o.order_id, o.order_name, o.order_email, oi.product_id, oi.quantity, o.order_date FROM orders as o 
  // JOIN orders_items as oi ON o.order_id=oi.order_id";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "../templates/header.php"; ?>
        
<h2>Delete order</h2>

<?php if ($success) echo $success; ?>
<br>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <table>
      <thead>
        <tr>
          <th>Order Id</th>
          <th>Product Id</th>
          <th>Quantity</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["order_id"]); ?></td>
          <td><?php echo escape($row["product_id"]); ?></td>
          <td><?php echo escape($row["quantity"]); ?></td>
        <td><button type="submit" name="submit" value="<?php echo escape($row["order_id"]); ?>" onclick="return confirm_delete()">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>
<br>

<a href="index.php?action=emptyall" class="btn btn-primary" role="button">Go back to home page</a><br>
<a href="read_order.php" class="btn btn-info" role="button">Read -> Order</a><br>	
<a href="update_order.php" class="btn btn-info" role="button">Update -> Order</a><br>	


<?php require "../templates/footer.php"; ?>