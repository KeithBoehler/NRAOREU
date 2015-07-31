<?php
echo "Start <br>";

/*
 *  This is the master php file that will be calling on the classes 
 *  deffer all all working code to other classes \
 *  /home/webtest.cv.nrao.edu/active/php/ntc/ws-kb
 */
// needed classes 
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
$IFOFile = "IFO.txt";
$IFODimiliter = "\t";
$IFOArray = $fileWorkerObj->toArray($IFOFile, $IFODimiliter);
$amplidudeColumnIndex = 1; // so that later we can make more dynamic 
$amplitudeArray = $arrayWorkerObj->arrayColumn($IFOArray, $amplidudeColumnIndex);

// crunch numbers with allanCalc
$allanVarArray = $allanCalculatorObj->allanVariance($amplitudeArray);
$timeArray = $allanCalculatorObj->getTimeArray(); //$allanCalculatorObj->timeGenerator(0.05, 300);
$xyArray = $arrayWorkerObj->arrayMerger($allanVarArray, $timeArray, FALSE);



echo "End <br>";

