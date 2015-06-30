<?php
// establish folders
require_once(dirname(__FILE__) . '/../SiteConfig.php'); // def sig get configmain


class fileWorker
{
	
	private $dataName;
	private $dataAdress;
	
	public function __construct()
	{
		
		require(site_get_config_main());
		// establish defult directory for storage of files
		$masterDir = $main_write_directory . 'Phase2/';
		if(!file_exists($masterDir))
		{
			mkdir($masterDir);
		}
		$this->dataName = "data.txt";
		$this->dataAdress = $masterDir;
		
	}// end of constructor
	
	private function toArray()
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
			die("ERROR: file does not exist ->" . $rawHandel);
		return $rawArray;
		
	}// end of toArray 	

	private function toTextville($plottingArray, $path)
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
	
	}
}// endo fileWorker class 


?>