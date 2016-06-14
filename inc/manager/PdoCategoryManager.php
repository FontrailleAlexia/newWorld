<?php
class PdoCategoryManager extends AbstractPdoManager{
	public function __construct(){
		parent::__construct();
	}

	public function findAll(){
		$stm = $this->PDO->prepare("SELECT * FROM category");
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'Category');
		return $stm->fetchAll();
	}

	public function findAllFromShelf($shelf){
		$stm = $this->PDO->prepare("SELECT * FROM category WHERE shelf = :shelf");
		$stm->bindValue(":shelf", $shelf);
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'Category');
		return $stm->fetchAll();
	}
}