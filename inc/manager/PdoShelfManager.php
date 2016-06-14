<?php
class PdoShelfManager extends AbstractPdoManager{
	public function __construct(){
		parent::__construct();
	}

	public function findAll(){
		$stm = $this->PDO->prepare("SELECT * FROM shelf");
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'Shelf');
		return $stm->fetchAll();
	}
}