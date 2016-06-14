<?php
class PdoDistributorManager extends AbstractPdoManager{
	public function __construct(){
		parent::__construct();
	}

	public function findAll(){
		$stm = $this->PDO->prepare("SELECT * FROM distributor");
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'Distributor');
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

		// Vérifications obligatoires
		if(strlen($_POST['firstname']) < 2) $_MSG_ERROR .= "Le prénom doit faire 2 caractères minimums.<br>";
		if(strlen($_POST['lastname']) < 2) $_MSG_ERROR .= "Le nom doit faire 2 caractères minimums.<br>";
		if(strlen($_POST['libelle']) < 2) $_MSG_ERROR .= "Le libellé doit faire 2 caractères minimums.<br>";
		if(strlen($_POST['address']) < 2) $_MSG_ERROR .= "L'addresse doit faire 2 caractères minimums.<br>";
		if(strlen($_POST['postalcode']) < 2) $_MSG_ERROR .= "Le code postal doit faire 2 caractères minimums.<br>";
		if(strlen($_POST['city']) < 2) $_MSG_ERROR .= "La ville doit faire 2 caractères minimums.<br>";

		// Préparation de la requête
		$names = "";
		foreach ($fields as $name) {
			$names .= ",:" . $name;
		}

		// Exécution de la requête
		if($_MSG_ERROR == ''){
			$stm = $this->PDO->prepare("INSERT INTO distributor () VALUES(0" . $names . ",:user)");
			foreach ($fields as $name) {
				$value = $_POST[$name];
				$stm->bindValue(":" . $name, trim($value));
			}
			$stm->bindValue(":user",$_SESSION['id']);
			return $stm->execute();
		}
		return false;
	}

	public function getFields(){
		return [
			"firstname",
			"lastname",
			"email",
			"libelle",
			"activity",
			"phone",
			"address",
			"address2",
			"postalcode",
			"city",];
	}
}