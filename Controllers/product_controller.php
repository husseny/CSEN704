<!-- Author: Ahmed -->
<?php
@session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Models/products.php");
include_once("$root/eshop/Models/reviews.php");

$products = products::get_instance();
$reviews = reviews::get_instance();

function get_product_info($product_id){
	global $products;
	$columns = "*";
	$product_info = $products->get_info($product_id, $columns);
	return $product_info;
}

function get_reviews($product_id){
	global $reviews;
	$columns = "*";
	$reviews = $reviews->get_reviews_by("product_id = ".$product_id);
	return $reviews;
}

?>