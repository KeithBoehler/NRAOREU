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
		$coeff = 1 / (2 * ($this->numberOfSamples - 1) * pow($mu, 2));
		$sum = $this->summation($rawData);
		return $coeff * $sum;
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
	private function summation($rawData) {
		$value = 0;
		for ($i = 0; $i < count($rawData); ++$i) {
			$value += pow($rawData[$i] - $rawData[$i + 1] , 2);
		}		
		return $value;
	}

} // end of allan calculator class 

?>