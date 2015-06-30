<?php
// establish folders
require_once(dirname(__FILE__) . '/../SiteConfig.php'); // def sig get configmain


class fileWorker{
	
	private $dataName;
	private $dataAdress;
	
	public function __construct(){
		
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
	
	private function handleMaker(){
		
		return $rawHandel = $this->dataAdress . $this-> dataName ;
		
	}// end of handle maker

	
	
	
	
}// endo f class 


?>