<?php

class allanCalc {
	// variabesl 
	private $allanVarianceArray;
	private $integrationTimeArray;
	private $N; // Number of data samples (Raw)
	private $mu; // mean of data set
	private $tou0 = 0.05;
	private $minTime;
	private $maxTime;
	
	public function __construct() {

	}// end of constructor 
	/**
	 * 
	 * @param unknown $rawData: amplidude array 
	 * @return number: allan variace 
	 * see FEND-40.00.00.00-079-A35-PRO Page: Page 115 of 183 for more detail. 
	 */
	public function allanVariance($rawData) {
		$mu = $this->average($rawData);
		$normalizer = 1 / (2 * (count($rawData) - 1) * pow($mu, 2));
		$sumArray = array();
		$maxK = 300 / $this->tou0;
		if ($maxK > count($rawData))
			$maxK = count($rawData);
		//$averageArray = $this->ultimateAverage($rawData, $maxK);
		//die("your goodish");
		for ($i = 0; $i < $maxK; ++$i) {
			$start = microtime(true);
			// every cycle in this loop should generate one point. 
			//$organizedArray = $this->dataOrganizer($rawData, $i + 1);
			//$averageOrgArray = $this->averageOrgArray($organizedArray);
			
			$averageArray = $this->ultimateAverage($rawData, $i + 1);
			
			$sumArray[$i] = $normalizer * $this->unnormalizedAVAR($averageArray); // This makes the normalized AllanVar
			$time_elapsed_secs = microtime(true) - $start;
			//echo $time_elapsed_secs . "<br>";
			echo memory_get_usage(). "\t" . $time_elapsed_secs . "\t" .  $i ."<br>";			
		}
		// fill datafeilds
		$this->allanVarianceArray = $sumArray;
		$this->N = count($rawData);
		$ininsiate = $this->timeGenerator();
		return $sumArray;
	}// end of allan variace 
	
	private function ultimateAverage($dataArray, $k) {
		$averageArray = array();
		$c = count($dataArray);
		for ($i = 0; $i < $c; $i += $k) {
			$sum = 0;
			$n = 0;
			for($j = 0; $j < $k; ++$j) {
				if ($i + $j < $c) {
					++$n;
					$sum += $dataArray[$i + $j];
				}
			}
			$averageArray[] = $sum / $n;
		} 
		return $averageArray;
	}
	
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
	private function unnormalizedAVAR($amplidudeArray) {
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
		$row = 0;
		for ($i = 0; $i < count($oneDArray); $i += $elements) {
			for ($j = 0; $j < $elements; ++$j) {
				// here we are setting numbers that we want into sets of columns 
				if ($i + $j < count($oneDArray))			
					$tree[$row][$j] = $oneDArray[$i + $j];
				else 
					break;
			}
			++$row;
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
	private function averageOrgArray($array) {
		$averagedRows = array();
		for ($i = 0; $i < count($array); ++$i) {
			// here we are resetting the value of previuse rows sum and setting the average
			$value = 0;
			for ($j = 0; $j < count($array[$i]); ++$j) {
				// here we are summing the elements in a row
				$value += $array[$i][$j];
			}
			$averagedRows[$i] = $value / count($array[$i]);
		}
		return $averagedRows;
	}
	/**
	 * 
	 * @param unknown $minTime: lower x axis limit
	 * @param unknown $maxTime: upper x axis limit
	 * If the lower and upper time limit are known, then the a time array may be calulated based on 
	 * this and the number of sampels that there are.
	 */
	private function timeGenerator($minTime = 0.05, $maxTime = 300) {
		$timeIncrement = $maxTime / $this->N;
		for ($i = 0; $i < count($this->allanVarianceArray); ++$i) {
			// Each cycle should generate one value of time. Starting from min time. 
			$this->integrationTimeArray[$i] = $minTime;
			$minTime += $timeIncrement; 
		}
		$this->integrationTimeArray;
		$this->maxTime = $maxTime;
		$this->minTime = $minTime;
	}
	
	// getter fucntions 
	
	public function getAllanArray() {
		return $this->allanVarianceArray;
	}
	
	public function getTimeArray() {
		return $this->integrationTimeArray;
	}
	
	public function getTou0() {
		return $this->tou0;
	}
	
	public function getMaxTime() {
		return $this->maxTime;
	}
	
	public function getMinTime() {
		return $this->minTime;
	}
	
	 

} // end of allan calculator class 


?>

































