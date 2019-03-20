<?php

require "annex/config.php";
require "annex/common.php";

$total=0;

$conn = new PDO($dsn, $username, $password, $options);
// $conn = new PDO("mysql:host=localhost;dbname=cart_order", 'root', '');			
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//get action string
$action = isset($_GET['action'])?$_GET['action']:"";
//Add to cart
if(isset($_POST['add_to_cart'])) {
	$product_id = $_POST['product_id'];
	//Finding the product by code
	$query = "SELECT * FROM products WHERE product_id =:product_id";
	$stmt = $conn->prepare($query);
	$stmt->bindParam('product_id', $product_id);
	$stmt->execute();
	$product = $stmt->fetch();

	// echo "<pre>";
	// print_r($product);

	$quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
	if (isset($_SESSION['products'][$product_id]['quantity'])) {
		$quantity += $_SESSION['products'][$product_id]['quantity']; //Incrementing the product quantity in cart
	}

	$_SESSION['products'][$product_id] = array(
		'quantity'      => $quantity,
		'product_name'  => $product['product_name'],
		'product_image' => $product['product_image'],
		'product_price' => $product['product_price']
	);

 //header("Location:index.php");
}
//Empty All
if($action=='emptyall') {
	$_SESSION['products'] =array();
	header("Location:index.php");	
}
//Empty one by one
if($action=='empty') {
	$product_id = $_GET['product_id'];
	$products = $_SESSION['products'];
	unset($products[$product_id]);
	$_SESSION['products']= $products;
	header("Location:index.php");	
}
 
 //Get all Products
	$query = "SELECT * FROM products";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$products = $stmt->fetchAll();
	
if(isset($_POST['create_order'])) {
	//echo 'User wants to create order<br>';
	$user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_MAGIC_QUOTES);
	$user_email= filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL);

	$date = date('Y-m-d h:i:sa');

		$stmt = $conn->prepare("INSERT INTO orders 
			(order_date, order_name, order_email)
			VALUES
			(:order_date, :order_name, :order_email);");
		$stmt->execute([
			':order_date'  => $date, 
			':order_name'  => $user_name,
			':order_email' => $user_email
		]);
		
		$id = $conn->lastInsertId(); 

		foreach ($_SESSION['products'] as $key => $cartitem) {

			$stmt = $conn->prepare("INSERT INTO orders_items
				(order_id, product_id, quantity)
				VALUES
				(:order_id, :product_id, :quantity);");
			$stmt->execute([
				':order_id' => $id,
				':product_id' => $key,
				':quantity' => $cartitem['quantity']
			]);
		} header("Location:confirm_order.php");
}
?>

<?php include "../templates/header.php"; ?>

<!-- Pictures for home page  -->
<div class="container">

<div id="promotion" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#promotion" data-slide-to="0" class="active"></li>
    <li data-target="#promotion" data-slide-to="1"></li>
    <li data-target="#promotion" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../images/GoPro.jpg" alt="GoPro" width="1000" height="400">
      <div class="carousel-caption">
				<h2>Go Pro Hero 7</h2>
				<h3>Only 3 199 SEK! Sales in April!</h3>
        <p>Get ready for an unforgettable summer right now with GoPro Hero 7</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="../images/iPad_sea.jpg" alt="IpadPro" width="1000" height="400">
      <div class="carousel-caption">
				<h2>Apple iPad</h2>
				<h3>Only 9 999 SEK! Sales in April!</h3>
        <p>Get ready for an unforgettable summer right now with Apple iPad</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="../images/JBL_wireless.jpg" alt="JBL_Wireless_Headphones" width="1000" height="400">
      <div class="carousel-caption">
        <h2>JBL E55BT Bluetooth-headset</h2>
				<h3>Only 1 199 SEK! Sales in April!</h3>
        <p>Get ready for an unforgettable summer right now with JBL E55BT Bluetooth-headset</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#promotion" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#promotion" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

<!-- Pictures for home page  -->

<!-- Cart -->

  <?php if(!empty($_SESSION['products'])):?>
  <nav class="navbar navbar-inverse" style="background:darkblue;">
    <div class="container-fluid pull-left" style="width:300px;">
      <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Shopping Cart</a> </div>
    </div>
    <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="index.php?action=emptyall" class="btn btn-warning">Empty cart</a></div>
  </nav>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Actions</th>
      </tr>
    </thead>
    <?php foreach($_SESSION['products'] as $key=>$product):?>
    <tr>
      <td><img src="../<?php echo $product['product_image']?>" width="50"></td>
      <td><?php echo $product['product_name']?></td>
      <td>SEK&nbsp;<?php echo $product['product_price']?></td>
	  <td><?php echo $product['quantity']?></td>
      <td><a href="index.php?action=empty&product_id=<?php echo $key?>" class="btn btn-warning">Delete</a></td>
    </tr>
	<?php $total = $total+$product['product_price']*$product['quantity'];?>
	<?php //echo $total;?>
    <?php endforeach;?>
    <tr><td colspan="5"><h4>Total:SEK&nbsp;<?php echo $total?></h4></td></tr>
  </table>
  <button class="btn btn-primary" onclick="formToggle('my_form');">CheckOut</button><br>
	<?php endif;?>

	
  <!-- Check out -->
  <!-- <form id="my_form" method="post" action="confirm_order.php"> -->
    <form id="my_form" method="post"><br>
			<div class="input-group mb-3">
				<input type="text" name="user_name" placeholder="Your Name" required><br>
				<div class="input-group-prepend">
					<span class="input-group-text">Example</span>
				</div>
				</div>
				<div class="input-group mb-3">
					<input type="email" name="user_email" placeholder="Your Email" required>
					<div class="input-group-append">
						<span class="input-group-text">@example.com</span>
					</div>
				</div>
		<button class="btn btn-success" name="create_order" value="Submit">Submit</button>
		<!-- <input type="submit" name="create_order" value="Submit">       -->
    </form>
 
<!-- Check out -->

<!-- products   -->
<h2>Products:</h2>
    <div id="product-grid">
        <?php foreach ($products as $product) : ?>
        <div class="products">
            <form method="post">
                <div class="product-image"><img src="../<?php echo $product["product_image"]; ?>"></div>
                <div class="product-title"><?php echo $product["product_name"]; ?></div>
                <div class="product-description"><?php echo $product["product_description"]; ?></div>
                <div class="product-price"><?php echo "SEK " . $product["product_price"]; ?></div>
				<!-- <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /></div> -->
				<div class="cart-action"><input type="number" class="product-quantity" name="quantity" value="1" min="1" max="100"/></div>
				<!-- <input type="submit" name="add_to_cart" class="btnAddAction" value="Add To Cart" onclick="promHide('promotion');"> -->
				<input type="submit" name="add_to_cart" class="btnAddAction" value="Add To Cart" onclick="location.href='#product-grid';">

				
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']?>">
            </form>
        </div>
        <?php endforeach; ?>
	</div>
	
<a href="read_order.php" class="btn btn-info" role="button">Read -> Order</a><br>
<a href="update_order.php" class="btn btn-info" role="button">Update -> Order</a><br>	
<a href="delete_order.php" class="btn btn-info" role="button">Delete -> Order</a><br>
<a href="delete_order_item.php" class="btn btn-info" role="button">Delete -> Order Item</a><br>
</div>

<?php include "../templates/footer.php"; ?>