<!DOCTYPE html>
<html>
<head>
	<title>Count textarea words</title>
</head>
<body>
<form action="count_comment.php" method="post">
	<label>Comment: </label><br>
	 <textarea cols="30" rows="5" name="comment"></textarea>
	 <br>
	 <input type="submit" name="submit">
</form>
<table>
	
<th>Word</th>
<th>Count</th>
<?php
if(isset($_POST['submit'])){
	echo $comment = $_POST['comment'];
	echo $wordCountFunc = str_word_count($comment);
	$commentsArray = array_count_values(str_word_count(strtolower($comment),1));
	
	

	foreach ($commentsArray as $word => $count):
		echo "<tr><td>". $word."</td>";
		echo "<td>".$count . "</td>";
	endforeach;
}


?>

</table>

</body>
</html>