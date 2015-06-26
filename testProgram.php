<?php

function logToLinear($logArray)
{
	//log array reffers to the self in the python code
	$linearArray = array();
	for ($i = 0; $i < count($logArray); ++$i)
	{
		$logArray[$i] = pow(10, ($linearArray[$i])/10);
	}// end for	
	
	return $linearArray;
	
}// end of logToLinear




?>