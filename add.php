<html>
<head>
    <title>Add Data</title>
</head>
 
<body>
<?php
//including the database connection file
include_once("config.php");
 
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
        
    // checking empty fields
  /*  if(empty($name) || empty($age) || empty($email)) {                
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($age)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
        
        if(empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }
       

        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 

        */
        // if all the fields are filled (not empty)             
        //insert data to database
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
        
        //display success message
        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='index.php'>View Result</a>";
    }

?>
</body>
</html>