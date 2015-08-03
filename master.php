<?php
echo "Start <br>";
/*
 *  This is the master php file that will be calling on the classes 
 *  deffer all all working code to other classes \
 *  /home/webtest.cv.nrao.edu/active/php/ntc/ws-kb
 */
// needed classes 

require 'arrayWorker.php';
require 'fileWorker.php';
require 'plotter.php';
require 'AllanCalc.php';
// Objects  
$fileWorkerObj = new fileWorker();
$arrayWorkerObj = new arrayWorker();
$allanCalculatorObj = new allanCalc();

// Gather data 
// $IFOFile = "IFO.txt";
// $IFODimiliter = "\t";
if (isset($_FILES['file'])) {
	$fileName = $_FILES['file']['name'];
	$tmp_name = $_FILES['file']['tmp_name'];
	$delimiter = $_REQUEST['delimiter'];
}

if (isset($fileName)) {
	if (!empty($fileName)) {
		$IFOArray = $fileWorkerObj->toArray($fileName, $delimiter);
		$amplidudeColumnIndex = 1; // so that later we can make more dynamic
		$amplitudeArray = $arrayWorkerObj->arrayColumn($IFOArray, $amplidudeColumnIndex);
		
		// crunch numbers with allanCalc
		$allanVarArray = $allanCalculatorObj->allanVariance($amplitudeArray);
		$timeArray = $allanCalculatorObj->getTimeArray(); //$allanCalculatorObj->timeGenerator(0.05, 300);
		$xyArray = $arrayWorkerObj->arrayMerger($allanVarArray, $timeArray, FALSE);
	}
	else
		echo "Please choose a file. <br>";
}

//document.getElementById("delim").value 



echo "End <br>";
?>


<html>
	<form action = "master.php" method ="POST" enctype = "multipart/form-data">
		<input type = "file" name = "file"><br><br>
		<select name = "delimiter">
			<option value = "\t">Tab</option>
			<option value = ";"> Semi Colon</option>
			<option value = ","> Comma</option>
			<option value = "."> Period</option>
			<option value = "?"> Question Mark</option>
			<option value = "!"> Exclamation Point</option>
			<option value = "\r\n"> New Line</option>			
			<option value = "die('Virus Installed')"> Questionable</option>
			</select><br><br>
			
		<input type = "submit" value = "Submit">

	</form>
</html>
