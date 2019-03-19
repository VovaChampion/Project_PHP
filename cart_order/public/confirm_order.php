<?php 
include "../templates/header.php"; 
?>

<?php 

try {
    $conn = new PDO("mysql:host=localhost;dbname=cart_order", 'root', '');		
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $getOrderId = $conn->prepare("SELECT MAX(order_id) FROM orders");
    $getOrderId->execute();

    $orders_id  = $getOrderId->fetchColumn();
    //print_r($orders_id);
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>
<div class="container">
    <h1> Thank you for your order number: <?php echo $orders_id; ?></h1><br>
    <!-- <h3>If you want to chenge or delete your order go here
        <a href="read_order.php">Order page</a> 
        and use your order number
    <h3> -->

    <a href="index.php?action=emptyall" class="btn btn-primary" role="button">Go back to home page</a><br>
    <a href="read_order.php" class="btn btn-info" role="button">Read -> Order</a><br>
    <a href="update_order.php" class="btn btn-info" role="button">Update -> Order</a><br>	
    <a href="delete_order.php" class="btn btn-info" role="button">Delete -> Order</a><br>

</div>

<?php include "../templates/footer.php"; ?>
