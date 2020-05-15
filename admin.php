<?php include("assets/config/config.php"); ?>
<?php 
session_start();
	$database = new database();
	$db = $database->getConnection();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap4/css/bootstrap.css">
	<style>
		body{
			background:url('programming.jpg');
			background-size:cover;
		}
	</style>
</head>
<body>
	<div class="hero">
<?php 

	$error='';
	$success='';
	if(isset($_POST['login'])){
		$userName = $_POST['userName'];
		$userPwd = $_POST['userPwd'];

		$query = "SELECT * FROM users WHERE user_name='$userName' AND user_pwd='$userPwd'";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)){
			$uName = $row['user_name'];
			$uPwd = $row['user_pwd'];
			$user_full_name = $row['user_full_name'];
			$user_id = $row['user_id'];
			$user_image = $row['user_image'];
		}

			if($userName == isset($uName) && $userPwd == isset($uPwd)){
				$success = "Successfully Logged In...";

				$_SESSION['logged_in'] = true;
				$_SESSION['user_id'] = $user_id;
				$_SESSION['username'] = $user_full_name;
				$_SESSION['user_image'] = $user_image;
				header("location:admin/admin.php");

			}else{
				$error = "Username or password is incorrect";
			}
			
	}

?>

<div class="container-fluid mt-5">
	<div class="row my-5">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 border shadow"><br>
			<h1 class="mx-auto">Login Area</h1><br>
		<form action="admin.php" method="post">
			<label>Username: </label><input type="text" name="userName" class="form-control"><br>
			<label>Password: </label> <input type="password" name="userPwd" class="form-control"><br>
			<input type="submit" name="login" value="Login" class="btn btn-md btn-danger float-right">
			<?php echo $error; ?>
			<?php echo $success; ?>
			<br><br><br>
		</form>

		</div>
		<div class="col-sm-4"></div>
	</div>
</div>
</div>




</body>
</html>