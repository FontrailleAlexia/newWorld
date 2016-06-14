<?php
class Shelf{
	private $id;
	private $libelle;
	private $picture;

	public function __construct(){
		//
	}

	public function getId(){
		return $this->id;
	}

	public function getLibelle(){
		return $this->libelle;
	}

	public function getPicture(){
		return $this->picture;
	}
}

?>