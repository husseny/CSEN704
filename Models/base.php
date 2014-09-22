<?php 
class base {
	public $pdo;
	private $host = "localhost";
	private $user = "eshop";
	private $dbname= "eshop";
	private $password = "qJRYmAxnpEF3z7mn";

	public function __construct(){
		try {
			$this->pdo = new PDO("mysql:dbname=$this->dbname;host=$this->host", $this->user, $this->password);
		} catch (PDOException $e) {
			echo "PDO Error::" . $e->getMessage();
		}
	}
} 
?>