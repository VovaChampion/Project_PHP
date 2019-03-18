<?php

require "annex/config.php";
require "annex/common.php";

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT oi.order_item_id, o.order_id, o.order_name, o.order_email, oi.product_id, oi.quantity, o.order_date FROM orders as o 
  JOIN orders_items as oi ON o.order_id=oi.order_id";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "../templates/header.php"; ?>
        
<h2>Update order</h2>

<table>
    <thead>
        <tr>
            <th>Order Item Id</th>
            <th>Order Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Product Id</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Edit order</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["order_item_id"]); ?></td>
            <td><?php echo escape($row["order_id"]); ?></td>
            <td><?php echo escape($row["order_name"]); ?></td>
            <td><?php echo escape($row["order_email"]); ?></td>
            <td><?php echo escape($row["product_id"]); ?></td>
            <td><?php echo escape($row["quantity"]); ?></td>
            <td><?php echo escape($row["order_date"]); ?></td>
            <!-- <td><a href="update_single_order.php?order_id=<?php //echo escape($row["order_id"]); ?>" class="btn btn-warning" role="button">Edit</a></td> -->
            <td><a href="update_single_order.php?order_item_id=<?php echo escape($row["order_item_id"]); ?>" class="btn btn-warning" role="button">Edit</a></td>
            
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?action=emptyall" class="btn btn-primary" role="button">Go back to home page</a><br>
<a href="read_order.php" class="btn btn-info" role="button">Read -> Order</a><br>
<a href="delete_order.php" class="btn btn-info" role="button">Delete -> Order</a><br>

<?php require "../templates/footer.php"; ?>