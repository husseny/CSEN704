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

	function get_transactions($user_id)
	{
		$carts = array();
		$query = "SELECT * FROM carts where user_id = $user_id AND completed = 1";
		$exec = $this->pdo->prepare($query);
		$exec->execute();
		while($cart = $exec->fetch(PDO::FETCH_OBJ)){
			$carts[] = $cart;
		}
		//echo count($carts);
		return $carts;
	}

	function edit_cart_items($user_id, $product_id, $quantity){
		$cart = $this->get_last_cart($user_id);
		// check if there is no cart
		if(!$cart){
			$query = "INSERT INTO carts (user_id) VALUES ($user_id)";
			$stmt = $this->pdo->prepare($query);
			$stmt->execute();
		}
		$cart_id = $this->get_last_cart($user_id)->id;
		//echo $cart_id;
		// check if this item was added before to this cart, and increment quantity if so.
		$query = "SELECT * FROM carts_products WHERE cart_id = $cart_id AND product_id = $product_id";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		$product_in_cart = $stmt->fetch(PDO::FETCH_OBJ);
		if ($product_in_cart){
			// increment quantity
			$quantity = $quantity;
			$query = "UPDATE carts_products SET quantity=$quantity
			 WHERE cart_id = $cart_id AND product_id = $product_id";
		}else {
			//get product price and create a new entry
			$query = "SELECT price , discount FROM products WHERE id = $product_id";
			$stmt = $this->pdo->prepare($query);
			$stmt->execute();
			$product = $stmt->fetch(PDO::FETCH_OBJ);
			$product_price = ($product->price - ($product->price * $product->discount/100));
			$query = "INSERT INTO carts_products (cart_id ,product_id, quantity, item_price) 
			VALUES ($cart_id ,$product_id, $quantity, $product_price)";
		}
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute();
		$this->refresh_total_price($cart_id);
		return $is_successful; 
	}

	function delete_product($user_id,$product_id){
		$cart_id = $this->get_last_cart($user_id)->id;
		$query = "DELETE FROM carts_products where cart_id = $cart_id AND product_id = $product_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute();
		$this->refresh_total_price($cart_id);
		return $is_successful;
	}
	
	function set_complete($user_id){
		$cart_id = $this->get_last_cart($user_id)->id;
		$query = "SELECT * From carts_products cp INNER JOIN products p ON cp.product_id = p.id 
		where cp.cart_id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$exec->execute();
		while($product = $exec->fetch(PDO::FETCH_OBJ)){
			$quantity_requested = $product->quantity;
			$quantity_in_stock = $product->stock;
			if ($quantity_in_stock > $quantity_requested){
				$new_stock = $quantity_in_stock - $quantity_requested;
				$query = "Update products SET stock = $new_stock WHERE id = $product->id";
				$stmt = $this->pdo->prepare($query);
				$stmt->execute();
			}else {
				return "Stock of product $product->title is not enough for the amount you requested";
			}
		}



		$query = "UPDATE carts SET completed = 1, transaction_time = NOW() where id = $cart_id AND total_price > 0";
		$exec = $this->pdo->prepare($query);
		$exec->execute();
		$is_successful = $exec->rowCount();
		return $is_successful;
	}

	function change_product_quantity($user_id, $product_id, $quantity){
		echo "1";
		$cart_id = $this->get_last_cart($user_id)->id;
		echo $cart_id;
		$query = "UPDATE carts_products SET quantity = $quantity 
		where cart_id = $cart_id AND product_id = $product_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute();
		echo $is_successful;
		$this->refresh_total_price($cart_id);
		return $is_successful;
	}

	function get_products($cart_id){
		$products = array();
		$query = "SELECT * FROM carts_products cp INNER JOIN products p ON cp.product_id=p.id 
		where cart_id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$exec->execute();
		while($product = $exec->fetch(PDO::FETCH_OBJ)){
			$products[] = $product;
		}
		//echo count($products);
		return $products;
	}


	function clear_products($user_id){
		$cart_id = $this->get_last_cart($user_id)->id;
		$query = "DELETE FROM carts_products where cart_id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute();
		$this->refresh_total_price($cart_id);
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
			$stock_price = $price * $product->quantity;
			$product_id = $product->id;
			//echo $product_id;
			
			//echo $product->price;
			$total_price += $price * $product->quantity;
			//echo $total_price;
		}
		$query = "UPDATE carts SET total_price = $total_price where id = $cart_id";
		$exec = $this->pdo->prepare($query);
		$is_successful = $exec->execute();
		return $is_successful;
	}
}

$carts = carts::get_instance();
// $carts->clear_products(1);

// $user_id = 1;
// $result = $carts->set_complete($user_id);
// if (gettype($result) == "string"){
// 	$_SESSION['cart_error'] = $result;
// 	$new_path = "/eshop/Views/cart.php";
// 	echo "<script> location.replace('$new_path'); </script>";
// }else {
// 	return $result;
// }
?>