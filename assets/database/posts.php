<?php
class posts{
	private $conn;
	public function __construct($db){
		$this->conn = $db;
	}

	public function executeQuery($query){
		$result= $this->conn->query($query);

		
		if($result){
			echo "query is executed..";
		}
		else{
			echo $conn->error;
		}
		return $result;
	}


	public function getPosts(){
		$query = "SELECT * FROM posts ORDER BY post_id DESC";
		$result = $this->conn->query($query);
		if($result->num_rows > 0){
			while($row = $result->fetch_object()){
				$data[] = $row;
			}
		}
			
		$objData = new stdClass();
		$objData->numRows = $result->num_rows;
		$objData->data = $data;

		return $objData;
	}

		public function getCustomPosts($query){
		$result = $this->conn->query($query);
		if($result->num_rows > 0){
			while($row = $result->fetch_object()){
				$posts[] = $row;
			}
			return $posts;
		}else{
			return false;
		}
	}
}


?>