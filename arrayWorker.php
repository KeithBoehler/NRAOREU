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
		$this->fkHeader = $this->arrayColumn($rawData, 0);
		$this->fkFacility = $this->arrayColumn($rawData, 1);
		$this->TS = $this->arrayColumn($rawData, 2);
		$this->freqLo = $this->arrayColumn($rawData, 3);
		$this->Pol = $this->arrayColumn($rawData, 4);
		$this->SB = $this->arrayColumn($rawData, 5);
		$this->Time = $this->arrayColumn($rawData, 6); // this one for sure needed
		$this->AllanVar = $this->arrayColumn($rawData, 7); // this one is for sure needed
		
		
		
	}// end constructor
	
	
	private function arrayColumn(array $input, $columnKey, $indexKey = null) {
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
		$index = $this->headerEvaluate($headerExist);
		$filteredData = array();
		//$index = $headerValue;
		while ($index < (count($independantColumn)-1))
		{
			if ($independantColumn[$index] < $independantColumn[$index +1])
			{
				$filteredData[$index][0] = $independantColumn[$index];
				$filteredData[$index][1] = $dependantColumn[$index];
			}
			elseif ($independantColumn[$index] > $independantColumn[$index+ 1])
			{
				$filteredData[$index][0] = " ";
				$filteredData[$index][1] = "  ";
			}
			else 
				echo "ERROR";//die("ERROR: Could not fill array. Malfunction in ArrayWorker Class arrayMerger mehtod <br>");
			$index++;
			
		}// end of while loop
	}// end of arrayMerger
	

	// getters 
	public function  getTime()
	{
		return $this->Time;
	}// end of get time
	
	public function getAllanVar()
	{
		return $this->AllanVar;
	}
	
}// end of class


?>