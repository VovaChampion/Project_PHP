<?php
include "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Search Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>


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
$keyword = $_GET['keyword'];
$sql= "SELECT * FROM products WHERE productName LIKE :keyword OR productDescription LIKE :keyword";
$stmt=$pdo->prepare($sql);
$stmt->bindValue(':keyword','%'.$keyword.'%');
$stmt->execute();

while($res = $stmt->fetch(PDO::FETCH_ASSOC)){   
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
