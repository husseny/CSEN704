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
				<li class="active"><a href="#Electronics" role="tab" data-toggle="tab">Electronics</a></li>
				<li><a href="#Art" role="Art" data-toggle="tab">Art</a></li>
				<li><a href="#Games" role="Games" data-toggle="tab">Games</a></li>
				<li><a href="#Sport" role="Sport" data-toggle="tab">Sport</a></li>
			</ul>
		</div>
	</div>
	<div class="tab-content">
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
				echo "<div class='col-xs-4 well'>";
				echo "<div class='product_box'>";
				echo "<img src='Assets/images/product$product->image_link.jpg'></img>";
				echo "<h3><span class='pull-left'>" . $product->title . "</span><span class='pull-right'>$" . $product->price . "</span></h3>" ;
				echo "</div>";
				echo "</div>";
			}
			echo $category;
			echo "</div>";
			$counter++;
			}
		?>
	</div>
</div>