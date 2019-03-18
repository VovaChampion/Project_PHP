<?php
//including database connection
include "config.php";
 
$result = $pdo->query("SELECT * FROM products ORDER BY productCode DESC"); 
?>

 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HOme Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            margin: 20px;
        }
    </style>
<body>
    
    <a href="add.html" class="badge badge-primary" style="padding:9px">Add New Product</a> <br/><br/>
 
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">ProductName</th>
            <th scope="col">ProductLine</th>
            <th scope="col">ProductScale</th>
            <th scope="col">ProductVendor</th>
            <th scope="col">ProductDescription</th>
            <th scope="col">Quantity in Stock</th>
            <th scope="col">Buy Price</th>
            <th scope="col">MSRP</th>
            <th scope="col">Update</th>
        </tr>
</thead>
<tbody>
        <?php 
        
        while($res = $result->fetch(PDO::FETCH_ASSOC)){         
            echo "<tr>";
            echo "<td>".$res['productName']."</td>";
            echo "<td>".$res['productLine']."</td>";
            echo "<td>".$res['productScale']."</td>";
            echo "<td>".$res['productVendor']."</td>";
            echo "<td>".$res['productDescription']."</td>"; 
            echo "<td>".$res['quantityInStock']."</td>"; 
            echo "<td>".$res['buyPrice']."</td>"; 
            echo "<td>".$res['MSRP']."</td>"; 
            echo "<td><a href=\"edit.php?productCode=$res[productCode]\">Edit</a> | <a href=\"delete.php?productCode=$res[productCode]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";        
        }
        ?>
        </tbody>
    </table>
</body>
</html>