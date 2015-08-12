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
		for ($i = 0; $i < $maxK; ++$i) {
		
			$averageArray = $this->ultimateAverage($rawData, $i + 1);	
			$normalizer = 1 / (2 * (count($averageArray) - 1) * pow($mu, 2));
			$sumArray[$i] = $normalizer * $this->unnormalizedAVAR($averageArray); // This makes the normalized AllanVar

		}
		// fill datafeilds
		$this->allanVarianceArray = $sumArray;
		$this->N = count($rawData);
		$ininsiate = $this->timeGenerator();
		return $sumArray;
	}// end of allan variace 
	
	/**
	 * 
	 * @param unknown $dataArray: This is a unorganized unaveraged array
	 * @param unknown $k
	 * @return multitype array: This will be a multidimentional averaged array
	 * The point of this function is to combine what used to be the organizer and hte averaager 
	 * into a singal function for better proformace 
	 */
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
	 * This calculates the unormalized allan variace. 
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
	 * @param unknown $minTime: lower x axis limit
	 * @param unknown $maxTime: upper x axis limit
	 * If the lower and upper time limit are known, then the a time array may be calulated based on 
	 * this and the number of sampels that there are.
	 */
	/**
	 * 
	 * @param real $minTime: the lower boundery of the xaxis 
	 * @param number $maxTime: the upper end of the xaxis 
	 * The point of this function is to generate the time array that corresponds with the allan variace 
	 */
	private function timeGenerator($minTime = 0.05, $maxTime = 300) {
		for ($i = 0; $i < count($this->allanVarianceArray); ++$i) {
			// Each cycle should generate one value of time. Starting from min time. 
			$this->integrationTimeArray[$i] = $minTime;
			$minTime += $this->tou0; 
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

































