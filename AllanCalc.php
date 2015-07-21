<?php

class allanCalc {
	// variabesl 
	private $allanVariance;
	private $integrationTime;
	private $numberOfSamples;
	private $meanOfDataSet;
	private $tou0;
	
	public function __construct() {
		
	}// end of constructor 
	public function allanVariance($rawData) {
		$this->numberOfSamples = count($rawData);
		$mu = $this->average($rawData);
// 		$cumulativeSumArray = $this->cumulativeSumArray($rawArray);
// 		$outputAnlgesArray = $this->outputAngles($cumulativeSumArray);
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
	/**
	 * 
	 * @param unknown $cumulativeSumArray: This is the array that has been returned from cummulativeSumArray Function
	 * @return array : The reutn is a array where each elemeint in the  cumulative array has been multiplied by tou0
	 * In the manual used to write this program this is found in sec 2.1 equation one. 
	 * it is writen as that hte calulated theta for each gyro sample to be the integral to t of 
	 * the gyroscopes as a function of t prime with respect to t prime. 
	 * (note: prime is used to confuse mathematicians into thinking a derivative occured)
	 */
	private function outputAngles($cumulativeSumArray) {
		for ($i = 0; $i < count($cumulativeSumArray); ++$i) {
			$cumulativeSumArray[$i] *= $this->tou0;
		}
		return $cumulativeSumArray;
	}// end of output angles 
	
	private function ensembleAverage($outputAnglesArray, $averagingFactor) {
		$sum = 0;
		for ($i = 0; $i < count($outputAnglesArray); ++$i) {
			//$sum += 
		}
	}// end of ensemble average 
	
} // end of allan calculator class 

?>