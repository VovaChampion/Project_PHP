<?php
//Include database connection file
include "config.php";
 
if(isset($_POST['Submit'])) {    
    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productLine = $_POST['productLine'];
    $productScale = $_POST['productScale'];
    $productVendor = $_POST['productVendor'];
    $productDescription = $_POST['productDescription'];
    $quantityInStock = $_POST['quantityInStock'];
    $buyPrice = $_POST['buyPrice'];
    $msrp = $_POST['msrp'];
        
                
        //insert product data to database
        $result = $pdo->prepare("INSERT INTO products (productCode, productName, productLine, productScale, productVendor,
        productDescription, quantityInStock, buyPrice, MSRP) 
        VALUES(:productCode, :productName, :productLine, :productScale, :productVendor,
        :productDescription, :quantityInStock, :buyPrice, :MSRP)");

        $result->execute([
            ':productCode' => $productCode,
            ':productName' => $productName,
            ':productLine' => $productLine,
            ':productScale' => $productScale,
            ':productVendor' => $productVendor,
            ':productDescription' => $productDescription,
            ':quantityInStock' => $quantityInStock,
            ':buyPrice' => $buyPrice,
            ':MSRP' => $msrp
        ]);
        
        echo "<font color='green'>Product added successfully.";
        echo "<br/><a href='index.php'>View Products</a>";
    }

?>