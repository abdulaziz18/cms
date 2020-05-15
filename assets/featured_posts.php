 <!-- feature post area ends -->

<!-- Two main posts start from here -->



<?php
$database = new database();
$db = $database->getConnection();
$posts = new posts($db);
$category = new category($db);
$query = "SELECT * FROM posts LIMIT 0,2";
$result = $posts->getCustomPosts($query);


?>
<div class="row my-4">
<?php	foreach ($result as $featured_post): ?>
	<div class="col-md-6">
		<div class="row no-gutters border rounded overflow-hiddent">
			<div class="col p-4 d-flex flex-column positio-static">
				<!-- <strong class="d-inline-block text-primary mb-2">World</strong> -->
				<h3 class="mb-0"><a href="posts.php?p_id=<?php echo $featured_post->post_id; ?>"><?php echo $featured_post->post_title; ?></a></h3>
				<div class="mb-1 text-muted"><?php echo date("d-M-Y",strtotime($featured_post->post_date)); ?></div>
				<p class="card-text mb-auto"><?php echo $featured_post->post_title; ?></p>
				<a href="posts.php?p_id=<?php echo $featured_post->post_id; ?>">Continue reading...</a>
			</div>

			<div class="col-aut d-none d-lg-block">
				<img src="assets/images/<?php echo $featured_post->post_image; ?>" class="bd-placeholder-img" width="230" height="235">
			</div>

		</div>
	</div>
<?php endforeach; ?>
	
</div> <!-- Two main posts end here -->