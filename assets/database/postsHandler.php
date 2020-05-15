<?php

include("posts.php");
include("../config/config.php");
$database = new database();
$db = $database->getConnection();
$posts = new posts($db);

switch ($_POST['action']) {
	case 'addPost':
		$image_dir = "../images/";
		$error = $_FILES['image']['error'];
		$title = mysqli_real_escape_string($db,$_POST['title']);
		$imageOrignalName = $_FILES['image']['name'];
		$imageTmp = $_FILES['image']['tmp_name'];
/*		if($error == "0"){

				move_uploaded_file($imageTmp,"../images/".$imageName);
				echo "file uploaded";
			}*/
		$imageSize = $_FILES['image']['size'];
		$content = mysqli_real_escape_string($db,$_POST['post_content']);
		$category = $_POST['category'];
		$date = date("Y-m-d");
		$userName = $_POST['username'];
		$imgExtension = explode(".",$imageOrignalName);
		$allowed_extension = array("png","jpg","jpeg","gif");
		$end = end($imgExtension);
		if(empty($title) || empty($content)){
			die ("*All the fields are required");
		}

		if(empty($imageOrignalName)){
			die("*Please select the Image");
		}
		if(in_array(strtolower($end),$allowed_extension)){
			$userName = $_POST['username'];
			
			if($error == "0"){
				move_uploaded_file($imageTmp, "../images/".$imageOrignalName);
				// echo "file uploaded";
			}
			$query = "INSERT INTO posts (post_author,post_title,post_content,post_image,post_date,post_category)VALUES('$userName','$title','$content','$imageOrignalName','$date','$category')";
			$posts->executeQuery($query);
		
		}else{
			echo "*File must be an Image";
		}

		break;
		
	case 'update':
		echo $_POST['action'];
		echo $_POST['name'];
		$image_dir = "../images/";
		$error = $_FILES['edit_image']['error'];
		echo $title = mysqli_real_escape_string($db,$_POST['edit_title']);
		echo $imageOrignalName = $_FILES['edit_image']['name'];
		$imageTmp = $_FILES['edit_image']['tmp_name'];
		echo $content = mysqli_real_escape_string($db,$_POST['edit_post_content']);
		echo $category = $_POST['edit_category'];
		echo $date = date("Y-m-d");
			if($error == "0"){

				move_uploaded_file($imageTmp,"../images/".$imageName);
				echo "file uploaded";
			}
		break;
	default:
		echo "default value";
		break;
}

?>