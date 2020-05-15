<?php
include("category.php");
include("../config/config.php");

$database = new database();
$db = $database->getConnection();

	$category = new category($db);
	$data = $category->getCategory();

	
//}
/*	switch ($_POST['action']) {
		case 'load':
			echo "Load data is pressed";
			break;
		case 'insert_category':
			echo "Insert Data";
			break;
		default:
			echo "nothing is loaded";
			break;
	}*/
	if(($_POST['action'])=="insert_category"){
		$categoryName= $_POST['category'];
		$query = "INSERT INTO categories (category_name)VALUES('$categoryName')";
		$category->addCategory($query);

	}elseif($_POST['action']=="load"){
		$output = "";
		?>
		<table class='table-striped table-bordered'>
		<thead class='thead-dark'>
			<tr><th>Category Id</th> <th>Category Title</th><th>Edit/Delete</th></tr>
		</thead>

		<?php
		foreach($data as $category):
		?>
		<tr id="<?php echo $category['category_id']; ?>">
		<td> <?php echo $category['category_id']; ?>
		<td data-target="category"><?php echo $category['category_name']; ?> </td>
		<td><button class='btn btn-sm btn-primary' data-role='update' id='edit' data-id="<?php echo $category['category_id']; ?>">Edit</button>
			<button id="del" class='btn btn-sm btn-danger' data-role="delete" data-id="<?php echo $category['category_id']; ?>">Delete</button>
		</td>
		</tr>
		<?php
	endforeach;	
		echo "</table>";
		?>

<script src="../bootstrap4/js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$(document).on("click","button[data-role=update]", function(){
			var id = $(this).data('id');
			var category = $("#"+id).children('td[data-target=category]').text();
			$("#category").val(category);
			$("#category_id").val(id);
			$("#add_category").hide();
			$("#update_category").show();

		});



	});

</script>

		<?php
	}elseif($_POST['action']=="update"){
		$id= $_POST['id'];
		$categoryName= $_POST['categoryName'];
		$query = "UPDATE categories SET category_name='$categoryName' WHERE category_id=$id";
		$category->updateCategory($query);
	}elseif($_POST['action']=="delete"){
		echo $id = $_POST['id'];
		$query="DELETE FROM categories WHERE category_id=$id";
		$category->removeCategory($query);

	}

?>

