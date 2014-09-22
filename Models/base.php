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
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			
		}
	}
} 
?>