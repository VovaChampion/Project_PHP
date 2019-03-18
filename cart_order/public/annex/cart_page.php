<?php
$date = date('Y-m-d');

$stmt = $db->prepare("INSERT INTO orders 
    ('order_date','order_name','order_email')
    VALUES
    (:order_date, :order_name, :order_email);");
$stmt->execute([
    ':order_date'  => $date, 
    ':order_name'  => $name,
    ':order_email' => $email
]);
$id = $db->lastInsertId(); 

$cart = [];

foreach ($cart as $cartitem) {

    $stmt = $db->prepare("INSERT INTO orders_items
        ('order_id','product_id','quantity')
        VALUES
        (:order_id, :product_id, :quantity);");
    $stmt->execute([
        ':order_id' => $id,
        ':product_id' => $cartitem['product_id'],
        ':quantity' => $cartitem['quantity']
    ]);
}
?>