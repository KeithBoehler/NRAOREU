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
	
	public function __construct()
	{
		// gather arrays that i may need
		$this->fkHeader = $fkHeader;
		$this->fkFacility = $fkFacility;
		
		
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
	
	
	
	
}// end of class


?>