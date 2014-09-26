<?php
@session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Models/carts.php");
include_once("$root/eshop/Models/products.php");

$carts = carts::get_instance();

if(isset($_SESSION['user_id']))
$user_id = $_SESSION['user_id'];

function add_product_action($product_id, $quantity){
	if(isset($user_id))
		return $carts->add_product($user_id, $product_id, $quantity);
	return false;
}

function delete_product_action($product_id)
{
	if(isset($user_id))
		return $carts->delete_product($user_id, $product_id);
	return false;
}

function transaction_action()
{
	if(isset($user_id))
		return $carts->set_complete($user_id);
	return false;
}

function edit_product_quantity_action($product_id, $quantity)
{
	if(isset($user_id))
		return $carts->change_product_quantity($user_id, $product_id, $quantity);
	return false;
}

function get_info_action(){
	if(isset($user_id))
		return $carts->set_complete($user_id);
	return false;
}

function clear_cart_action(){
	if(isset($user_id))
		return $carts->clear_products($user_id);
	return false;
}

?>
