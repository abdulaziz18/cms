<html>
<head>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="image">
		<input type="submit" name="submit">
	</form>
	<?php
		if(isset($_POST['submit'])){
			echo $image = $_FILES['image']['name'];
			$imageTmp = $_FILES['image']['tmp_name'];
			move_uploaded_file($imageTmp, "../images/".$image);
			
		}


	?>
</body>
</html>