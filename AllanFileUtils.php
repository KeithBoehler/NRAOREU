<?php

class AllanFileUtils
{
	
	private $allanFile;
	private $allanAdress;
	
	public function __construct()
	{
		require(site_get_config_main());
		$masterDir = $main_write_directory;
		if(!file_exists($masterDir))
			mkdir($masterDir);
		// recepie for finding allan data
		$this->allanFile = "IFO.txt";
		$this->allanAdress = $masterDir;
		
		
	}// end constructor 
	
	public function upLoadFile()
	{
		$toOpenAllan = $this->allanAdress . $this->allanFile;
		$rawArray = array();
		$row = array();
		if (file_exists($toOpenAllan))
		{
			$fh = fopen($toOpenAllan, 'r');
			while ($row = fgets($fh))
			{
				$rawArray[] = explode(";", $row);
			}
			fclose($fh);
		}
		else 
			die("ERROR: AllanFileUtils reports file given does not exist. " . $toOpenAllan);
		return $rawArray;		
		
	}// end up load file 
	
}// end of class. Leave


?>