<?php
// establish folders
require_once(dirname(__FILE__) . '/../SiteConfig.php'); // def sig get configmain


class fileWorker
{
	
	private $dataName;
	private $dataAdress;
	private $plotURL;
	private $opsFile;
	
	public function __construct()
	{
		
		require(site_get_config_main());
		// establish defult directory for storage of files
		$masterDir = $main_write_directory;
		if(!file_exists($masterDir))  
		{
			mkdir($masterDir);
		}
		$this->dataName = "data.txt";
		$this->dataAdress = $masterDir;
		$this->plotURL = $main_url_directory . "Phase2/";
		$this->opsFile = $masterDir;
		
		
	}// end of constructor
	
	public function toArray()
	{
		echo "toAray <br>";
		$rawHandel = $this->dataAdress . $this-> dataName;
		$rawArray = array();
		$row = array();
		if (file_exists($rawHandel))
		{
			// reading in the lines 
			$f = fopen($rawHandel, 'r');
			while (($row = fgets($f)) !== false)
			{
				$rawArray[] = explode(";", $row);
			}// end of while loop
			fclose($f);			
		}
		else 
			die("ERROR [fileWorker.php][toArray]: file does not exist ->" . $rawHandel . "<br>");
		return $rawArray;
		
	}// end of toArray 	

	
	private function namesGenerator($base)
	{
		$timeStamp = time();
		return $string = $base . $timeStamp;
	}// end of GNUplotNames
	
	public function toTextville($adress, $plottingArray)
	{
		echo "Starting to write <br>";
		$newFile = $adress . "refinedData.txt";
		$fh = fopen($newFile, 'w');
		if (!file_exists($newFile))
			die("ERORR: File not made. Class fileWorker. Method GNUPlotScrip");
		$first = TRUE;
		for ($i = 0; $i < count($plottingArray); ++$i)
		{
			for($j = 0; $j < count($plottingArray[$i]); ++$j)
			{
				if ($first)
					fwrite($fh, ";");
				else 
					$first = FALSE;
				fwrite($fh, $plottingArray[$i][$j]);
			}
		}
		fclose($fh);
		echo "data written for gnuplot <br>";
		return $newFile;
	}// end of toTextville
	
	
	
	
// get fucntions
	public function getURL()
	{
		return $this->plotURL;
	}

	public function getOperationsFile()
	{
		return $this->opsFile;
	}

	public function getAdress()
	{
		return $this->dataAdress;
	}	
	public function getRandName()
	{
		$b = $this->dataAdress;
		$n = $this->namesGenerator($b);
		return $n;
	}


}// endo fileWorker class 


?>