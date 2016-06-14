<?php
class PdoUserTypeManager extends AbstractPdoManager{
	public function __construct(){
		parent::__construct();
	}

	public function findAll(){
		$stm = $this->PDO->prepare("SELECT * FROM usertype");
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'UserType');
		return $stm->fetchAll();
	}
}