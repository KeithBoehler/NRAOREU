<?php
require 'fileWorker.php';

$fileName = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];

if (isset($fileName)) {
	if (!empty($fileName)) {
		echo "OK. <br>";
		echo $fileName . "<br>";
		echo $tmp_name . "<br>";
	}
	else 
		echo "Please choose a file. ";
}
?>

<form action = "frontEnd.php" method ="POST" enctype = "multipart/form-data">
	<input type = "file" name = "file"><br><br>
	<input type = "submit" value = "Submit">
</form>