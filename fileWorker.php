<?php
// establish folders
require_once(dirname(__FILE__) . '/../SiteConfig.php'); // def sig get configmain


class fileWorker
{
	
	private $dataName;
	private $uploadAdress;
	private $outPutAdress;
	private $plotURL;
	private $opsFile;
	private $randomFile;
	private $timeStamp;
	
	public function __construct($dataFile, $tmpName) {
		$this->timeStamp = time();
		require(site_get_config_main());
		// establish defult directories 
		$masterDir = $main_write_directory; // this will be the "root Dir"
		$this->uploadAdress= $masterDir; // here is where user input will be placed 
		$this->outPutAdress = $masterDir; // here is where final files will be placed 
		$this->plotURL = $main_url_directory;
		$this->opsFile = $masterDir;
		// make if dir does not exits 
		if(!file_exists($masterDir)) {
			mkdir($masterDir);
		}
		// upload the file that will be plotted
		$this->dataName = $dataFile;
		move_uploaded_file($tmpName, $this->uploadAdress . $dataFile);
		
		
	}// end of constructor
	
	/**
	 * 
	 * @param string $dataFile: Name of the file that we wish to open. This is a .txt 
	 * @param char $dilimiter: This is the instruction on how the file is organised. comma, semicolon, tab, new line, etc
	 * @return multitype:$rawArray: The return is a multidimational array from the data that was in a .txt
	 */
	public function toArray($delimiter) {
		echo "toAray <br>";
		$rawHandel = $this->uploadAdress . $this-> dataName;
		$rawArray = array();
		$row = array();
		if (file_exists($rawHandel))
		{
			// reading in the lines 
			$f = fopen($rawHandel, 'r');
			while (($row = fgets($f)) !== false)
			{
				$rawArray[] = explode($delimiter, $row);
			}// end of while loop
			fclose($f);			
		}
		else 
			die("ERROR [fileWorker.php][toArray]: file does not exist >>>" . $rawHandel . "<br>");
		return $rawArray;
		
	}// end of toArray 	

	/**
	 * 
	 * @param string $base: This is a choosen name for a file. 
	 * @return string $string: This returned string is the name that will be used as a file name. Consistes of base name and a time stamp to diffferenciate different files 
	 */
	private function namesGenerator() {
		$string = "AVAR" . $this->timeStamp . ".txt";
		$this->randomFile = $string;
		return $string;
	}
	
	/**
	 * To make names for plot files 
	 */
	public function plotNameGenerator() {
		$string = "plot" . $this->timeStamp . ".png";
		return $string;
	}
	
	/**
	 * 
	 * @param unknown $adress: This is the path to a directory where our .txt file will be saved
	 * @param unknown $plottingArray: This is the array that we wish to write to a .txt file.
	 * @return string
	 */
	public function toTextville($plottingArray)	{
		echo "Starting to write <br>";
		$randomName = $this->namesGenerator();
		$newFile = $this->outPutAdress . $randomName;
		$fh = fopen($newFile, 'w');
		if (!file_exists($newFile))
			die("ERORR: File not made. Class fileWorker. ");
//  		$first = TRUE;
// 		for ($i = 1; $i < count($plottingArray); ++$i) {
// 			$first = TRUE;
// 			for($j = 0; $j < count($plottingArray[$i]); ++$j) {
// 				if (!$first)
// 					fwrite($fh, ";");
// 				else  
// 					$first = FALSE;
// 				fwrite($fh, $plottingArray[$i][$j]);
// 			//	fwrite($fh, "\r\n");
// 			}
// 		}
		foreach ($plottingArray as $row) {
			$first = TRUE;
			foreach ($row as $item) {
				if(!$first) 	
					fwrite($fh, ";");
				else 
					$first = FALSE;
				fwrite($fh, $item);
			}
			fwrite($fh, "\r\n");
		}
		fclose($fh);
		echo "data written for gnuplot <br>";
		return $newFile;
	}// end of toTextville
	
	
	
// get fucntions
	public function getURL() {
		return $this->plotURL;
	}

	public function getOperationsFile()	{
		return $this->opsFile;
	}

	public function getOutputAdress()	{
		return $this->outPutAdress;
	}	
	public function getUploadAdress() {
		return $this->uploadAdress;
	}
	public function getRandomName() {
		return $this->randomFile;
	}


}// endo fileWorker class 


?>