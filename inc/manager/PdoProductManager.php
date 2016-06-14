<?php
class PdoProductManager extends AbstractPdoManager{
	public function __construct(){
		parent::__construct();
	}

	public function findAll(){
		$stm = $this->PDO->prepare("SELECT * FROM product");
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'Product');
		return $stm->fetchAll();
	}

	public function findProductById($id){
		$stm = $this->PDO->prepare("SELECT * FROM product WHERE id = :id");
		$stm->bindValue(":id", $id);
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'Product');
		return $stm->fetch();
	}
}