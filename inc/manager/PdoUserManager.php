<?php
class PdoUserManager extends AbstractPdoManager{
	public function __construct(){
		parent::__construct();
	}

	public function authenticateFromApi($nickname, $password){
		$user = $this->authenticate($nickname, $password);
		if($user){
			return $user;
		}else{
			return null;
		}
	}

	public function authenticateFromWeb($nickname, $password){
		if(!$this->isConnected()){
			$user = $this->authenticate($nickname, $password);
			if($user){
				$_SESSION['id'] = $user->getId();
				$_SESSION['userType'] = $user->getType();
				header('location: profile.php');
				return $user;
			}else{
				return null;
			}
		}else{
			return $this->getUser();
		}
	}

	public function authenticate($nickname, $password){
		$stm = $this->PDO->prepare("SELECT * FROM users WHERE
			nickname = :nickname AND password = :password");
		$stm->bindValue(":nickname", $nickname);
		$stm->bindValue(":password", md5($password));
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'User');
		$user = $stm->fetch();
		if($user){
			return $user;
		}else{
			return null;
		}
	}

	public function registration(){
		return $this->insert();
	}

	public function getFields(){
		return [
			"firstname",
			"lastname",
			"email",
			"birthDate",
			"phone",
			"nickname",
			"address",
			"address2",
			"postalcode",
			"city",
			"password",
			"retypePassword",
			"type"];
	}

	public function insert(){
		global $_MSG_ERROR;

		// Liste des champs
		$fields = $this->getFields();

		foreach ($fields as $name) {
			if(!isset($_POST[$name])){
				if($name == "type")
					$_POST[$name] = "2";
				else
					$_POST[$name] = "";
			}
		}

		// S'il manque un champ, nous sortons
		if(count($_POST) != count($fields))
			return false;

		// Vérifications obligatoires
		if($_POST['password'] != $_POST['retypePassword']) $_MSG_ERROR .= "Les mots de passe sont différents.<br>";

		// Liste des champs sans le champ "retypePassword"
		$fields = array_merge(array_diff($fields, array("retypePassword")));

		// Préparation de la requête
		$names = "";
		foreach ($fields as $name) {
			$names .= ",:" . $name;
		}

		return $this->save("INSERT INTO users () VALUES(0" . $names . ")");
	}

	public function update(){
		// Liste des champs sans le champ "retypePassword"
		$fields = array_merge(array_diff($this->getFields(), array("retypePassword")));

		// S'il manque un champ, nous sortons
		if(count($_POST) != count($fields))
			return false;

		// Préparation de la requête
		$values = "";
		foreach ($fields as $name) {
			if($name != "password" || ($name == "password" && strlen($_POST[$name]) > 0))
				$values .= ", " . strtolower($name) . " = :" . $name;
		}

		// Exécute la requête
		$result = $this->save("UPDATE users SET " . substr($values, 2) . " WHERE id=" . $_SESSION['id'], true);

		// Mise à jour du type de compte dans la variable de session si la requête est un succès
		if($result)
			$_SESSION['userType'] = $_POST["type"];

		return $result;
	}

	private function save($request, $isUpdate = false){
		global $_MSG_ERROR;

		// Liste des champs sans le champ "retypePassword"
		$fields = array_merge(array_diff($this->getFields(), array("retypePassword")));

		// Vérifications obligatoires
		if(strlen($_POST['password']) < 5 && (($isUpdate && strlen($_POST['password']) > 0) || !$isUpdate))
			$_MSG_ERROR .= "Le mot de passe doit faire 5 caractères minimums.<br>";

		if(strlen(trim($_POST['nickname'])) < 5) $_MSG_ERROR .= "Le pseudo doit faire 5 caractères minimums.<br>";
		if(!$isUpdate && $this->isNicknameExists(trim($_POST['nickname']))) $_MSG_ERROR .= "Le pseudo existe déjà.<br>";

		// Exécution de la requête
		if($_MSG_ERROR == ''){
			$stm = $this->PDO->prepare($request);
			foreach ($fields as $name) {
				$value = $_POST[$name];
				if($name == "password" && strlen($value) > 0)
					$value = md5($value);
				else if($name == "birthDate" && $value != "")
					$value = DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d');

				if($name != "password" || ($name == "password" && strlen($_POST[$name]) > 0))
					$stm->bindValue(":" . $name, trim($value));
			}
			return $stm->execute();
		}
		return false;
	}

	public function isNicknameExists($nickname){
		$stm = $this->PDO->prepare("SELECT * FROM users WHERE
			nickname = :nickname");
		$stm->bindValue(":nickname", $nickname);
		$stm->execute();

		$row = $stm->fetch(PDO::FETCH_ASSOC);
		return $row == true;
	}

	public function getUser(){
		$stm = $this->PDO->prepare("SELECT * FROM users WHERE
			id = :id");
		$stm->bindValue(":id", $_SESSION['id']);
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'User');
		$user = $stm->fetch();
		if($user){
			return $user;
		}else{
			return null;
		}

		throw new Exception("Erreur de chargement");
	}

	public function isConnected(){
		return isset($_SESSION['id']);
	}
}