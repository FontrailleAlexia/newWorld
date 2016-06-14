<?php
class PdoProductionModeManager extends AbstractPdoManager{
	public function __construct(){
		parent::__construct();
	}

	public function findAll(){
		$stm = $this->PDO->prepare("SELECT * FROM productionmode");
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'ProductionMode');
		return $stm->fetchAll();
	}
}