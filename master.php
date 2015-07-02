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
require 'GNU.php';

// generate array from text file 
$fileWorkerObj = new fileWorker();
$rawArray = $fileWorkerObj-> toArray();
//select data to be ploted
$arrayWorkerObj = new arrayWorker($rawArray);
$Time = $arrayWorkerObj->getTime();
$AllanVar = $arrayWorkerObj->getAllanVar();
$VLA = $arrayWorkerObj ->arrayMerger($rawArray, $AllanVar, $Time);
//Write refined data poins to .txt file so that GNUPlot may use
$plotURL = $fileWorkerObj -> plotURL;
$opsFile = $fileWorkerObj -> opsFile ."Phase2";
$GNUObj = new GNU();
$commands = $GNUObj ->testingDefults($plotURL, $opsFile);
system("$GNUPLOT $opsFile"); 



echo "End";
?>