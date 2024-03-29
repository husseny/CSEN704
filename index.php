<!-- Author: Mohab -->
<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Views/__head.php");
include_once("$root/eshop/Controllers/product_controller.php");
?>
<div class="container">
	<div class="row">
		<div class="categories">
			<ul class="nav nav-tabs nav-pills" role="tablist">
				<li class="hidden active"><a href="#Electronics" role="tab" data-toggle="tab">Products</a></li>
			</ul>
		</div>
	</div>
	<div class="categories_content">
		<?php 
		$categories = ['Electronics', 'Art', 'Games', 'Sport'];
		$counter = 0;
		foreach($categories as $category){
			if ($counter == 0){
				echo "<div class='tab-pane fade in active' id=$category>";
			}else {
				echo "<div class='tab-pane fade' id=$category>";
			}
			$products_categorized = get_products_by_category($category);
			$products_count = count($products_categorized);
			$loop_counter = 0;
			foreach($products_categorized as $product) {
				echo "<div class='col-xs-4'>";
				echo "	<div class='product_box'>";
				echo "		<a href='Views/product.php?product_id=$product->id'>";
				echo "			<img class='img img-responsive' src='Assets/images/$product->image_link.jpg'></img>";
				echo "		</a>";
				echo "		<h3 class='row'><span class='pull-left'>";
				echo "		<a href='Views/product.php?product_id=$product->id'>";
				echo 			substr($product->title, 0, 55);
				echo "			</span>";
				echo "		</a>";
				echo "		</h3>" ;
				if (!$product->stock){
					echo "<p class='stock'>out of stock</p>";
				}							
				$price = $product->price;
				if ($product->discount){
					$old_price = $price;
					$price = $price - $price*$product->discount/100;
				}
				$user_reviews = $product->average_rating;
				for($j = 1; $j <= 5 ; $j++){
					if ($j <= $user_reviews){
						echo "<i class='fa fa-star fa-lg star'></i>";
					}else{
						echo "<i class='fa fa-star fa-lg star_dull'></i>";
					}
				}
				echo "		<h3 class='row'><span class='pull-left'>";
				echo (isset($old_price))?"<span class='pull-right striked'>$$old_price</span>":"";
				echo "			<span class='pull-right'>$". number_format($price, 2). " </span>";
				echo "		</h3>" ;
				echo "	</div>";
				echo "</div>";
			}
			echo "</div>";
			$counter++;
			}
		?>
	</div>
</div>