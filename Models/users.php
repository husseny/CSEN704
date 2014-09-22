<?php 
class users {
	public $all = array();
	public $pdo;

	function __construct(){
		try {
			$this->pdo = new PDO('mysql:dbname=eshop;host=localhost', 'eshop', 'qJRYmAxnpEF3z7mn');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
		} catch (PDOException $e) {
			echo $e->getMessage();			
		}
	}

	function populate(){
		$result = $this->pdo->query('SELECT * FROM users');

		while($user = $result->fetch(PDO::FETCH_OBJ)){
			$this->all[$user->id] = $user;
		}
	} 
}
$haha = new users();
$haha->populate();
var_dump($haha->all);

?>