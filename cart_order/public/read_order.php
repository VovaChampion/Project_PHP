<?php

require "annex/config.php";
require "annex/common.php";
$success = null;

//SELECT ORDER
if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT o.order_id, o.order_name, o.order_email, p.product_name, oi.quantity, o.order_date FROM orders as o 
    JOIN orders_items as oi ON o.order_id=oi.order_id
    JOIN products as p ON oi.product_id=p.product_id WHERE o.order_id = :order_id";


    $order = $_POST['order_id'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':order_id', $order, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

?>
<?php require "../templates/header.php"; ?>

<div class="container">
  <?php if ($success)?><p><?php echo $success; ?></p>

  <?php  
  if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>
      <h3>Results</h3>
      <table>
        <thead>
          <tr>
            <th>Order Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Date</th>
            <!-- <th colspan="2">Action</th> -->
          </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) : ?>
          <tr>
            <td><?php echo escape($row["order_id"]); ?></td>
            <td><?php echo escape($row["order_name"]); ?></td>
            <td><?php echo escape($row["order_email"]); ?></td>
            <td><?php echo escape($row["product_name"]); ?></td>
            <td><?php echo escape($row["quantity"]); ?></td>
            <td><?php echo escape($row["order_date"]); ?></td>
            <!-- <td><a href="update_order.php">Update</a><br></td>
            <td><a href="delete_order.php">Delete</a><br></td> -->
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table><br>
      <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['order_id']); ?>.</blockquote>
      <?php } 
  } ?> 

  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="order_id">Enter the order number</label>
    <input type="text" id="order_id" name="order_id"><br><br>
    <input class="btn btn-success" type="submit" name="submit" value="View Results"><br>
  </form>
  <br>

  <a href="index.php?action=emptyall" class="btn btn-primary" role="button">Go back to home page</a><br>
  <a href="update_order.php" class="btn btn-info" role="button">Update -> Order</a><br>	
  <a href="delete_order.php" class="btn btn-info" role="button">Delete -> Order</a><br>

</div>

<?php require "../templates/footer.php"; ?>