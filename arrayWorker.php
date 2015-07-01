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
	
	private function headerEvaluate($header)
	{
		$headerValue;
		if ($header == TRUE)
			return $headerValue = 1;
		elseif($header != TRUE)
			return $headerValue = 0;
		else
			die("ERROR: existance of header is undetermined. ");
	}// end of headerExist
	
	public function arrayMerger($unsortedArray, $dependantColumn, $independantColumn, $headerExist = TRUE)
	{
		$headerValue = headerEvaluate($headerExist);
		$filteredData = array();
		$index = 0;
		while ($index != count($independantColumn))
		{
			if ($independantColumn[$index+$headerValue] < $independantColumn[$index+$headerValue+1])
			{
				$filteredData[$index][0] = $independantColumn[$index];
				$filteredData[$index][1] = $dependantColumn[$index];
			}
			elseif ($independantColumn[$index+$headerValue] > $independantColumn[$index+$headerValue+1])
			{
				$filteredData[$index][0] = " ";
				$filteredData[$index][1] = "  ";
			}
			else 
				die("ERROR: Could not fill array. Malfunction in ArrayWorker Class arrayMerger mehtod");
			$index++;
		}// end of while loop
	}// end of arrayMerger
	
	
}// end of class


?>