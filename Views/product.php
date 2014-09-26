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
	<h4>Rating: <?php 
			for($j = 1; $j <= 5 ; $j++){
			if ($j <= $product_info->average_rating){
				echo "<i class='fa fa-star fa-lg star'></i>";
			}else{
				echo "<i class='fa fa-star fa-lg star_dull'></i>";
			}
		}?></h4>
	<h4 style="color:red"><?php echo $product_info->stock == 0 ? "Out of stock :(":""; ?></h4>
	<h4>Price: $<?php echo $product_info->price; ?></h4>
	<h4>Discount: <?php echo $product_info->discount; ?>%</h4>
	<p><?php echo $product_info->description; ?></p>

	<?php if (isset($_SESSION['user_id'])){ ?>
		<form method="post" action="/eshop/Controllers/cart_controller.php\">
			<input type="submit" name="add_to_cart" value="Add to cart"></input>
			<input type="hidden" name="product_id" value=<?php echo "\"".$product_id."\""?>></input>
		</form>
	<?php }else{  ?>
		<button data-toggle="modal" data-target="#login_prompt">Add to cart</button>
	<?php } ?>

	<div class="modal fade" id="login_prompt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">You need to log in to perform this action</h4>
		  </div>
		  <div class="modal-body">
			<form name="login" method="post" action="/eshop/Controllers/user_controller.php">
				<input type="text" name="user_name"></input>
				<input type="password" name="password"></input>
				<input class="login btn btn-default" type="submit" name="login_submit" value="sign in"></input>
			</form>		
			<hr>
			<h4>Or create a new account</h4>
			<form name="register" method = "post" action = "/eshop/Controllers/user_controller.php" >
				<p>first name</p><input type="text" name="first_name"></input>
				<p>last name</p><input type="text" name="last_name"></input>
				<p>user name</p><input type="text" name="user_name"></input>
				<p>password</p><input type="password" name="password"></input>
				<input class="login btn btn-default" type="submit" name="register_submit" value="sign up">
			</form>
		  </div>
		</div>
	  </div>
	</div>
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
		echo "  Rating:";
		echo "  <input type=\"radio\" name=\"rate\" value=\"1\">1";
		echo "  <input type=\"radio\" name=\"rate\" value=\"2\">2";
		echo "  <input type=\"radio\" name=\"rate\" value=\"3\">3";
		echo "  <input type=\"radio\" name=\"rate\" value=\"4\">4";
		echo "  <input type=\"radio\" name=\"rate\" value=\"5\">5";
		echo "  <br><input type=\"text\" name=\"comment\"></input>";
		echo "  <input type=\"hidden\" name=\"product_id\" value=\"".$product_id."\"></input>";
		echo "  <input type=\"submit\" name=\"review\" value=\"submit\"></input>";
		echo "</form>";
	}
	?>



</div>

<?php include_once("$root/eshop/Views/__foot.php"); ?>