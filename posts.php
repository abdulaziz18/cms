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
	$post_id = $_GET['p_id'];
	if(isset($_GET['p_id'])){
		$id = $_GET['p_id'];
		$selectSpecificPost = "SELECT * FROM posts WHERE post_id='{$id}'";
		$SpecificPost = $posts->getCustomPosts($selectSpecificPost);

	}

?>
<div class="container-fluid">
	<div class="row">

		<div class="col-sm-8 py-3">
			<h3 class="pb-4 mb-4 border-bottom font-italic">Active Posts</h3>
			<?php foreach ($SpecificPost as $full_post): ?>
			
			<h1 class="py-2"><a href="posts.php?p_id=<?php echo $full_post->post_id; ?>"><?php echo strtoupper($full_post->post_title); ?></a></h1>
			<span class="text-muted"><?php echo date("d-M-Y",strtotime($full_post->post_date)); ?> </span> Author: <a href="#"><?php echo $full_post->post_author; ?></a>
			<br>
			<div class="row">
				<div class="col-sm-12"><img src="assets/images/<?php echo $full_post->post_image; ?>" class="rounded mx-auto d-block" width="500" heighth="250"></div>

			</div>
			
			<p class="text-justify py-2"><?php echo $full_post->post_content; ?></p>
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

			<?php endforeach; 	?>



		<?php 
		if(isset($_POST['add_comment'])){
			$post_id = $_GET['p_id'];
			$comment_author = $_POST['fname'];
			$comment_email = mysqli_real_escape_string($db,$_POST['email']);
			$comment_content = mysqli_real_escape_string($db,$_POST['comment']);
			echo $date = date("Y-m-d");
			$comment_status = "unapproved";

		$query = "INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)";
		$query.= "VALUES('$post_id','$comment_author','$comment_email','$comment_content','$comment_status','$date')";
			$result = mysqli_query($db,$query);
			if($result){
				echo "Comment submitted..";
			}else{
				echo mysqli_error($db);
			}			
	}

?>



<div class="jumbotron">			
	<form action="" method="post">
		Name: <input type="text" name="fname" class="form-control"><br>
		Email: <input type="text" name="email" class="form-control">
		Comment: <textarea class="form-control" rows="4" name="comment"></textarea>
		<br><input type="submit" name="add_comment" value="Publish Comment" class="btn btn-sm btn-primary">
	</form>
</div>

<?php 

//Comments Section
$post_id = $_GET['p_id'];
$query = "SELECT * FROM comments WHERE comment_post_id=$post_id AND comment_status='approved' ORDER BY comment_id DESC";
$approved_comments = $comments->executeQuery($query);
echo "<h3 class='my-3'>&nbsp".$approved_comments->num_rows." Comments </h3>";
while($row = $approved_comments->fetch_object()){
	$show_comments[] = $row;
}
if(!empty($show_comments)){
foreach($show_comments as $comments):
	$comments->comment_id;
	$comments->comment_author;
	$orignl_date = $comments->comment_date;

	$date = date("d-m-Y h:i:s",strtotime($orignl_date));


?>
<!--display post comments-->
<div class="card" style="">
  <div class="card-body">
  	<img src="assets/images/dummy-profile.jpg" width="48" class="float-left px-1">
    <h5 class="card-title"><?php echo $comments->comment_author; ?></h5>
    <small class="card-subtitle mb-2 text-muted"><?php echo $date; ?></small>
    <p class="card-text"><?php echo $comments->comment_content; ?></p>
  
  </div>
</div>
<br>
<?php endforeach; }else{echo "No comments to show"; }?>


	</div>	
		<div class="col-sm-4">
			<?php include("sidebar.php"); ?>
		</div>	
	</div>




</div>
	

<?php include("assets/footer.php"); ?>

