<!-- Author: Mohab -->
<?php 
include_once("base.php");

class users extends base {

	protected function __construct(){
		parent::__construct();
	}

	function add($first_name, $last_name, $user_name, $password){
		$query = "SELECT * FROM users where user_name = ?";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute(array($user_name));
		$user_exitst = $stmt->fetch();
		if ($user_exitst){
			return "user exists";
		}
		$query = "INSERT INTO users (first_name, last_name, password, user_name) VALUES (?, ?, ?, ?)";
		$stmt = $this->pdo->prepare($query);
		$is_successful = $stmt->execute(array($first_name, $last_name, $password, $user_name));
		return $is_successful;
	}

	function verify($user_name, $password){
		$query = "SELECT * FROM users where user_name = ? and password = ?";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute(array($user_name, $password));
		$user = $stmt->fetch(PDO::FETCH_OBJ);
		if ($user) {
			return $user;
		}else {
			return false;
		}
	}

	function edit_info($user_id, $edits){
		$query = "UPDATE users set ";
		$edits_count = count($edits);
		foreach($edits as $column => $value){
			$query .= "$column = '$value' ";
			if (--$edits_count){
				$query .= " , ";
			}
		}
		$query .= "where id = ?";
		$stmt = $this->pdo->prepare($query);
		$is_successful = $stmt->execute(array($user_id));
		return $is_successful;
	}

	function edit_password($user_id, $old_password, $new_password){
		$query = "SELECT * FROM users where id = ? and password = ?";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute(array($user_id, $old_password));
		$password_match = $stmt->fetch();
		if (!$password_match){
			return false;
		}else {
			$query = "UPDATE users set password = ? where id = ?";
			$stmt = $this->pdo->prepare($query);
			$is_successful = $stmt->execute(array($new_password, $user_id));
			return $is_successful? $is_successful : die("Database Error");
		}
	}

	function get_info($params, $columns){
		$query = "SELECT $columns from users where $params";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		return $result;
	}
}

/* Tests */
// $users = new users();

/* Verifying User */
// echo $users->verify("user_name = 'userrone' and password = 23");

/* Adding new User */
// $users = users::get_instance();
// $query_result = $users->add("userone", "userone", "userone", 123);
// if ($query_result === "user exists") {
// 	echo "user name already exitst";
// }else {
// 	echo "user successfuly registered";
// }

/* Adding new User with empty fields */
// $query_result = $users->add("", "string", "strpassw", "aaaa");
// if ($query_result) {
// 	echo "The result was true";
// }else {
// 	echo "The result was false";
// }

/* Editing password */
// $user_id = 1;
// $old_password = 'qqqwer';
// $new_password = 'qaaaaz';
// $result = $users->edit_password($user_id, $old_password, $new_password);
// var_dump($result);

/* Selecting values */
// $user_id = 1;
// $columns = "first_name, last_name, id";
// var_dump($users->get_info($user_id, $columns));

/* Editing attributes */
// $user_id = 1;
// $edits = array("first_name"=> "namoo", "last_name"=> "naamoo", "user_name"=> "naamoo");
// var_dump( $users->edit_info($user_id, $edits) );
?>