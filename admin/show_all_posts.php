<?php
include("../assets/database/posts.php");
include("../assets/config/config.php");

$database = new database();
$db = $database->getConnection();
$posts = new posts($db);
$getPosts = $posts->getPosts();
//echo $getPosts->numRows;
$dbposts = $getPosts->data;
?>
<?php include("header.php"); ?>
<div class="containerr">
	<div class="sidebar" id="sidebar" style="display:block;">
		<strong class="mb-5">Tech Blog Dashboard</strong>
		<ul>
			<li><a href="admin.php"><i class="fa fa-dashboard"> Dashboard</i></a></li>
			<li><a href="add_post.php"><i class="fa fa-pencil"> Add a Post</i></a></li>
			<li class="active"><a class="active" href="show_all_posts.php"><i class="fa fa-list-ol"> All Posts</i></a></li>
			<li><a href="show_all_comments.php"><i class="fa fa-comments"> All comments</i></a></li>
			<li><a href="pending_comments.php" class="fa fa-comments"> Pending Comments</a></li>
			<li><a href="category_setting.php" class="fa fa-folder-open"> Categories Setting</a></li>
			<li><a href="general_setting.php" class="fa fa-gear"> General Setting</a></li>
		</ul>
	</div>
	<button id="nav" class="btn btn-md btn-danger">||| Navigation</button>
	
	<h2 class="pt-2"><i class="fa fa-list-ol"> All Posts</i></h2>

	

	<div class="main-area">
	
	<?php 
	if(isset($_POST['checkBoxArray'])){
		$selectBoxArray = $_POST['checkBoxArray'];
		foreach ($selectBoxArray as $selectedBoxs) {
			echo $selectedBoxs;
			echo $bulk_option = $_POST['bulkOption'];
			switch ($bulk_option) {
				case 'publish':
					$query = "UPDATE posts SET post_status='{$bulk_option}' WHERE post_id=$selectedBoxs";
					$result = mysqli_query($db,$query);
					header('location:show_all_posts.php');
					break;
				case 'draft':
					$query = "UPDATE posts SET post_status='{$bulk_option}' WHERE post_id=$selectedBoxs";
					$result = mysqli_query($db,$query);
					header('location:show_all_posts.php');
					break;
				case 'delete':
					$query = "DELETE FROM posts WHERE post_id='{$selectedBoxs}'";
					$result = mysqli_query($db,$query);
					header('location:show_all_posts.php');
					break;
				default:
					echo "default";
					break;
			}
		}
	}

	?>
		<div class="container my-2" style="width:80%!important;float: right;">
			<form action='show_all_posts.php' method="post">
	<!-- Bulk options start from here -->
			<select class="form-control" style="width:220px!important; float:left;" name="bulkOption">
				<option value="">Select Option</option>
				<option value="publish">Publish</option>
				<option value="draft">Draft</option>
				<option value="delete">Delete</option>
			</select>&nbsp
			<input type="submit" name="submit" value="Apply" class="btn btn-info">

			<a href="add_post.php" class="btn btn-primary">New Post</a>
<br>
			<table class="table-bordered table-hover" id="postsTable" >
			<thead>
			<tr>
				<td><input type="checkbox" name="selectAllBoxes" id="selectAllBoxes"></td>
				<td>Id</td>
				<td style="width:600px!important;">Post Title</td>
				<td>Author</td>
				<td>Image</td>
				<td>Comments</td>
				<td>Status</td>
				<td>Category</td>
				<td>Action</td>
			</tr>
			</thead>

	<?php	$i=1; if(!empty($dbposts)) {foreach ($dbposts as $posts): ?>
			<tr>
				<td><input type="checkbox" name="checkBoxArray[]" id="checkBoxes" value="<?php echo $posts->post_id; ?>"></td>
				<td><?php echo $i++; ?></td>
				<td><a href="../posts.php?p_id=<?php echo $posts->post_id; ?>"><?php echo $posts->post_title; ?></a></td>
				<td><?php echo $posts->post_author; ?></td>

				<td><img src='../assets/images/<?php echo $posts->post_image; ?>' width="70"></td>
				<td><?php echo $posts->comment_count; ?></td>
				<td><?php echo $posts->post_status; ?></td>
				<td><?php $posts->post_category; ?>
					<?php 
				$id = $posts->post_category;
				$query = "SELECT * FROM categories WHERE category_id='$id'";
				$result = mysqli_query($db,$query);
				$row = mysqli_fetch_assoc($result);
				$category = $row['category_name'];
				if(!$category == "0"){
					echo $category;
				}else{
					echo "No Category";
				}

				?>

				</td>
				<td><a href='edit_post.php?edit=<?php echo $posts->post_id; ?>'>Edit</a> /<a href='show_all_posts.php?delete=<?php echo $posts->post_id; ?>'>Delete</a>
				</td>
			</tr>
	<?php 	endforeach; }else{ echo "No posts to show.."; }?>
		</table>
	</form>
		</div>
		

	</div>
</body>
</html>



<script>
	$(document).ready(function(){
		$("#selectAllBoxes").click(function(event){
			//$("#checkBoxes").not(this).prop('checked',this.checked);
			if(this.checked){
				$("input:checkbox").each(function(){
					this.checked = true;
				});
			}else{
				$("input:checkbox").each(function(){
					this.checked = false;
				});
			}
		});
		
	});
	
</script>
