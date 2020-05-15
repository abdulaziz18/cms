<?php include("assets/config/config.php"); ?>
<?php include("assets/database/posts.php"); ?>
<?php include("assets/database/category.php"); ?>
<?php include("assets/database/comments.php"); ?>

<?php include("assets/header.php"); ?>

<?php
	
	$database = new database();
	$db = $database->getConnection();
	$posts = new posts($db);
	$categories = new category($db);
	$comments = new comments($db);
	$categoryNames = $categories->getCategory();
	//$cat_id = $_GET['cat_id'];
	if(isset($_GET['cat_id'])){
		$id = $_GET['cat_id'];
		$selectSpecificPost = "SELECT * FROM posts WHERE post_category='{$id}'";
		$SpecificPost = $posts->getCustomPosts($selectSpecificPost);

	}

?>
<div class="container-fluid">
	<div class="row">

		<div class="col-sm-8 py-3">
			<h3 class="pb-4 mb-4 border-bottom font-italic">Active Posts</h3>
			<?php if(!empty($SpecificPost)){foreach ($SpecificPost as $full_post): ?>
			
			<h1 class="py-2"><a href="posts.php?p_id=<?php echo $full_post->post_id; ?>"><?php echo strtoupper($full_post->post_title); ?></a></h1>
			<span class="text-muted"><?php echo date("d-M-Y",strtotime($full_post->post_date)); ?> </span> Author: <a href="#"><?php echo $full_post->post_author; ?></a>
			<br>
			<div class="row">
				<div class="col-sm-12"><img src="assets/images/<?php echo $full_post->post_image; ?>" class="rounded mx-auto d-block" width="500" heighth="250"></div>

			</div>
			
			<p class="text-justify py-2"><?php echo substr($full_post->post_content,0,450); ?></p>
			<button class="btn btn-sm btn-outline-info">
				<?php 
				$id = $full_post->post_category;
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
				
			</button>
			<hr class="my-3">

			<?php endforeach; }else{ echo "Posts in this category..";}	?>


	</div>	
		<div class="col-sm-4">
			<?php include("sidebar.php"); ?>
		</div>	
	</div>




</div>
	

<?php include("assets/footer.php"); ?>

