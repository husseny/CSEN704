<!-- Author: Ahmed -->
<?php 
include_once("base.php");

class products extends base {

	protected function __construct(){
		parent::__construct();
	}

	function get_products_by($params){
		$products = array();
		$query = "SELECT * FROM products WHERE $params";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		while($product = $stmt->fetch(PDO::FETCH_OBJ)){
			$products[] = $product;
		}
		return $products;
	}

	function get_info($product_id, $columns){
		$query = "SELECT $columns from products where id = $product_id";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function update_average_rating($product_id){
		$sum = 0;
		$reviews = 0;
		$query = "SELECT rate From products p INNER JOIN reviews r ON p.id = r.product_id 
		where p.id = $product_id";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		while($review = $stmt->fetch(PDO::FETCH_OBJ)){
			$reviews++;
			$sum += $review->rate;
		}
		if ($reviews>0) {
			$avg = $sum/$reviews;
		} else {
			$avg = -1;
		}
		$query = "UPDATE products SET average_rating = $avg WHERE id = $product_id";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
	}
}

// # Tests
// $products = products::get_instance();

// echo "<br>Testing: get_products_by";
// $query = "id = 5";
// var_dump($products->get_products_by($query));
// echo "done";

// echo "<br>Testing: get_info";
// $product_id = 6;
// $columns = "*";
// var_dump($products->get_info($product_id, $columns));
// echo "done";

// echo "<br>Testing: update_average_rating";
// $product_id = 1;
// $columns = "average_rating";
// $products->update_average_rating($product_id);
// var_dump($products->get_info($product_id, $columns));
// echo "done";

?>