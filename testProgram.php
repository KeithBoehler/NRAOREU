<?php

class testProgram
{
	private $dataArray; //time seires of input data 
	private $result; // array having integration times and allan variance 
	private $yAxisLabel;
	private $xAxisLabel;
	private $tau0;
	
	
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
		
		elseif ($dataDuration < $TMax) {
			$TMax = $dataDuration;
			echo "computeAllanVar: adjusted TMax =" . $TMax;
		}
		
		else ($TMin < $this->tau0) {
			echo "computeAllanVar: adjust TMin = tau0 =" . $this->tau0;
			$TMin = $this->tau0;
		}
		
		
	}// end of computeAllanVar
	
	
	
	
}

?>