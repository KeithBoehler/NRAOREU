<?php
echo "Start <br>";
/*
 *  This is the master php file that will be calling on the classes 
 *  deffer all all working code to other classes 
 */
// needed classes 
require 'arrayWorker.php';
require 'fileWorker.php';

// generate array from text file 
$rawArrayObj = new fileWorker();
$rawArray = $rawArrayObj-> toArray();


//select data to be ploted

echo "End";
?>