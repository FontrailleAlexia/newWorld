<?php
class PdoLotManager extends AbstractPdoManager{
	public function __construct(){
		parent::__construct();
	}

	public function findAll(){
		$stm = $this->PDO->prepare("SELECT * FROM lot");
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'Lot');
		return $stm->fetchAll();
	}

	public function findLotById($id){
		$stm = $this->PDO->prepare("SELECT * FROM lot WHERE id = :id");
		$stm->bindValue(":id", $id);
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'Lot');
		return $stm->fetch();
	}

	public function findAllFromCategory($category){
		$stm = $this->PDO->prepare("SELECT lot.* FROM lot 
			INNER JOIN product ON lot.product = product.id WHERE 
			category = :category");

		$stm->bindValue(":category", $category);
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'Lot');
		return $stm->fetchAll();
	}

	public function add(){
		global $_MSG_ERROR;

		// Liste des champs
		$fields = $this->getFields();

		// Suppression des espaces inutiles
		foreach ($fields as $field) {
			$_POST[$field] = trim($_POST[$field]);
		}

		// S'il manque un champ, nous sortons
		if(count($_POST) != count($fields))
			return false;

		// Vérification des champs non vide et préparation de la requête
		$names = "";
		foreach ($fields as $name) {
			if(strlen($_POST[$name]) < 1 && $_MSG_ERROR == "")
				$_MSG_ERROR .= "Veuillez remplir tous les champs.";

			$names .= ",:" . $name;
		}

		// Exécution de la requête
		if($_MSG_ERROR == ''){
			$stm = $this->PDO->prepare("INSERT INTO lot () VALUES(0," . $_SESSION['id'] . $names . ")");
			foreach ($fields as $name) {
				$value = $_POST[$name];
				if($name == "harvestDate")
					$value = DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d');

				$stm->bindValue(":" . $name, trim($value));
			}
			return $stm->execute();
		}
		return false;
	}

	public function getFields(){
		return [
			"product",
			"quantity",
			"harvestDate",
			"daysPreserve",
			"productionMode",
			"price",
			"pointOfSale"];
	}

	public function removeExpiredLots(){
		$stm = $this->PDO->prepare("DELETE FROM `lot` WHERE DATE_ADD(harvestDate,INTERVAL daysPreserve DAY) < NOW();");
		return $stm->execute();
	}
}