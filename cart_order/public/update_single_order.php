<?php

require "annex/config.php";
require "annex/common.php";
  
if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $orders =[
      "order_item_id"      => $_POST['order_item_id'],
      "order_id"           => $_POST['order_id'],
      "product_id"         => $_POST['product_id'],
      "quantity"           => $_POST['quantity']
    ];

    $stmt = $connection->prepare("UPDATE orders_items SET 
            order_item_id = :order_item_id,
            order_id = :order_id, 
            product_id = :product_id,
            quantity = :quantity
            WHERE order_item_id = :order_item_id");
             
    $stmt->execute([
            ':order_item_id' => filter_input(INPUT_POST, 'order_item_id', FILTER_SANITIZE_NUMBER_INT), 
            ':order_id' => filter_input(INPUT_POST, 'order_id', FILTER_SANITIZE_NUMBER_INT), 
            ':product_id' => filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT),
            ':quantity' => filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT)
            ]); 
            
  } catch(PDOException $error) {
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);
      echo $result . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['order_item_id'])) {
  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['order_item_id'];

    $sql = "SELECT * FROM orders_items WHERE order_item_id = :order_item_id";
    // $sql = "SELECT oi.order_item_id,o.order_id, o.order_name, o.order_email, oi.product_id, oi.quantity, o.order_date FROM orders as o 
    // JOIN orders_items as oi ON o.order_id=oi.order_id WHERE oi.order_item_id = :order_item_id";
    
    $statement = $connection->prepare($sql);
    $statement->bindParam(':order_item_id', $id, PDO::PARAM_STR);
    $statement->execute();

    $order = $statement->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($order);
    // echo "</pre>";
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
  echo "Something went wrong!";
  exit;
}
?>

<?php require "../templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['order_item_id']); ?> successfully updated.</blockquote>
<?php endif; ?>

<h2>Edit order</h2>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($order as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'order_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?> <br>
    <input class="submit" type="submit" name="submit" value="Submit">
</form>

<a href="index.php?action=emptyall" class="btn btn-primary" role="button">Go back to home page</a><br>
<a href="update_order.php" class="btn btn-info" role="button">Back to update</a><br>


<?php require "../templates/footer.php"; ?>
