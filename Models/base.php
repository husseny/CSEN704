<?php 
abstract class base {
	public $pdo;
	private $host = "localhost";
	private $user = "eshop";
	private $dbname= "eshop";
	private $password = "qJRYmAxnpEF3z7mn";
	static $instances = array();

	protected function __construct(){
		try {
			$this->pdo = new PDO("mysql:dbname=$this->dbname;host=$this->host", $this->user, $this->password);
			/* Uncomment to view database error messages */
		  	$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "PDO Error::" . $e->getMessage();
		}
	}

	public static function get_instance(){
		$called_child = get_called_class();
		if (!isset($instances[$called_child])){
			$instances[$called_child] = new $called_child();
		}
		return $instances[$called_child];
	}
} 
?>