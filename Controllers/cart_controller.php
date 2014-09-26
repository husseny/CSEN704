<?php
@session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Models/carts.php");
include_once("$root/eshop/Models/products.php");

$carts = carts::get_instance();
$cart_id = $carts->get_last_cart(1)->id;


 if(isset($_SESSION['user_id']))
	$user_id = $_SESSION['user_id'];
//echo $user_id;

function edit_cart_action($product_id, $quantity){
	//
	global $user_id;
	global $carts;
	if(isset($user_id))
		return $carts->edit_cart_items($user_id, $product_id, $quantity);
	return 0;
	
}

function delete_product_action($product_id)
{
	global $user_id;
	global $carts;
	if(isset($user_id))
		return $carts->delete_product($user_id, $product_id);
	return 0;
}

function transaction_action()
{
	global $user_id;
	global $carts;
	if(isset($user_id))
		return $carts->set_complete($user_id);
	return 0;
}

function get_open_cart_action(){
	global $user_id;
	global $carts;
	if(isset($user_id))
	{
		$cart = $carts->get_last_cart($user_id);
		if($cart)
		{
			$cart_id = $cart->id;
			$products = $carts->get_products($cart_id);
			$result = array('cart' => $cart,'products'=>$products);
			return $result;
		}
		else
			return 0;
	}
	return 0;
}

function get_transactions_action(){
	global $user_id;
	global $carts;
	if(isset($user_id))
	{
		$carts_list = $carts->get_transactions($user_id);
		//var_dump($carts);
		if($carts_list)
		{
			$results = array();
			foreach ($carts_list as $cart) {
				$cart_id = $cart->id;
				
				$products = $carts->get_products($cart_id);
				
				$result = array('cart' => $cart,'products'=>$products);
				
				$results[] = $result;
			}
			return $results;
		}	
		return 0;
	}
	return 0;
}

function clear_cart_action(){
	global $user_id;
	global $carts;
	if(isset($user_id))
		return $carts->clear_products($user_id);
	return 0;
}

//TESTING CODE:
$r = edit_cart_action(4,3);
//$r = delete_product_action(4);
//echo "string";
//$r = transaction_action();
//var_dump($r);
//$r = get_open_cart_action();
//echo $r->id;
// $ar = [1,1,1,1];
// $arr = [3,3,3,3];
// $result1 = array('cart' => "2",'products'=>$ar);
// $result2 = array('cart' => "3",'products'=>$ar);
// $result3 = array('cart' => "4",'products'=>$ar);
//$result = get_open_cart_action();
//$result = get_transactions_action();
//clear_cart_action();
//var_dump($result);
?>
