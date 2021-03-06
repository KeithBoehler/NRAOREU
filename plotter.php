<?php
class plotter{ 
	
	private $opsFileAdressAndName;
	private $plot_path;
	private $plotName;
	private $URL;
	
	public function __construct(&$fileWorkerReff) {
//		include 'fileWorker.php';
//		$fileWorkerObj = new fileWorker();
//		$path = $fileWorkerReff->getOutputAdress();
		$plot_URL = $fileWorkerReff->getURL();
		$this->URL = $plot_URL;
		$this->opsFileAdressAndName = $fileWorkerReff->getOutputAdress() . "cmd.txt";
		$this->plot_path = $fileWorkerReff->getOutputAdress();
		$this->plotName = $fileWorkerReff->plotNameGenerator();
		
	}// end constructor
	
	/**
	 * 
	 * @return string: Not needed jsut here for testing
	 * This writes the data file needed to execute GNUPlot 
	 */
	public function testingDefults($xyTable) {
		require(site_get_config_main());
		$outAdress = $this->plot_path;
		$plotPath = $this->slashReplace($outAdress . $this->plotName);
		$xyTable = $this->slashReplace($xyTable);
		$f = fopen($this->opsFileAdressAndName, "w");
		fwrite($f, "set terminal png" . "\r\n");
		fwrite($f, 'set xlabel "Time Integrations (sec)"'  . "\r\n" );
		fwrite($f, 'set ylabel "Allan Variance  (Sigma^2(T))"' . "\r\n" );
		fwrite($f, 'set title "Stability Plot"' . "\r\n" );
		fwrite($f, 'set logscale' . "\r\n" );
		fwrite($f, "set output '" . $plotPath . "'\r\n");
		fwrite($f, 'set datafile separator ";"' . "\r\n" );
		fwrite($f, 'set arrow from 0.05,5e-7 to 100,5e-7 nohead linestyle 1  ' . "\r\n" );
		fwrite($f, 'set xrange [1e-2:1e3]' . "\r\n");
		fwrite($f, "set format y '%.1e'" . "\r\n" );
		fwrite($f, "set format y '%.1g'" . "\r\n" );
		fwrite($f, "set format x '%.1e'" . "\r\n" );
		fwrite($f, "set format x '%.1g'" . "\r\n" );
		fwrite($f, "set object 1 rect from 300,4e-6 to 302,4e-6 lw 5" . "\r\n");
		fwrite($f, "plot '". $xyTable ."' using 1:2 title 'AVAR' with linespoints" . "\r\n");
		fclose($f);				
		$img = $this->slashReplace($this->URL . $this->plotName);
		echo "<br>";
		echo $img . "<br>";
		$x = $this->slashReplace($this->opsFileAdressAndName);
		echo $x . "<br>";
		system("$GNUPLOT $x");
		echo  "<img src = '$img'><br>";
	}
	
	private function slashReplace($string) {
		return str_replace("\\" , "/" , $string);	
	}
	

	
	
	
}// end of class




?>