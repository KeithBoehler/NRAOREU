<?php

/*
 * at the begging of each function define the parameter
 * php doc
 * 
 * long term average as as snsativity trick. 
 * short term instability
 * allan plot tells us the sort term variations and the long term amplidtude error
 * 
 * 
 */

class arrayWorker{
	

	private $headerExists = TRUE;
	
	public function __construct(){
		
		
	}// end constructor
	
	/**
	 * @param array $input: This is a multidimentional array.
	 * @param unknown $columnKey: This is the index of the column of intrest.
	 * @param string $indexKey
	 * @return boolean|multitype $array: This is a one dimentional array that used to be a member of the $input array. 
	 * arrayColumn is a function that is meant to pull out a column from a multidimentional array 
	 * and assigin it ti a one dimention array.
	 */
	public function arrayColumn(array $input, $columnKey, $indexKey = null) {
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
	
	/**
	 * 
	 * @param boolean $header: true or false value explaning if there is a header
	 * @return int $headerValue: This is a value of a one or zero depending on weather there is a header
	 * This function will evaluate a boolean and return one if there is a header or a zero if there isnt.
	 * This is intended to supplament arrayMerger. If there is a header adding a value of one will then 
	 * skip the header row. If there isnt adding zero does not affect the looping of rows. 
	 */
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
	
	/**
	 * 
	 * 
	 * @param unknown $dependantColumn: This would be the "y axis" data
	 * @param unknown $independantColumn: This would be the "x axis"
	 * @param string $headerExist: This value is tedermined by the function headerEvaluate.
	 * @return Ambigous <multitype:, string, unknown> $filteredData: This is a blank array that will be filled with the $independantColumn and $dependantColumn
	 * This is a function that will  take two one dimentional arrays and merge them into one two dimentional array. This function has the assumption that data 
	 * in the array has a header. If there is no header add additional parameter of 'FALSE' to the headerExist paramater. 
	 * 
	 */
	public function arrayMerger($dependantColumn, $independantColumn, $headerExist = TRUE)
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
		return $filteredData;
	}// end of arrayMerger
	

}// end of class


?>