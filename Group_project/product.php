<?php

require "database.php";
// require "incl/database.php";

if (isset($_GET['product'])){
    $product_no = filter_input(INPUT_GET, 'product', FILTER_SANITIZE_ENCODED);
} else {
    $product_no = 'S12_1099';
}

$stmt = $pdo->prepare("SELECT * FROM classicmodels.products WHERE productCode = :product_code;");

$stmt ->execute([
     ':product_code' => $product_no 
]);

$product = $stmt->fetchALL(PDO::FETCH_ASSOC);
$product = $product[0];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <h1><?php echo $product['productName']; ?> </h1>
    <div class="description">Description: <?php echo $product['productDescription'];?><br></div>
    <div class="productLine">Line: <?php echo $product['productLine'];?><br> </div>
    <div class="buyPrice">Price: <?php echo $product['buyPrice'];?><br> </div>
    <img src="<?php echo $product['productImage']; ?>"><br>
    <!-- <span class="edit"><a href="product_edit.php?edit=<?php //echo $row['id']; ?>">Redigera</a></span>  -->
    <button class="edit"><a href="product_edit.php">Edit</a></button>
    
</body>
</html>