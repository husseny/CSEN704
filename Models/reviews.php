<!-- Author: Mohab -->
<?php 
include_once("base.php");

class reviews extends base {

	protected function __construct(){
		parent::__construct();
	}

	function add($user_id, $product_id, $rate, $comment){
		$query = "INSERT INTO reviews (user_id, product_id, rate, comment) 
					VALUES (?, ?, ?, ?)";
		$stmt = $this->pdo->prepare($query);
		$is_successful = $stmt->execute(array($user_id, $product_id, $rate, $comment));
		return $is_successful; 
	}

	function delete($user_id , $product_id){
		$query = "DELETE FROM reviews WHERE user_id = ? AND product_id = ?";
		$stmt = $this->pdo->prepare($query);
		$is_successful = $stmt->execute(array($user_id, $product_id));
		return $is_successful;
	}

	function get_reviews_by($params){
		$reviews = array();
		$query = "SELECT * FROM reviews WHERE $params";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		while($review = $stmt->fetch(PDO::FETCH_OBJ)){
			$reviews[] = $review;
		}
		return $reviews;
	}
}
/* Tests */
// $reviews = reviews::get_instance();

/* Adding review */
// $user_id = 1;
// $product_id = 4;
// $rate = 5;
// $comment = "dolor sit amet, coomment";
// var_dump($reviews->add($user_id, $product_id, $rate, $comment));

/* Deleting review */
// $user_id = 19;
// $product_id = 2;
// var_dump($reviews->delete($user_id, $product_id));

/* Getting Reviews */
// $query = "product_id = 1";
// var_dump($reviews->get_reviews_by($query));
?>