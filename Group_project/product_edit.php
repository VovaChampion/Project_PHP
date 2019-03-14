<?php

require "database.php";
// require "incl/database.php";

//Check if any specific product is set, take a standard product otherwise
if(isset($_GET['product'])){
    $product_no = filter_input(INPUT_GET,'product', FILTER_SANITIZE_ENCODED);
} else {
    $product_no = 'S12_1099';
}

if (isset($_POST['action'])){
    //Check if the user sent a picture
    $target_dir = 'images/';
    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);

    $uploadOk = true;

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    $uploadOk = ($check !== false);

    // // Check if the file exists
    // if(file_exists($target_file)){
    //     echo "Unfortunately, the file already exists.";
    //     $uploadOk = false;
    // }

    // // Check how big the file is
    // if($_FILES["productImage"]["size"] > 500000){
    //     echo "The file is too big<br>";
    //     $uploadOk = false;
    // }

    // Only allow certain file types 
    if($imageFileType != 'jpg' &&
            $imageFileType != 'png' &&
            $imageFileType != 'jpeg' &&
            $imageFileType != 'gif') {
        echo "We allow only pictures files<br>";
        $uploadOk = false;
    }
    // if the image is ok, we can move it to our folder "Images"
    if($uploadOk) {
        if(move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
            //echo "The file " . basename($_FILES["productImage"]["name"]) . " has been uploaded.";
            $productImage = $target_file;
        } else {
            $productImage = '';
        }
    }

    $stmt = $pdo->prepare("UPDATE classicmodels.products SET
            productName = :productName,
            productDescription = :productDescription,
            productLine = :productLine,
            buyPrice = :buyPrice,
            productImage = :productImage
        WHERE productCode = :productCode;");

    $stmt->execute([
        ':productName' => filter_input(INPUT_POST,'productName', FILTER_SANITIZE_STRING),
        ':productDescription' => filter_input(INPUT_POST,'productDescription', FILTER_SANITIZE_STRING),
        ':productLine' => filter_input(INPUT_POST,'productLine', FILTER_SANITIZE_STRING),
        ':buyPrice' => filter_input(INPUT_POST,'buyPrice', FILTER_SANITIZE_STRING),
        ':productImage' => $productImage,
        ':productCode' => filter_input(INPUT_POST,'productCode', FILTER_SANITIZE_STRING),
    ]);

    echo "Saved!";

}

//Pick up info for the chosen product
$stmt = $pdo->prepare("SELECT * FROM classicmodels.products WHERE productCode = :product_code;");

//Change :product_code to the product's code that we chose above  and run the question
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
    <form method="POST" enctype="multipart/form-data">
        <h1>Edit product</h1>
        <table>
            <tr>
                <th>Product name</th>
                <td><input type="text" name="productName" value="<?php echo $product['productName']?>"></td>
            </tr>
            <tr>
                <th>Product description</th>
                <td><textarea name="productDescription"><?php echo $product['productDescription'];?></textarea></td>
            </tr>
            <tr>
                <th>Product line</th>
                <td><input type="text" name="productLine" value="<?php echo $product['productLine']?>"></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><input type="text" name="buyPrice" value="<?php echo $product['buyPrice']?>"></td>
            </tr>
            <tr>
                <th>Image</th>
                <td>
                    <?php if(!empty($product['productImage'])):?>
                        <img src="<?php echo $product['productImage']; ?>"><br>
                        Replace with new image:
                    <?php else: ?>
                        Upload an image:
                    <?php endif; ?>
                    <input type="file" name="productImage">
                </td>
            </tr>
        </table>
        <input type="hidden" name="productCode" value="<?php echo $product['productCode'];?>">
        <input type="submit" name="action" value="Save" onclick="return confirm('Are you sure you want to make changes?');">
        <button class="back"><a href="product.php">Back</a></button>
    </form>
    
</body>
</html>