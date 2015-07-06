<?php



class plotter
{
	private $opsFileAdressAndName;
	private $plot_path;
	private $plotName;
	private $URL;
	
	public function __construct()
	{
		//require 'fileWorker.php';
		$fileWorkerObj = new fileWorker();
		$path = $fileWorkerObj->getAdress();
		$plot_URL = $fileWorkerObj->getURL();
		$this->URL = $plot_URL;
		$this->opsFileAdressAndName = $path . "cmd.txt";
		$this->plot_path = $path;
		$this->plotName = "plot.png";
		
	}// end constructor
	
	public function testingDefults()
	{
		require(site_get_config_main());
		$opsFileAdressAndName =$this->opsFileAdressAndName;
		$plotName = $this->plotName;
		$plot_path = $this->plot_path;
		$test = $plot_path . $plotName;
		echo $plot_path . "<br>";
		$f = fopen($opsFileAdressAndName, "w");
		fwrite($f, "set terminal png" . "\r\n");
		fwrite($f, "set output '" . $test . "'\r\n");
		fwrite($f, 'set datafile separator ";"' . "\r\n" );
		fwrite($f, "plot '".$opsFileAdressAndName ."' using 2:3 with linespoints" . "\r\n");
		fclose($f);		
		
		
		$plot_URL = $this->URL . $plotName;
		echo $plot_URL . "<br>";
		system("$GNUPLOT $opsFileAdressAndName");
		echo  "<img src = '$plot_URL'><br>";
	}
	

	
	
	
}// end of class




?>