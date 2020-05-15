<?php include("../assets/config/config.php"); ?>
<?php include("../assets/database/posts.php"); ?>
<?php include("../assets/database/comments.php"); ?>
<?php

	$database = new database();
	$db=$database->getConnection();
	$posts = new posts($db);
	$result = $posts->getPosts();
	$comments = new comments($db);
	$getComments = "SELECT * FROM comments";
	$no_of_commmetns = $comments->executeQuery($getComments);
	echo $total_comments = $no_of_commmetns->num_rows;

	

?>
<?php include("header.php"); ?>
<div class="containerr">
	<div class="sidebar" id="sidebar" style="display:block;">
		<strong class="mb-5">Tech Blog Dashboard</strong>
		<ul>
			<li class="active"><a href="admin.php" class="active"><i class="fa fa-dashboard"> Dashboard</i></a></li>
			<li><a href="add_post.php"><i class="fa fa-pencil"> Add a Post</i></a></li>
			<li><a href="show_all_posts.php"><i class="fa fa-list-ol"> All Posts</i></a></li>
			<li><a href="show_all_comments.php"><i class="fa fa-comments"> All comments</i></a></li>
			<li><a href="pending_comments.php" class="fa fa-comments"> Pending Comments</a></li>
			<li><a href="category_setting.php" class="fa fa-folder-open"> Categories Setting</a></li>
			<li><a href="general_setting.php" class="fa fa-gear"> General Setting</a></li>
		</ul>
	</div>
	<button id="nav" class="btn btn-md btn-danger">||| Navigation</button>
	
	<h2 class="pt-2"><i class="fa fa-dashboard"> Welcome to the Dashboard</i></h2>

	<div class="container my-4">

		<div class="row position-relative">
			<div class="col border roudned-0 mx-3 bg-danger text-white position-static shadow">
				<a href="show_all_posts.php" class="stretched-link"><h3 class="py-4 text-center text-white"><i class="fa fa-pencil"></i> Total Posts (<?php echo $result->numRows; ?>)</h3>
				<p class="text-center text-white ">Click here to see posts detail...</p></a>
			</div>
			<div class="col border roudned-0 mx-3 bg-success text-white shadow">
				<a href="show_all_comments.php"><h3 class="py-4 text-center text-white"><i class="fa fa-comments"></i>Total Comments(<?php echo $total_comments; ?>)</h3>
				<p class="text-center text-white">Click here to see comments</p></a>
			</div>

		</div>
	</div>

	<div class="container my-4">

		<div class="row">
			<div class="col border roudned-0 mx-3 bg-secondary text-white shadow">
				<a href="category_setting.php"><h3 class="py-4 text-center text-white"><i class="fa fa-folder-open"></i> Category Setting</h3>
				<p class="text-center text-white">Click here to set categories..</p></a>
			</div>
			<div class="col border roudned-0 mx-3 bg-primary text-white shadow">
				<a href="general_setting.php"><h3 class="py-4 text-center text-white"><i class="fa fa-gear"></i> General Setting</h3>
				<p class="text-center text-white">Profile setting here..</p></a>
			</div>

		</div>
	</div>

	<div class="main-area">

	</div>
</div>
</body>
</html>
