<?php

class GNU
{
	
	public function testingDefults($URL, $opsFileAdressAndPath)
	{

		$f = fopen($opsFileAdressAndPath, "w");
		fwrite($f, "set terminal png" . "\r\n");
		fwrite($f, "set output '" . $plot_path . "'\r\n");
		fwrite($f, 'set datafile separator ";"' . "\r\n" );
		fwrite($f, "plot '".$dataAdressAndNameofText."' using 2:3 with linespoints" . "\r\n");
		fclose($f);	
		
	}
	
	
	
}// end of class




?>