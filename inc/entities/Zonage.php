<?php
class Zonage{
	private $id;
	private $postalcode;
	private $city;
	private $country;

	public function __construct(){
		//
	}

	public function getId(){
		return $this->id;
	}

	public function getPostalcode(){
		return $this->postalcode;
	}

	public function getCity(){
		return $this->city;
	}

	public function getCountry(){
		return $this->country;
	}
}

?>