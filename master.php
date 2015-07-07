<?php
echo "Start lol <br>";

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
// Gathering of the numbers to compute allan variacne 
$fileWorkerObj = new fileWorker();
$IFOFile = "IFO.txt";
$IFODimiliter = "\t";
$IFOArray = $fileWorkerObj->toArray($IFOFile, $IFODimiliter);
$arrayGetterObj = new arrayWorker();
$amplidudeColumnIndex = 1; // so that later we can make more dynamic 
$amplitudeArray = $arrayGetterObj->arrayColumn($IFOArray, $amplidudeColumnIndex);
echo "Hey there <br>";




/*
 * This part was derived from the non object code writing4.php
 */

// // generate array from text file 
// echo "to Arrystan <br>";
// $masterDir = $fileWorkerObj->getAdress();
// $rawArray = $fileWorkerObj-> toArray();

// //select data to be ploted
// echo "select data to be plotted <br>";
// $arrayWorkerObj = new arrayWorker($rawArray);
// $Time = $arrayWorkerObj->getTime();
// $AllanVar = $arrayWorkerObj->getAllanVar();
// $VLA = $arrayWorkerObj ->arrayMerger($rawArray, $AllanVar, $Time);

// // Send plotting data to a textfile

// $plottingDataTxt = $fileWorkerObj->toTextville($masterDir, $VLA);

// //Write refined data poins to .txt file so that GNUPlot may use
// echo "begin plotting <br>";
// $GNUObj = new plotter();
// echo  $GNUObj ->testingDefults();

echo "End";

?>