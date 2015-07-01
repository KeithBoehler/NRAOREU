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

// generate array from text file 
$fileWorkerObj = new fileWorker();
$rawArray = $fileWorkerObj-> toArray();
//select data to be ploted
$arrayWorkerObj = new arrayWorker($rawArray);
$VLA = $arrayWorkerObj ->arrayMerger($rawArray, $AllanVar, $Time);
//Write refined data poins to .txt file so that GNUPlot may use




echo "End";
?>