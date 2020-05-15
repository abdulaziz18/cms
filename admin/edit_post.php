<?php include("../assets/config/config.php"); ?>
<?php include("../assets/database/posts.php"); ?>
<?php include("../assets/database/category.php"); ?>
<?php
$database = new database();
$db =$database->getConnection();
$posts = new posts($db);
$category = new category($db);
$categoryName = $category->getCategory();

?>
 

 
<script src="script.js"></script>
<?php include("header.php"); ?>
<div class="containerr">
	<div class="sidebar" id="sidebar" style="display:block;">
		<strong class="mb-5">Tech Blog Dashboard</strong>
		<ul>
		<li><a href="admin.php"><i class="fa fa-dashboard"> Dashboard</i></a></li>
			<li class="active"><a class="active" href="edit_post.php?edit=<?php echo $_GET['edit']; ?>"><i class="fa fa-pencil"> Edit Post</i></a></li>
			<li><a href="show_all_posts.php"><i class="fa fa-list-ol"> All Posts</i></a></li>
			<li><a href="show_all_comments.php"><i class="fa fa-comments"> All comments</i></a></li>
			<li><a href="pending_comments.php" class="fa fa-comments"> Pending Comments</a></li>
			<li><a href="category_setting.php" class="fa fa-folder-open"> Categories Setting</a></li>
			<li><a href="general_setting.php" class="fa fa-gear"> General Setting</a></li>
		</ul>
	</div>
	<button id="nav" class="btn btn-md btn-danger">||| Navigation</button>
	
	<h2 class="pt-2"><i class="fa fa-pencil"> Edit Post</i></h2>

	
<?php 
if(isset($_GET['edit'])){
	$id= $_GET['edit'];
	$query = "SELECT * FROM posts WHERE post_id = $id";
	$result = $posts->getCustomPosts($query);
	foreach ($result as $value) {
		$value->post_id;
		$value->post_title;
		$value->post_content;
		$value->post_author;
		$value->post_image;
		$value->post_category;
		$category_id = $value->post_category;		
	}
}

?>
	<div class="main-area">
	<form id="myForm" method="post" enctype="multipart/form-data">
		Post Title : <br><input type="text" name="edit_title" id="edit_title" value="<?php echo $value->post_title ?>"><br>
		Select Image : <br><input type="file" name="edit_image" id="edit_image"> <br>
		<img src="../assets/images/<?php echo $value->post_image; ?>" width="100"><br>
		Post Content: <br><textarea name="edit_post_content" id="edit_post_content" cols="60" rows="10"><?php echo $value->post_content; ?></textarea><br><br>
		<select name="edit_category" id="category" class="form-control">
			<?php 
				//$query = "SELECT * FROM comments WHERE comment_id=$category_id";
			?>
			<?php foreach($categoryName as $category): 
					if($category->category_id == $value->post_category): ?>
					<option value="<?php echo $category['category_id']; ?>" selected><?php echo $value->post_category; ?></option>
				<?php	endif;
				?>

				<option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name'];  ?></option>
			<?php endforeach; ?>
		</select>

		
		<input type="hidden" name="addPost" id="addPost">
		<br>
		<button id="update" class="btn btn-primary" name="update">Update Post</button>
	</form>


<?php 
	if(isset($_POST['update'])){
		echo $_POST['edit_title'];
		echo $_FILES['edit_image']['name'];
		echo $_POST['edit_post_content'];
		echo $_POST['edit_category'];
		
	}

?>
<div id="result"></div>
<div id="getMessage"></div>
</div>
</body>
</html>
<script src="texteditor/jquery.richtext.js"></script>
<script>
	$(document).ready(function(){

 		

		$(document).on("click","#submit",function(e){
			e.preventDefault();
			var form_data = new FormData($("#myForm")[0]);
			form_data.append('action','addPost');
			$.ajax({
				url:"../assets/database/postsHandler.php",
				method:"POST",
				data:form_data,
				contentType:false,
				processData:false,
				success:function(data){
					$("#result").html(data);
					$("#myForm")[0].reset();
				}
			});

		});

	/*	$("#update").click(function(e){
			e.preventDefault();
			//var update = $(this).text();
			alert($("#edit_title").val());
			var form_data = new FormData($("#myFrom")[0]);
			form_data.append('action','update');
			
			$.ajax({
				url:"../assets/database/postsHandler.php",
				method:"POST",
				data:form_data,
				contentType:false,
				processData:false,
				success:function(data){
					$("#result").html(data);
				}
			});

		});*/

	});


</script>