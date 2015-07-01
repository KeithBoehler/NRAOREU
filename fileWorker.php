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
		$masterDir = $main_write_directory . "Phase2/";
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
			die("ERROR [fileWorker.php]: file does not exist ->" . $rawHandel . "<br>");
		return $rawArray;
		
	}// end of toArray 	

	public function toTextville($plottingArray, $path)
	{
		echo " Starting to write to textfile <br>";
		$newFile = $path . "prototype.txt";
		$fh = fopen($newFile, 'w');
		if (file_exists($newFile))
			echo " Data is standing by for GNUPlot. <br>";
		else
			die(" failed to make '.txt' file. <br>");
		$first = true;
		for ($i = 1; $i < count($plottingArray); ++$i)
		{
			for ($j = 0; $j < count($plottingArray[$i]); ++$j)
			{
				if ($first)
					fwrite($fh, ";");
				else
					$first = false;
				fwrite($fh, $plottingArray[$i][$j]);
					
			}
		}
		fclose($fh);
			
		return $newFile;
	
	}// end of toTextbille 
	
	private function namesGenerator($base)
	{
		$timeStamp = time();
		return $string = $base . $timeStamp;
	}// end of GNUplotNames
	
	public function toTextville($adress, $plottingArray)
	{
		$newFile = $adress . "refinedData";
		$fh = fopen($newFile, 'w');
		if (!file_exists($newFile))
			die("ERORR: File not made. Class fileWorker. Method GNUPlotScrip");
		$first = TRUE;
		for ($i = 0; $i < count($plottingArray); ++$i)
		{
			for($j = 0; $j < count($plottingArray[$i]); ++$i)
			{
				if ($first)
					fwrite($fh, ";");
				else 
					$first = FALSE;
				fwrite($fh, $plottingArray[$i][$j]);
			}
		}
		fclose($fh);
		return $newFile;
	}// end of toTextville
	
}// endo fileWorker class 


?>