<?php
@session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Models/products.php");

$products = products::get_instance();

function get_product_info($product_id){
	global $products;
	$columns = "*";
	$product_info = $products->get_info($product_id, $columns);
	return $product_info;
}

function get_products_by_category($category){
	global $products;
	$params = "category = \"$category\"";
	$products_by_category = $products->get_products_by($params);
	return $products_by_category;
}
?>