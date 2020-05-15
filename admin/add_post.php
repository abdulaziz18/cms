<?php include("../assets/config/config.php"); ?>
<?php include("../assets/database/posts.php"); ?>
<?php include("../assets/database/category.php"); ?>
<?php include("header.php"); ?>
<?php
$database = new database();
$db =$database->getConnection();
$posts = new posts($db);
$category = new category($db);
$categoryName = $category->getCategory();

?>
 

 
<script src="script.js"></script>

<div class="containerr">
	<div class="sidebar" id="sidebar" style="display:block;">
		<strong class="mb-5">Tech Blog Dashboard</strong>
		<ul>
		<li><a href="admin.php"><i class="fa fa-dashboard"> Dashboard</i></a></li>
			<li class="active"><a class="active" href="add_post.php"><i class="fa fa-pencil"> Add a Post</i></a></li>
			<li><a href="show_all_posts.php"><i class="fa fa-list-ol"> All Posts</i></a></li>
			<li><a href="show_all_comments.php"><i class="fa fa-comments"> All comments</i></a></li>
			<li><a href="pending_comments.php" class="fa fa-comments"> Pending Comments</a></li>
			<li><a href="category_setting.php" class="fa fa-folder-open"> Categories Setting</a></li>
			<li><a href="general_setting.php" class="fa fa-gear"> General Setting</a></li>
		</ul>
	</div>
	<button id="nav" class="btn btn-md btn-danger">||| Navigation</button>
	
	<h2 class="pt-2"><i class="fa fa-pencil"> Add New Post</i></h2>

	

	<div class="main-area">
	<form id="myForm" method="post" enctype="multipart/form-data">
		Post Title : <br><input type="text" name="title" id="title"><br>
		Select Image : <br><input type="file" name="image" id="image"><br>
		Post Content: <br><textarea name="post_content" id="post_content" cols="60" rows="10"></textarea><br>
		<select name="category" id="category" class="form-control">
			<?php foreach($categoryName as $category): ?>
				<option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
			<?php endforeach; ?>
		</select>

		<br>
		<input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']; ?>">
		<input type="hidden" name="addPost" id="addPost">
		<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-md btn-primary">
		
	</form>

<div id="result"></div>
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

		$("#update").click(function(e){
			e.preventDefault();
			var update = $(this).text();
			$.ajax({
				url:"../assets/database/postsHandler.php",
				method:"post",
				dataType:"html",
				data:{action:'update'},
				success:function(data){
					$("#result").html(data);
				}
			});

		});

	});


</script>