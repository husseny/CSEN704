<!-- Author: Ahmed -->
<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Controllers/product_controller.php");
include_once("$root/eshop/Controllers/user_controller.php");
include_once("$root/eshop/Views/__head.php");
$product_id = $_GET['product_id'];

$product_info = get_product_info($product_id);
$reviews = get_reviews($product_id);
$out_of_stock = $product_info->stock == 0 ? true:false;

?>

<div class="container">
	<h1><b><?php echo $product_info->title; ?></b></h1>
	<img <?php echo "src=\"/eShop/Assets/images/product".$product_id.".jpg\""; ?>>
	<h4>Rating: <?php 
			for($j = 1; $j <= 5 ; $j++){
			if ($j <= $product_info->average_rating){
				echo "<i class='fa fa-star fa-lg star'></i>";
			}else{
				echo "<i class='fa fa-star fa-lg star_dull'></i>";
			}
		}?></h4>
	<h4 style="color:red"><?php echo ($out_of_stock)? "Out of stock :(":""; ?></h4>
	<h4>Price: $<?php echo $product_info->price; ?></h4>
	<h4>Discount: <?php echo $product_info->discount; ?>%</h4>
	<p><?php echo $product_info->description; ?></p>

<form method="post" action="/eshop/Controllers/cart_controller.php\">
	<input type="submit" <?php echo ($out_of_stock)? "disabled":""; ?> name="add_to_cart" value="Add to cart" class="btn btn-primary btn-lg"></input>
	<input type="hidden" name="product_id" value=<?php echo "\"".$product_id."\""?>></input>
</form>	

	<h3>Reviews:</h3>
	<?php
	foreach ($reviews as $review) {
		echo "<br><b>".get_username($review->user_id)."</b>";
		echo " - ". substr($review->time_added,0,10);
		$user_rating = $review->rate;;
		echo "<p>";
		for($j = 1; $j <= 5 ; $j++){
			if ($j <= $user_rating){
				echo "<i class='fa fa-star fa-lg star'></i>";
			}else{
				echo "<i class='fa fa-star fa-lg star_dull'></i>";
			}
		}
		echo "</p>";
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