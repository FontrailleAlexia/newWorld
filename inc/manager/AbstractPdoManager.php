<?php
abstract class AbstractPdoManager{
	protected static $PDO_ = null;
	protected $PDO = null;
	
	public function __construct(){
		global $PDO_;
		if($PDO_ == null){
			$PDO_ = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_LOGIN, DB_PASSWORD);
			$PDO_->exec("SET CHARACTER SET utf8");
			$PDO_->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
		}

		$this->PDO = $PDO_;
	}
}