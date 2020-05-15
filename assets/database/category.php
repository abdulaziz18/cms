<?php
class category{
	private $conn;
	public function __construct($db){
		$this->conn = $db;
	}

	public function addCategory($query){
		$addCategory = $this->conn->query($query);
		if($addCategory){
			echo " <p style='color:green;'>Category is inserted successfully...</p>";
		}else{
			echo "There is error in inserting category...";
		}

	}
	public function getCategory(){
		$query = "SELECT * FROM categories";

		$result = $this->conn->query($query);
		if($result->num_rows > 0 ){
			while($row = $result->fetch_array()){
				$data[] = $row;
			}
		}
	return $data;	
	}

	public function updateCategory($query){
		$updateCategory = $this->conn->query($query);
		if($updateCategory){
			echo "Category is successfully updated...";
		}else{
			echo "ERROR::there is errorn in record updation";
		}
	}

	public function removeCategory($query){
		$removeCategory = $this->conn->query($query);
		if($removeCategory){
			echo " Category is deleted from the database";
		}else{
			echo "There is an error in category deletion";
		}
	}
}



?>