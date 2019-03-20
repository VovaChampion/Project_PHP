<?php


// including the database connection file
include_once("config.php");
 
if(isset($_POST['update']))
{    
  

    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productLine = $_POST['productLine'];
    $productScale = $_POST['productScale'];
    $productVendor = $_POST['productVendor'];
    $productDescription = $_POST['productDescription'];
    $quantityInStock = $_POST['quantityInStock'];
    $buyPrice = $_POST['buyPrice'];
    $msrp = $_POST['msrp'];

    
    
   /* 
    // checking empty fields
    if(empty($name) || empty($age) || empty($email)) {            
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($age)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
        
        if(empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }
                
    } else { 
        
        */

        /*
        //updating the table
        $result = $pdo->query("UPDATE products SET productCode ='$productCode', productName='$productName', productLine='$productLine', productScale='$productScale', productVendor='$productVendor',
        productDescription='$productDescription', quantityInStock='$quantityInStock', buyPrice='$buyPrice', MSRP='$msrp' WHERE productCode=$productCode");
        */

        $result = $pdo->prepare("UPDATE classicmodels.products SET
        productName=:productName, productLine=:productLine, productScale=:productScale, productVendor=:productVendor,
        productDescription=:productDescription, quantityInStock=:quantityInStock, buyPrice=:buyPrice, MSRP=:MSRP WHERE productCode=:productCode;");

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
        //redirectig to the display page. In our case, it is index.php
        header("Location: index.php");
    
}
?>
<?php
//getting id from url
$productCode = $_GET['productCode'];
 


$result = $pdo->prepare("SELECT * FROM classicmodels.products WHERE productCode=:productCode");
//$result = $pdo->prepare($sql);
$result->execute([':productCode' => $productCode]);


$res = $result->fetchAll(PDO::FETCH_ASSOC);

 //$res = $res[];

 

foreach($res as $row)
{    

   // $productCode = $res['productCode'];
   $productName = $row['productName'];
    $productLine = $row['productLine'];
    $productScale = $row['productScale'];
    $productVendor = $row['productVendor'];
    $productDescription = $row['productDescription'];
    $quantityInStock = $row['quantityInStock'];
    $buyPrice = $row['buyPrice'];
    $msrp = $row['MSRP'];
}


?>
<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>
    <a href="index.php">Home</a>
    <br/><br/>
    
    <form name="form1" method="post" action="edit.php">
        <table border="0">
        <tr>
                <td>Product Code</td>
                <td><input type="text" name="productCode" value="<?php echo $productCode;?>"></td>
            </tr> 
            <tr>
                <td>Product Name</td>
                <td><input type="text" name="productName" value="<?php echo $row['productName'];?>"></td>
            </tr>
            <tr>
                <td>Product Line</td>
                <td><input type="text" name="productLine" value="<?php echo $row['productLine'];?>"></td>
            </tr>
            <tr>
                <td>Product Scale</td>
                <td><input type="text" name="productScale" value="<?php echo $row['productScale'];?>"></td>
            </tr>
            <tr>
                <td>Product Vendor</td>
                <td><input type="text" name="productVendor" value="<?php echo $row['productVendor'];?>"></td>
            </tr>
            <tr>
                <td>Product Description</td>
                <td><input type="text" name="productDescription" value="<?php echo $row['productDescription'];?>"></td>
            </tr>
            <tr>
                <td>Quantity in Stock</td>
                <td><input type="number" name="quantityInStock" value="<?php echo $row['quantityInStock'];?>"></td>
            </tr>
            <tr>
                <td>Buy Price</td>
                <td><input type="text" name="buyPrice" value="<?php echo $row['buyPrice'];?>"></td>
            </tr>
            <tr>
                <td>MSRP</td>
                <td><input type="text" name="msrp" value="<?php echo $row['MSRP'];?>"></td>
            </tr>

            <tr>
                <td><input type="hidden" name="productCode" value=<?php echo $_GET['productCode'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>

