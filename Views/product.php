<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Controllers/product_controller.php");
include_once("$root/eshop/Views/__head.php");
$product_id = $_GET['product_id'];

$product_info = get_product_info($product_id, "*");
?>

<div class="container">
	<b>Hello! :D</b>
	<h1><b><?php echo $product_info->title; ?></b></h1>
	<img <?php echo "src=\"/eShop/Assets/images/product".$product_id.".jpg\""; ?>>
	<h3>Rating: <?php echo $product_info->average_rating; ?></h3>
	<h3 style="color:red"><?php echo $product_info->stock == 0 ? "Out of stock :(":""; ?></h3>
	<h3>Price: $<?php echo $product_info->price; ?></h3>
	<h3>Discount: <?php echo $product_info->discount; ?>%</h3>
	<p><?php echo $product_info->description; ?></p>

</div>

<?php include_once("$root/eshop/Views/__foot.php");
?>