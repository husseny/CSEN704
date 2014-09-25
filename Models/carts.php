<?php 
include_once("base.php");

class carts extends base {

	protected function __construct(){
		parent::__construct();
	}

	function get_last_cart($user_id)
	{
		$query = "SELECT id FROM carts where user_id = $user_id AND completed = 0 LIMIT 0";
		$exec = $this->pdo->prepare($query);
		//$exec->execute(array($id));
		return $exec->fetch(PDO::FETCH_OBJ);
	}

	function add_product($user_id,$product_id,$quantity){
		$carts = carts::get_instance();
		$cart_id = carts->get_last_cart($user_id);
		$query = "INSERT INTO carts_products (cart_id,product_id) VALUES ($cart,$product_id)";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart,$product_id));
		refresh_total_price($cart_id);
		return $is_successful; 

	}

	function delete_product($user_id,$product_id){
		$carts = carts::get_instance();
		$cart_id = carts->get_last_cart($user_id);
		$query = "DELETE FROM carts_products where cart_id = $cart_id AND product_id = $product_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id, $product_id));
		return $is_successful;
	}
	
	function set_complete($user_id){
		$carts = carts::get_instance();
		$cart_id = carts->get_last_cart($user_id);
		$query = "UPDATE carts completed = 1 where id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id));
		return $is_successful;	
	}

	function change_product_quantity($user_id, $product_id, $quantity){
		$carts = carts::get_instance();
		$cart_id = carts->get_last_cart($user_id);
		$query = "UPDATE carts_products quantity = $quantity where cart_id = $cart_id AND product_id = $product_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id, $product_id));
		return $is_successful;
	}

	function get_info($user_id){
		$carts = carts::get_instance();
		$cart_id = carts->get_last_cart($user_id);
		$products_ids = array();
		$query = "SELECT product_id FROM carts_products where cart_id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$exec->execute();
		while($product = $exec->fetch(PDO::FETCH_OBJ)){
			$products_ids[] = $product;
		}
		return $products_ids;

		
	}

	function clear_products($user_id){
		$carts = carts::get_instance();
		$cart_id = carts->get_last_cart($user_id);
		$query = "DELETE FROM carts_products where cart_id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id));
		return $is_successful;
	}

	function refresh_total_price($user_id){
		$carts = carts::get_instance();
		$cart_id = carts->get_last_cart($user_id);
		$total_price = 0;
		$query = "SELECT * From carts_products cp INNER JOIN products p ON cp.product_id = p.id 
		where cp.cart_id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$exec->execute();
		while($product = $exec->fetch(PDO::FETCH_OBJ)){
			$price = $product['price']*($product['discount']/100);
			$total_price += $price;
		}
		$query = "UPDATE carts price = $total_price where id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id));
		return $is_successful;
	}
} 
?>