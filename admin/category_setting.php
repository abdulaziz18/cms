<?php include("../assets/config/config.php"); ?>
<?php include("../assets/database/category.php"); ?>
<?php
	$database = new database();
	$db = $database->getConnection();
	$category = new category($db);

?>

<?php include("header.php"); ?>

<div class="containerr">
	<div class="sidebar" id="sidebar" style="display:block;">
		<strong class="mb-5">Tech Blog Dashboard</strong>
		<ul>
		<li><a href="admin.php"><i class="fa fa-dashboard"> Dashboard</i></a></li>
			<li><a href="add_post.php"><i class="fa fa-pencil"> Add a Post</i></a></li>
			<li><a href="show_all_posts.php"><i class="fa fa-list-ol"> All Posts</i></a></li>
			<li><a href="show_all_comments.php"><i class="fa fa-comments"> All comments</i></a></li>
			<li><a href="pending_comments.php" class="fa fa-comments"> Pending Comments</a></li>
			<li class="active"><a class="active" href="category_setting.php" class="fa fa-folder-open"> Categories Setting</a></li>
			<li><a href="general_setting.php" class="fa fa-gear"> General Setting</a></li>
		</ul>
	</div>
	<button id="nav" class="btn btn-md btn-danger">||| Navigation</button>
	
	<h2 class="pt-2"><i class="fa fa-folder-open"> Categories Setting</i></h2>

	

	<div class="main-area my-4">
	<h4>Add New Category</h4>
<form id="myForm">
	<label for="category">Category Name</label>
	<input type="text" name="category" id="category" placeholder="write category name...">&nbsp;<button id="add_category" class="btn btn-md btn-info">Add Category</button>
	<button id="update_category" class="btn btn-md btn-info">Update Category</button>
	<input type="hidden" name="category_id" id="category_id">
</form>


<span class="text-danger" id="error"></span>
<span class="text-success" id="message"></span>
	<div id="result" class="my-4"></div>

</div>
</body>
</html>

<script>
	$(document).ready(function(){
			$(document).on("click","#del",function(){
			var id = $(this).data('id');
			var data_role = $(this).data('role');
			confirm("Do you want to delete category?");
			$.ajax({
				url:"../assets/database/categoryHandler.php",
				method:"post",
				data:{action:'delete',id:id},
				success:function(response){
					$("#message").html(response).fadeOut(1500);
					load_data();
				}
			});

		});

		$("#update_category").hide();

		
		$("#update_category").click(function(e){
			e.preventDefault();

			var id = $("#category_id").val();
			var category_name = $("#category").val();
			$.ajax({
				url:"../assets/database/categoryHandler.php",
				method:"POST",
				data:{id:id,categoryName:category_name,action:'update'},
				dataType:"html",
				success:function(data){
					$("#message").html(data).fadeOut(1500);
					$("#myForm")[0].reset();
					$("#update_category").hide();
					$("#add_category").show();
					load_data();
				}
			});
			
		});

		load_data();

		function load_data(){
			$.ajax({
				url:"../assets/database/categoryHandler.php",
				method:"POST",
				data:{action:'load'},
				dataType:"html",
				success:function($data){
					$("#result").html($data);
				}
				
			});
		}

		$("#add_category").click(function(e){
			e.preventDefault();
			var category = $("#category").val();
		
			if(category==""){
				$("#error").text("*Please write the category name..");
			}else{
			$.ajax({
				url:"../assets/database/categoryHandler.php",
				method:"POST",
				data:{action:'insert_category',category:category},
				success:function(data){
					$("#error").html(data).fadeOut(1500);
					load_data();
						
					}
				});
			}

		});


		

	});


</script>