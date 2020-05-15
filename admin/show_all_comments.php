<?php
include("../assets/database/comments.php");
include("../assets/config/config.php");
include("../assets/database/posts.php");
$database = new database();
$db = $database->getConnection();
$comments = new comments($db);
$posts = new posts($db);
$getComments = $comments->CustomComments("SELECT * FROM comments ORDER BY comment_id DESC");

?>
<?php include("header.php"); ?>
<div class="containerr">
	<div class="sidebar" id="sidebar" style="display:block;">
		<strong class="mb-5">Tech Blog Dashboard</strong>
		<ul>
			<li><a href="admin.php"><i class="fa fa-dashboard"> Dashboard</i></a></li>
			<li><a href="add_post.php"><i class="fa fa-pencil"> Add a Post</i></a></li>
			<li><a href="show_all_posts.php"><i class="fa fa-list-ol"> All Posts</i></a></li>
			<li class="active"><a class="active" href="show_all_comments.php"><i class="fa fa-comments"> All comments</i></a></li>
			<li><a href="pending_comments.php" class="fa fa-comments"> Pending Comments</a></li>
			<li><a href="category_setting.php" class="fa fa-folder-open"> Categories Setting</a></li>
			<li><a href="general_setting.php" class="fa fa-gear"> General Setting</a></li>
		</ul>
	</div>
	<button id="nav" class="btn btn-md btn-danger">||| Navigation</button>
	
	<h2 class="pt-2"><i class="fa fa-comments"> All Comments</i></h2>

	

	<div class="main-area">
		<table class="table-bordered table-hover">
				<thead>
					<tr>
						<th>Comment Id</th>
						<th>Author</th>
						<th>Email</th>
						<th style="width:500px!important;">Comment</th>
						<th>In response to</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
		<?php $i=1; foreach($getComments as $displayComments): ?>
				<tr>
					
					<td><?php echo $i++; $id=$displayComments->comment_id;?></td>
					<td><?php echo $displayComments->comment_author; ?></td>
					<td><?php echo $displayComments->comment_email; ?></td>
					<td><?php echo $displayComments->comment_content; ?></td>
					<td><?php $query = "SELECT * FROM posts WHERE post_id=$displayComments->comment_post_id";
						
						$result = $posts->getCustomPosts($query);
						foreach ($result as $value): ?>
							<a href="../posts.php?p_id=<?php echo $value->post_id; ?>"><?php echo $value->post_title; ?></a>
						
						<?php endforeach; ?>
					 </td>
					<td><?php echo $displayComments->comment_status; ?></td>
					<td><a href="show_all_comments.php?action=approve&id=<?php echo $id ?>">Approve</a>/<a href="show_all_comments.php?action=unapprove&id=<?php echo $id ?>">Unapprove</a></td>
				</tr>
		<?php endforeach; ?>
		</table>

	</div>

<?php  
if(isset($_GET['action'])){
	$action = $_GET['action'];
	$id = $_GET['id'];
	switch($action){
		case 'approve':
			$query = "UPDATE comments SET comment_status='approved' WHERE comment_id='$id'";
			$comments->executeQuery($query);
			header("location:show_all_comments.php");
			
		break;
		case 'unapprove':
			$query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id='$id'";
			$comments->executeQuery($query);
			header("location:show_all_comments.php");
		break;
		default:

	}

}
?>


</body>
</html>
