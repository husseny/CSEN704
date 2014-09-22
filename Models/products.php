<?php 
class products{
	public $all = array();
	public $pdo;

	public function __construct(){
		$this->pdo = new PDO('mysql:dbname=eshop;host=localhost', 'eshop', 'qJRYmAxnpEF3z7mn');
		$this->pdo->setAttribute(PDO::ATTR_ERR)
	}
} ?>