<?php 
include_once("base.php");

class carts extends base {

	protected function __construct(){
		parent::__construct();
	}

	function add_product($user_id,$product_id,$quantity){
		$query = "SELECT id FROM carts where user_id = $user_id AND completed = 0 LIMIT 0";
		$exec = $this->pdo->prepare($query);
		//$exec->execute(array($id));
		$cart = $exec->fetch(PDO::FETCH_OBJ);

		$query = "INSERT INTO carts_products (cart_id,product_id) VALUES ($cart,$product_id)";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart,$product_id));
		refresh_total_price($cart_id);
		return $is_successful; 

	}

	function delete_product($cart_id,$product_id){
		$query = "DELETE FROM carts_products where cart_id = $cart_id AND product_id = $product_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id, $product_id));
		return $is_successful;
	}
	
	function set_complete($cart_id){
		$query = "UPDATE carts completed = 1 where id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id));
		return $is_successful;	
	}

	function change_product_quantity($cart_id, $product_id, $quantity){
		$query = "UPDATE carts_products quantity = $quantity where cart_id = $cart_id AND product_id = $product_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id, $product_id));
		return $is_successful;
	}

	function get_info($cart_id){
		
	}

	function clear_products($cart_id){
		$query = "DELETE FROM carts_products where cart_id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id));
		return $is_successful;
	}

	function refresh_total_price($cart_id){
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