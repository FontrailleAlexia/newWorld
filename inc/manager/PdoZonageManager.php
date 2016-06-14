<?php
class PdoZonageManager extends AbstractPdoManager{
	public function __construct(){
		parent::__construct();
	}

	public function search($query){
		$stm = $this->PDO->prepare("SELECT * FROM zonage WHERE postalcode LIKE :query ORDER BY postalcode LIMIT 12");
		$stm->bindValue(':query', $query . "%");
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'Zonage');
		return $stm->fetchAll();
	}
}