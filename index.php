<?php include("assets/config/config.php"); ?>
<?php include("assets/database/posts.php"); ?>
<?php include("assets/database/category.php"); ?>

<?php include("assets/header.php") ?>
<!-- featured post area -->
<?php include("assets/featured_posts.php"); ?>
<?php
	
	$database = new database();
	$db = $database->getConnection();
	$posts = new posts($db);
	$categories = new category($db);
/*
	$result = $posts->getPosts();
	$result->numRows;
	$dbposts = $result->data;*/
	
	$categoryNames = $categories->getCategory();
	$getPublishedPosts = "SELECT * FROM posts WHERE post_status = 'publish' ORDER BY post_id DESC";
	$dbposts = $posts->getCustomPosts($getPublishedPosts);	
	$author = "SELECT * FROM users";
	$users = $posts->getCustomPosts($author);
	foreach ($users as $user_image) {
		$profile_image = $user_image->user_image;
	}
	
?>
<div class="container-fluid">
	<div class="row">

		<div class="col-sm-8 py-3">
			<h3 class="pb-4 mb-4 border-bottom font-italic">Recent Posts</h3>
			<?php if(!empty($dbposts)){	foreach ($dbposts as $post): ?>
			
			<h1 class="py-2"><a href="posts.php?p_id=<?php echo $post->post_id; ?>"><?php echo strtoupper($post->post_title); ?></a></h1>
			<small>
			&nbsp<a href="#"><img src="assets/images/<?php echo $profile_image; ?>" class="rounded-circle float-left mt-1" width="35"> <?php echo $post->post_author; ?></a><br>
			<span class="text-muted">&nbsp&nbsp<?php echo date('d-M-Y',strtotime($post->post_date)); ?> </span> 
			</small>
			<br>
			<div class="row">
				<div class="col-sm-12"><img src="assets/images/<?php echo $post->post_image; ?>" class="rounded mx-auto d-block" width="600" heighth="250"></div>

			</div>
			
			<p class="text-justify py-2"><?php echo substr($post->post_content, 0,405)."..."; ?></p>
			<h5><span class="badge badge-primary">
			
				<?php 
				$id = $post->post_category;
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
				</span>
			<a href="posts.php?p_id=<?php echo $post->post_id; ?>"><button class="btn btn-sm btn-danger float-right">Continue read -></button></a>
			</h5>
			<hr class="my-3">

			<?php endforeach; }else{ echo "<h1 style='color:red!important;'>No posts...</h1>"; }

			
			?>

		</div>	
		<div class="col-sm-4">
			<?php include("sidebar.php"); ?>
		</div>	
	</div>
</div>
	

<?php include("assets/footer.php"); ?>

