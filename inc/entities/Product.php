<?php
class Product{
	private $id;
	private $category;
	private $libelle;
	private $picture;


	public function __construct(){
		//
	}

	public function getId(){
		return $this->id;
	}

	public function getCategory(){
		return $this->category;
	}

	public function getLibelle(){
		return $this->libelle;
	}

	public function getPicture(){
		return $this->picture;
	}
}

?>