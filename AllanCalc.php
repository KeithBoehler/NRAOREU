<?php

class allanCalc {
	// variabesl 
	private $allanVariance;
	private $integrationTime;
	private $numberOfSamples;
	private $meanOfDataSet;
	private $tou0;
	
	public function __construct($data) {
		$allanArray = array();
		for ($i = 0; $i < count($data); ++$i) {
			$allanArray[$i] = $this->allanVariance($data);
		}
		return $allanArray;
	}// end of constructor 
	/**
	 * 
	 * @param unknown $rawData: amplidude array 
	 * @return number: allan variace 
	 * see FEND-40.00.00.00-079-A35-PRO Page: Page 115 of 183 for more detail. 
	 */
	private function allanVariance($rawData) {
		$mu = $this->average($rawData);
		$normalizer = 1 / (2 * (count($rawData) - 1) * pow($mu, 2));
		for ($i = 0; $i < $this->allanTime($rawData); ++$i) {
			$organizedArray = $this->dataOrganizer($rawData, $i + 1);
			$averageOrgArray = $this->average2($organizedArray);
			$sum = $this->summation($averageOrgArray);
		}
		return $normalizer * $sum;
		
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
	private function dataOrganizer($oneDArray, $elements) {
		$tree = array();
		for ($i = 0; $i < count($oneDArray); ++$i) {
			$value = 0;
			for ($j = 0; $j < $elements; ++$j) {
				$tree[$i][$j] = $oneDArray[$i];
			}
		}
		return $tree;
	}
	/**
	 * 
	 * @param unknown $array
	 * @return multitype:number
	 * The purpose here is to be able to able to handle averaging every two nu,bers every three and so forth.
	 * the plan is to have a multidimentional array whose sub arrays are the length of two, three, or how ever many numbers we want.
	 * This is to facilitate another functions ability to average the smaller arrays  later. 
	 * 
	 */
	private function average2($array) {
		$newArray = array();
		for ($i = 0; $i < count($array); ++$i) {
			$value = 0;
			for ($j = 0; $j < count($array[$i]); ++$j) {
				$value += $array[$i][$j];
			}
			$newArray[$i] = $value / count($array[$i]);
		}
		return $newArray;
	}
	
	/**
	 * 
	 * @param unknown $data: original data array 
	 * @return number: This is the number of increments that must happeb to go from 50 ms to 300 ms. 
	 * If we are to plot so many points in 300s, then 300 over then number of points 
	 * will give the increment from 50 to 300. 
	 */
	private function allanTime($data) {
		return 300 / count($data);
	}
	 

} // end of allan calculator class 


?>

































