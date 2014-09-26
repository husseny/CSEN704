<!-- Author: Ahmed -->
<?php
@session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Models/products.php");
include_once("$root/eshop/Models/reviews.php");

$products = products::get_instance();
$reviews = reviews::get_instance();
if (isset($_POST['review'])){
	review_action();
}

function get_product_info($product_id){
	global $products;
	$columns = "*";
	$product_info = $products->get_info($product_id, $columns);
	return $product_info;
}

<<<<<<< HEAD
function get_products_by_category($category){
	global $products;
	$params = "category = \"$category\"";
	$products_by_category = $products->get_products_by($params);
	return $products_by_category;
}
=======
function get_reviews($product_id){
	global $reviews;
	$columns = "*";
	$reviews = $reviews->get_reviews_by("product_id = ".$product_id);
	return $reviews;
}

function review_action(){
	global $products;
	global $reviews;
	$user_id = $_SESSION['user_id'];
	$product_id = $_POST['product_id'];
	$rate = $_POST['rate'];
	$comment = $_POST['comment'];
	$reviews->add($user_id, $product_id, $rate, $comment);
	$products->update_average_rating($product_id);
	$new_path = "http://localhost/eshop/Views/product.php?product_id=".$product_id;
	echo "<script> location.replace('$new_path'); </script>";

}

>>>>>>> fd342b9d45daf6a9ef5d828a043e615c8497a4c1
?>