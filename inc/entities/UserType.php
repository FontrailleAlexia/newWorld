<?php
class UserType{
	private $id;
	private $libelle;

	public function __construct(){
		//
	}

	public function getId(){
		return $this->id;
	}

	public function getLibelle(){
		return $this->libelle;
	}
}

?>