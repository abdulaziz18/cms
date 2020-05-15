<?php
session_start();

	if(!isset($_SESSION['logged_in']) AND !isset($_SESSION['user_id'])){
		header("location:../admin.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Dashboard</title>
	<link rel="stylesheet" type="text/css" href="defaultt.css">
	<link rel="stylesheet" type="text/css" href="../assets/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap4/css/bootstrap.min.css">
	<script src="../assets/bootstrap4/js/jquery.js"></script>
	<script src="script.js"></script>
	
	<style>
		
	</style>
</head>
<body>
<header>
	<nav>
		<span class="logo">MyTech Blog Admin Panel</span>
		<a href="../index.php">View Website</a>
		<a href="general_setting.php"> <img src='../assets/images/<?php echo $_SESSION['user_image']; ?>' width="20"> <?php echo ucfirst($_SESSION['username']); ?></a>
		<a href="logout.php?logout=logout">Log out</a>
	</nav>
</header>


