<?php

class testProgram
{
	private $dataArray; //time seires of input data 
	private $result; // array having integration times and allan variance 
	private $yAxisLabel;
	private $xAxisLabel;
	private $tau0;
	private $AVar;
	
	public function __construct() {
		
	}
	
	private function logToLinear($logArray)	{
		$linearArray = array();
		for ($i = 0; $i < count($logArray); ++$i)
		{
			$linearArray[$i] = 10**($logArray[$i] / 10);
		}		
	}// end log to linear
	
	/**
	 * 
	 * @param real $TMin: starting time
	 * @param real $TMax: ending time
	 * $dataArray: time series of input data 
	 * $result : pair of arrays having integrations times and allan variace 
	 * computes normalized allan variance for a reange of integration times 
	 */
	private function computeAllanVar($TMin = 0.05, $TMax = 300.0) {
	
		$this->yAxisLabel = "Allan variance (sigma^2(T))";
		
		// Lines 106 from .py go here 
		
		// Cheack Paramaters 
		$N = count($this->dataArray);
		$dataDuration = $N * $this->tau0;
		
		if ($dataDuration < 10 * $TMax)
			echo "computeAllanVar warning: ". $this->dataArray . " size is < 10 x Tmax.";
		
		if ($dataDuration < $TMax) {
			$TMax = $dataDuration;
			echo "computeAllanVar: adjusted TMax =" . $TMax;
		}
		
		if ($TMin < $this->tau0) {
			echo "computeAllanVar: adjust TMin = tau0 =" . $this->tau0;
			$TMin = $this->tau0;
		}
		
		$this->result = list(); // 124
		
		// Calculate the vlaues of K to use in normal mode: 
		$maxK = ($TMax / $this->tau0) + 1;
		$minM = $N / $maxK;
		
		if ($N < 2) {
			// at least two groups are required 
			$minM = 3;
			$maxK = $N / $maxM;
		}
		for ($K = 1; $K < $maxK; ++$K) {
			$this->result[0] . ($K *$this->tau0);
			$AVar = $this->AVar($this->getAveragesArray[$K]);
		}
		
		/**
		 * 
		 * @param unknown $inputArray : 
		 * @return $sum : take the sum of squares of differences and normalize:
		 * Returns the overlapping Allan variance from an inputArray
		 */
		function AVar ($inputArray) {
			
		$AVar = 1 / (2 * ($N - 1) * $mean**2) * ($this->sigma($inputArray) - $this->sigma($inputArray, 1))**2;
		// get the mean for normalization 
		$x0 = $this->mean($inputArray);
		$M = count($inputArray);
		// take the sum of squares of differences and normalize:
		return $this->sigma(diffSquared($inputArray) / (2 * ($M - 1) * $x0 * $x0)) ;	
		}// end of AVar fucntion 

		/**
		 * 
		 * @param unknown $inputArray
		 * Takes inputArray and returns an array consisting of the differences
		between adjacent elements, squared.
		 */
		function diffSquared($inputArray) {
			$dx = array();
			for ($i = 0; $i < count($inputArray) - 1; ++$i) {
				$dx[$dx] = ($inputArray[$i + 1] - $inputArray[$i])**2;
			}
			require $dx;
		}// end of diffSquared 
		
		function getAveragesArray($K) {
			$averagesArray =[];
			// N is the size of the inpute data array
			$N = count($dataArray);
			// K is the number of points to group and average 
			if ($K < 1)
				$K = 1;
			if ($K > $N)
				$K = $N;
			// M is the number of groups: 
			$M = $N / $K;
			for ($i = 0; $i < $M; ++$i) {
				$i0 = $i * $K;
				$this->averagesArray;
			}
		}// end of getAverages 

	}// end of computeAllanVar
	
	
	
	// smaller support functions for trivial math... or so we say it is.
	/**
	 * @param int $forDiff: This number is by defult zero this is incase we want to compute sum and differance
	 * @param unknown $arrayToAdd: This is a array with a sequence of numbers that we wish to add
	 * @return $sum : value of sum of numbers in $arrayToAdd
	 * This is a function to compute addidtion
	 */
	private function sigma($arrayToAdd, $forDiff = 0) {
		$sum;
		for ($i = 0; $i < count($arrayToAdd); ++$i) {
			$sum += $arrayToAdd[$i + $forDiff];
		} 
		return $sum;
	}
	/**
	 * 
	 * @param unknown $array: Array whose average we want 
	 * @return number : returns the average of an array 
	 */
	private function mean($array) {
		$terms = count($array);
		$sum = $this->sigma($array);
		return $sum / $terms;
	}
	
	
}

?>










































