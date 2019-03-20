<?php
//including the database connection file
include_once("config.php");
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = $pdo->query("SELECT * FROM products ORDER BY productCode DESC"); // using mysqli_query instead
?>
 
<html>
<head>    
    <title>Homepage</title>
</head>
 
<body>
    <a href="add.html">Add New Data</a><br/><br/>
 
    <table width='80%' border=0>
        <tr bgcolor='#CCCCCC'>
            <td>ProductName</td>
            <td>ProductLine</td>
            <td>ProductScale</td>
            <td>ProductVendor</td>
            <td>ProductDescription</td>
            <td>Quantity in Stock</td>
            <td>Buy Price</td>
            <td>MSRP</td>
            <td>Update</td>
        </tr>
        <?php 
        
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
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
    </table>
</body>
</html>