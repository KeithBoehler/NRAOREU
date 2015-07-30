<?php
require 'fileWorker.php';

class frontEnd {
	
	private $name;
	private $tempName;
	
	public function __construct() {
		$this->$name = $_FILES['files']['names'];
		$this->tempName = $_FILES['files']['tempName'];
		$this->didSubmit();
	}
	
	
	/**
	 * This is simply to verfy that a file was submited. 
	 */
	private function didSubmit() {
		if (isset($this->name)) {
			if (!empty($this->name)) {
				echo "File uploaded.";
			}
			else {
				echo "Please choose a file. ";
			}
		}
	}
	
	
}

$f = new frontEnd();

?>

<form action="frontEnd.php" method="POST" enctype="multipart/form-data">
	<input type="files" name="files"><br><br> 
	<input type="submit" value="Submit"> 
</form>
	