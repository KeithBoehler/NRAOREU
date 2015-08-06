<?php
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

// Gather data 
// $IFOFile = "IFO.txt";
// $IFODimiliter = "\t";
if (isset($_FILES['file'])) {
	$fileName = $_FILES['file']['name'];
	$tmpName = $_FILES['file']['tmp_name'];
  	$delimiter = $_REQUEST['delimiter'];
  	/*
  	 * HTML does not return a clean tab for PHP to work with. Will give something like \\t.
  	 *  This makes fileWorker.php's toArray() explode very sad.
  	 */
	if ($delimiter == "tab")
  		$delimiter = "\t"; // DO NOT MESS!!
}

if (isset($fileName)) {
	if (!empty($fileName)) {
		// Objects
		$fileWorkerObj = new fileWorker($fileName, $tmpName);
		$arrayWorkerObj = new arrayWorker();
		$allanCalculatorObj = new allanCalc();
		// prep arrays 
		$IFOArray = $fileWorkerObj->toArray($delimiter);
		$amplidudeColumnIndex = 1; // so that later we can make more dynamic
		$amplitudeArray = $arrayWorkerObj->arrayColumn($IFOArray, $amplidudeColumnIndex);		
		// crunch numbers with allanCalc
		$allanVarArray = $allanCalculatorObj->allanVariance($amplitudeArray);
		$timeArray = $allanCalculatorObj->getTimeArray(); //$allanCalculatorObj->timeGenerator(0.05, 300);
		$VLA = $arrayWorkerObj->arrayMerger($allanVarArray, $timeArray, FALSE);
		// writing AVAR to text 
		$fileWorkerObj->toTextville($VLA);
		// Getting the plot stuff 
		echo "plotting";
		$GNUcaller = new plotter($fileWorkerObj);
		$randName = $fileWorkerObj->getRandomName();
		$saveAdress = $fileWorkerObj->getOutputAdress();
		$xyTable = $saveAdress . $randName;
		$GNUcaller->testingDefults($xyTable);
	}
	else
		echo "Please choose a file. <br>";
}

//document.getElementById("delim").value 



echo "End <br><br><br>";
?>


<html>
	<form action = "master.php" method ="POST" enctype = "multipart/form-data">
		<input type = "file" name = "file"><br><br>
		<select name = "delimiter">
			<option value = "tab">Tab</option>
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
