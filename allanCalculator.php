<?php

class allanCalculator {
	// variabesl 
	private $allanVariance;
	private $integrationTime;
	private $numberOfSamples;
	private $meanOfDataSet;
	
	public function __construct() {
		
	}// end of constructor 
	public function allanVariance($rawData) {
		$this->numberOfSamples = count($rawData);
	}// end of allan variace 
	
	// Supporting Math Functions 
	private function average($array) {
		$n = count($array);
		$sum = 0;
		for ($i = 0; $i < $n; ++$i) {
			$sum += $array[$i];
		}
		return $sum / $n;
	}// end of average 
	/**
	 * 
	 * @param array $rawArray: unprocced array
	 * @param array $cumulativeSum: array consisting of sum of current with previuse.
	 * say we have the numebrs 10, 12, and 15 then this function will return a sum were every index is the sum of 
	 * previouse index. 10, 10+12, 10+12+15, ...= 10, 22, 37
	 */
	private function cumulativeSumArray($rawArray) {
		$cumulativeSum = array();
		for($i = 0; $i < count($rawArray); ++$i) {
			$cumulativeSum[$i] = $rawArray[$i] + $rawArray[$i - 1];
		}
		return $cumulativeSum;
	}// end of cumulative sum 
	
} // end of allan calculator class 

?>