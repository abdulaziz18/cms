<?php include("header.php"); ?>
<?php include("../assets/config/config.php"); ?>
<?php include("../assets/database/comments.php"); ?>
<?php
	$database = new database();
	$db=$database->getConnection();
	$users = new comments($db);
	$query = "SELECT * FROM users";
	$result = $users->customComments($query);
	foreach ($result as $u_data) {
		$username = $u_data->user_name;
		$user_full_name = $u_data->user_full_name;
		$user_email = $u_data->user_email;
		$user_image = $u_data->user_image;
		$user_detail = $u_data->user_detail;
	}
	?>
<div class="containerr">
	<div class="sidebar" id="sidebar" style="display:block;">
		<strong class="mb-5">Tech Blog Dashboard</strong>
		<ul>
			<li><a href="admin.php"><i class="fa fa-dashboard"> Dashboard</i></a></li>
			<li><a href="add_post.php"><i class="fa fa-pencil"> Add a Post</i></a></li>
			<li><a href="show_all_posts.php"><i class="fa fa-list-ol"> All Posts</i></a></li>
			<li><a href="show_all_comments.php"><i class="fa fa-comments"> All comments</i></a></li>
			<li><a href="pending_comments.php" class="fa fa-comments"> Pending Comments</a></li>
			<li><a href="category_setting.php" class="fa fa-folder-open"> Categories Setting</a></li>
			<li class="active"><a href="general_setting.php" class="active" class="fa fa-gear"> General Setting</a></li>
		</ul>
	</div>
	<button id="nav" class="btn btn-md btn-danger">||| Navigation</button>
	
	<h2 class="pt-2"><i class="fa fa-gear"> General Setting</i></h2>

	

	<div class="main-area">
<form>
	Username: <br><input type="text" name="username" value="<?php echo $username; ?>" disabled><br>
	Full Name: <br><input type="text" name="fullname" value="<?php echo $user_full_name; ?>"><br>
	Email: <br><input type="text" name="email" value="<?php echo $user_email; ?>"><br>
	About me: <br><textarea name="about" rows="6" cols="60"><?php echo $user_detail ?></textarea><br>
	<button class="btn btn-md btn-info">Update Profile</button>

</form>

</div>
</body>
</html>
