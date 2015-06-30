<?php
/*
 *  This is the master php file that will be calling on the classes 
 *  deffer all all working code to other classes 
 */

require 'fileWorker.php';

$test = new fileWorker();

echo $test->handleMaker();




?>