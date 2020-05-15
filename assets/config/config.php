<?php
class database{
	private $host = "localhost";
	private $user = "root";
	private $pwd = "";
	private $db = "cmss";
	public $link;

	// public $name = "Aziz";
	/*public function __construct(){
		$this->connection();
	}*/

	
	public function getConnection(){
		$link = new mysqli($this->host,$this->user,$this->pwd,$this->db);
		if($link->connect_error){
			echo "ERROR::Connection failed " . $link->connect_error;
		}
		
		return $link;
	}



}


?>