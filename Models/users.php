<?php 
include("base.php");

class users extends base {

	function __construct(){
		parent::__construct();
	}

	function add(){}

	function verify(){}

	function edit_info(){}

	function edit_password(){}

	function get_info(){}
	
// Performing query::
// $result = $this->pdo->query('SELECT * FROM users');
// while($user = $result->fetch(PDO::FETCH_OBJ)){
// 	$this->all[] = $user;
// }
}
?>