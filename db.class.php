<?php
//connexion à la base de donnée
class DB{
	private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "newworld";
	private $db;

	private $no;

	//déterminer les paramètres que prend la fonction
	public function __construct($host=null, $username=null, $password=null, $database=null){
		//si le nom d'hote n'est pas null
		if($host != null){
			//on insère les variables
			$this->host=$host;
			$this->username=$username;
			$this->password=$password;
			$this->database=$database;
		}

		//Afficher un msg d'erreur
		try{
			//connexion à la base
			$this->db=new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
				//afficher le mode d'erreur
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
				));
		}
		catch(PDOException $e){
			die('Impossible de se connecter à la base de données');
		}
	}

	//prépare la requête
	public function query($sql, $data = array()){
		$req=$this->db->prepare($sql);
		$req->execute($data);
		return $req->fetchAll(PDO::FETCH_OBJ);
	}
}

?>