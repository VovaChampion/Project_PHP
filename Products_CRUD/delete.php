
<?php

//include database connection
include "config.php";
 
//getting product code from product list
$productCode = $_GET['productCode'];
 
//deleting the row from products table
$sql = "DELETE FROM products WHERE productCode=:productCode";
$result = $pdo->prepare($sql);
$result->execute(['productCode' => $productCode]);
 
//redirecting to the product list
header("Location:index.php");

?>
