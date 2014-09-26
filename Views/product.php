<!-- Author: Ahmed -->
<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Controllers/product_controller.php");
include_once("$root/eshop/Controllers/user_controller.php");
include_once("$root/eshop/Views/__head.php");
$product_id = $_GET['product_id'];

$product_info = get_product_info($product_id);
$reviews = get_reviews($product_id)

?>

<div class="container">
	<h1><b><?php echo $product_info->title; ?></b></h1>
	<img <?php echo "src=\"/eShop/Assets/images/product".$product_id.".jpg\""; ?>>
	<h4>Rating: <?php echo $product_info->average_rating; ?></h4>
	<h4 style="color:red"><?php echo $product_info->stock == 0 ? "Out of stock :(":""; ?></h4>
	<h4>Price: $<?php echo $product_info->price; ?></h4>
	<h4>Discount: <?php echo $product_info->discount; ?>%</h4>
	<p><?php echo $product_info->description; ?></p>

	<h3>Reviews:</h3>
	<?php
	foreach ($reviews as $review) {
		echo "<br><b>".get_username($review->user_id)."</b>";
		echo " - ".$review->time_added;
		echo "<br>Rating: ".$review->rate;
		echo "<br><p>".$review->comment."</p>";
		echo "========";
	}
		
	?>

	<?php
	if (!user_has_reviewed_product($product_id)) {
		echo "<form method=\"post\" action=\"/eshop/Controllers/product_controller.php\">";
		echo "	Rating:";
	   	echo "	<input type=\"radio\" name=\"rate\" value=\"1\">1";
	   	echo "	<input type=\"radio\" name=\"rate\" value=\"2\">2";
	   	echo "	<input type=\"radio\" name=\"rate\" value=\"3\">3";
	   	echo "	<input type=\"radio\" name=\"rate\" value=\"4\">4";
	   	echo "	<input type=\"radio\" name=\"rate\" value=\"5\">5";
		echo "	<br><input type=\"text\" name=\"comment\"></input>";
		echo "	<input type=\"hidden\" name=\"product_id\" value=\"".$product_id."\"></input>";
		echo "	<input type=\"submit\" name=\"review\" value=\"submit\"></input>";
		echo "</form>";
	}
	?>

</div>

<?php include_once("$root/eshop/Views/__foot.php"); ?>