<?php
class comments{
	private $conn;
	public function __construct($db){
		$this->conn = $db;
	}
	public function CustomComments($query){
		//$query = "SELECT * FROM comments";
		$result = $this->conn->query($query);
		if($result->num_rows > 0){
			while($row = $result->fetch_object()){
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
	public function executeQuery($query){
		$result = $this->conn->query($query);
		if(!$result){
			echo "QUERY FAILED::".$conn->error;
		}
		return $result;
	}


}