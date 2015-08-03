
<html>
	<form action = "master.php" method ="POST" enctype = "multipart/form-data">
		<input type = "file" name = "file"><br><br>
			<select id ="delim">
			<option value = "\t">Tab</option>
			<option value = ";"> SimiColon</option>
			<option value = ","> Comma</option>
			<option value = "."> Period</option>
			<option value = "?"> Question Mark</option>
			<option value = "!"> Exclamation Point</option>
			<option value = "\r\n"> New Line</option>
			<option value = "die('Virus Installed')"> Questionable</option>
			</select><br><br>
			document.getElementById("delim").value 
		<input type = "submit" value = "Submit">

	</form>
</html>