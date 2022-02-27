<?php 

/**
 * 
 */
class Database
{
	public $connection;
	public $host = 'localhost';
	public $user = 'root';
	public $password = 'root';
	public $dbname = 'medicinedb';
	
	function __construct()
	{
		$this->connection = new mysqli($this->host,$this->user,$this->password,$this->dbname);
	}
}

?>