<?php

class arrayWorker{
	
	private $fkHeader;
	private $fkFacility;
	private $TS;
	private $freqLo;
	private $Pol;
	private $SB;
	private $Time;
	private $AllanVar;
	private $headerExists = TRUE;
	
	public function __construct($rawData)
	{
		// gather arrays that i may need
		$this->fkHeader = array_column($rawData, 0);
		$this->fkFacility = array_column($rawData, 1);
		$this->TS = array_column($rawData, 2);
		$this->freqLo = array_column($rawData, 3);
		$this->Pol = array_column($rawData, 4);
		$this->SB = array_column($rawData, 5);
		$this->Time = array_column($rawData, 6); // this one for sure needed
		$this->AllanVar = array_column($rawData, 7); // this one is for sure needed
		
		
		
	}// end constructor
	
	
	private function array_column(array $input, $columnKey, $indexKey = null) {
		// http://stackoverflow.com/questions/27422640/alternate-to-array-column <--- Source
		$array = array();
		foreach ($input as $value) {
			if ( ! isset($value[$columnKey])) {
				trigger_error("Key \"$columnKey\" does not exist in array");
				return false;
			}
			if (is_null($indexKey)) {
				$array[] = $value[$columnKey];
			}
			else {
				if ( ! isset($value[$indexKey])) {
					trigger_error("Key \"$indexKey\" does not exist in array");
					return false;
				}
				if ( ! is_scalar($value[$indexKey])) {
					trigger_error("Key \"$indexKey\" does not contain scalar value");
					return false;
				}
				$array[$value[$indexKey]] = $value[$columnKey];
			}
		}
		return $array;
	}
	
	private function plotDataPrepper($unsortedArray, $headerExists , $columnToSortby, $dependantColumn)
{
	$filteredData = array();
	echo " Function is online <br>";
	$index = 1;
	if($headerExists == TRUE)
	{
		echo " Enter TRUE logical barrir. (With Header) <br> ";
		$columnToSortby[0] = 0;
		while($index != count($columnToSortby))
				{
					if($columnToSortby[$index -1] < $columnToSortby[$index ])
					{
						$filteredData[$index][0] = $columnToSortby[$index];
						$filteredData[$index][1] = $dependantColumn[$index];
						$index++;
					}// end if 
					elseif ($columnToSortby[$index - 1] > $columnToSortby[$index ])
					{
						$filteredData[$index][0] = " ";
						$filteredData[$index][1] = " ";
						$index++;
					}// end else if
					else
					{
						die(" Logic ERROR above. (With Header) <br>"); 
					}	
				}// end while 
	}// end of if for the existance of header 
	else 
	{
		echo " Enter Alternative. (No Header) ";
		while ($index != count($unsortedArray[$columnToSortby]))
		{
			if ($columnToSortby[$index] < $columnToSortby[$index + 1])
			{
				$filteredData[$index][0] = $columnToSortby[$index];
				$filteredData[0][$index] = $dependantColumn[$index];
				$index++;
			}// end if
			elseif ($columnToSortby[$index] > $columnToSortby[$index + 1])
			{
				$filteredData[$index][0] = "\r\n";
				$filteredData[0][$index] = "\r\n";
				$index++;
			}// end else if
			else 
				die(" Logic ERROR above. (No Header) ");
		}// end while 
	}// if no header 
	return $filteredData;
}// end of sorter 
	
	
}// end of class


?>