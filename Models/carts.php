<?php 
include_once("base.php");

class carts extends base {

	protected function __construct(){
		parent::__construct();
	}

	function get_last_cart($user_id)
	{
		$query = "SELECT * FROM carts where user_id = $user_id AND completed = 0 LIMIT 1";
		$exec = $this->pdo->prepare($query);
		$exec->execute();
		$cart = $exec->fetch(PDO::FETCH_OBJ);
		return $cart;
	}

	function add_product($user_id, $product_id, $quantity){
		$cart = $this->get_last_cart($user_id);
		// check if there is no cart
		if(!$cart){
			$query = "INSERT INTO carts (user_id) VALUES ($user_id)";
			$stmt = $this->pdo->prepare($query);
			$stmt->execute();
		}
		$cart_id = $this->get_last_cart($user_id)->id;
		// check if this item was added before to this cart, and increment quantity if so.
		$query = "SELECT * FROM carts_products where cart_id = $cart_id AND product_id = $product_id";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		$product_in_cart = $stmt->fetch(PDO::FETCH_OBJ);
		if ($product_in_cart){
			// increment quantity
			$query = "UPDATE carts_products SET quantity=$product_in_cart->quantity+$quantity
			 WHERE cart_id = $cart_id";
		}else {
			//get product price and create a new entry
			$query = "SELECT price , discount FROM products WHERE id = $product_id";
			$stmt = $this->pdo->prepare($query);
			$stmt->execute();
			$product = $stmt->fetch(PDO::FETCH_OBJ);
			$product_price = $product->price - ($product->price * $product->discount/100);
			$query = "INSERT INTO carts_products (cart_id ,product_id, quantity, price) VALUES ($cart_id ,$product_id, $quantity, $product_price)";
		}
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute();
		$this->refresh_total_price($cart_id);
		return $is_successful; 
	}

	function delete_product($user_id,$product_id){
		$carts = carts::get_instance();
		$cart_id = $this->get_last_cart($user_id);
		$query = "DELETE FROM carts_products where cart_id = $cart_id AND product_id = $product_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id, $product_id));
		return $is_successful;
	}
	
	function set_complete($user_id){
		$carts = carts::get_instance();
		$cart_id = $this->get_last_cart($user_id);
		$query = "UPDATE carts completed = 1 where id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id));
		return $is_successful;	
	}

	function change_product_quantity($user_id, $product_id, $quantity){
		$carts = carts::get_instance();
		$cart_id = $this->get_last_cart($user_id);
		$query = "UPDATE carts_products quantity = $quantity where cart_id = $cart_id AND product_id = $product_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute(array($cart_id, $product_id));
		return $is_successful;
	}

	function get_info($user_id){
		$carts = carts::get_instance();
		$cart_id = $this->get_last_cart($user_id);
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
		$cart_id = $this->get_last_cart($user_id);
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
			$price = ($product->price - $product->price * $product->discount/100);
			echo $product->price;
			$total_price += $price * $product->quantity;
			echo $total_price;
		}
		$query = "UPDATE carts SET total_price = $total_price where id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute();
		return $is_successful;
	}
}

// $carts = carts::get_instance();

// $product_id = 8;
// $user_id = 1;
// $quantity = 5;

// var_dump($carts->add_product($user_id, $product_id, $quantity));

?>