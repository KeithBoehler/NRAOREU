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
	$dilimiter = $_FILES['file']['dilimiter'];
}

if (isset($fileName)) {
	if (!empty($fileName)) {
		echo "OK. <br>";
		echo $fileName . "<br>";
		echo $tmp_name . "<br>";
		echo $dilimiter . "<br>";
	}
	else
		echo "Please choose a file. <br>";
}
// $IFOArray = $fileWorkerObj->toArray($fileName, $dilimiter);
// $amplidudeColumnIndex = 1; // so that later we can make more dynamic 
// $amplitudeArray = $arrayWorkerObj->arrayColumn($IFOArray, $amplidudeColumnIndex);

// // crunch numbers with allanCalc
// $allanVarArray = $allanCalculatorObj->allanVariance($amplitudeArray);
// $timeArray = $allanCalculatorObj->getTimeArray(); //$allanCalculatorObj->timeGenerator(0.05, 300);
// $xyArray = $arrayWorkerObj->arrayMerger($allanVarArray, $timeArray, FALSE);



echo "End <br>";
?>


