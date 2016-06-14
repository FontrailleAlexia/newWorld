<?php
class Category{
	private $id;
	private $libelle;
	private $self;
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

	public function getSelf(){
		return $this->self;
	}

	public function getPicture(){
		return $this->picture;
	}
}

?>