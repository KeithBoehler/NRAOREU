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
	/**
	 * 
	 * @param unknown $rawData: amplidude array 
	 * @return number: allan variace 
	 * see FEND-40.00.00.00-079-A35-PRO Page: Page 115 of 183 for more detail. 
	 */
	public function allanVariance($rawData) {
		$this->numberOfSamples = count($rawData);
		$mu = $this->average($rawData);
		$coeff = 1 / (2 * ($this->numberOfSamples - 1) * pow($mu, 2));
		$sum = $this->summation($rawData);
		$b = $this->dataOrganizer($rawArray, 3);
		return $coeff * $sum;
		// return $sum;
	}// end of allan variace 
	
	// Supporting Math Functions 
	/**
	 * 
	 * @param  $array: Raw array that has yet to have any computations done. Amplidude array  
	 * @return number: aveage of submited array
	 */
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
	 * @param unknown $rawData: Amplitude Array 
	 * @return number: sum of the differnacfe of ith sample  and next sample squared. 
	 */
	private function summation($amplidudeArray) {
		$value = 0;
		for ($i = 0; $i < count($amplidudeArray) - 1; ++$i) {
			$value += pow($amplidudeArray[$i] - $amplidudeArray[$i + 1] , 2);
		}		
		return $value;
	}
	/**
	 * 
	 * @param unknown $rawArray:
	 * @param unknown $elements: This is the number of elements that we want in a row. 
	 * Can also be thought of as the number of elements in a cluster to averag
	 * @return Ambigous <multitype:, unknown> : 
	 */
	private function dataOrganizer($rawArray, $elements) {
		$tree = array();
		for ($i = 0; $i < count($rawArray); ++$i) {
			$value = 0;
			for ($j = 0; $j < $elements; ++$j) {
				$tree[$i][$j] = $rawArray[$i];
			}
		}
		foreach ($tree as $branch) {
			foreach ($branch as $leaf) {
				echo $leaf . "<br>";
			}
		}
		return $tree;
	}
} // end of allan calculator class 


?>

































