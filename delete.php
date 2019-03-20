
<?php

//including the database connection file
include("config.php");
 
//getting id of the data from url
$productCode = $_GET['productCode'];
 
//deleting the row from table
$sql = "DELETE FROM products WHERE productCode=:productCode";
$result = $pdo->prepare($sql);
$result->execute(['productCode' => $productCode]);


// $result = $pdo->query("DELETE FROM subscribe WHERE id=$id");
 
//redirecting to the display page (index.php in our case)
header("Location:index.php");

?>
