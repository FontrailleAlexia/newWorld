<?php
class Distributor{
	private $id;
	private $firstname;
	private $lastname;
	private $email;
	private $libelle;
	private $activity;
	private $phone;
	private $address;
	private $address2;
	private $postalcode;
	private $city;
	private $user;

	public function __construct(){
		//
	}

	public function getId(){
		return $this->id;
	}

	public function getFirstname(){
		return $this->firstname;
	}

	public function getLastname(){
		return $this->lastname;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getLibelle(){
		return $this->libelle;
	}

	public function getActivity(){
		return $this->activity;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function getAddress(){
		return $this->address;
	}

	public function getAddress2(){
		return $this->address2;
	}

	public function getPostalcode(){
		return $this->postalcode;
	}

	public function getCity(){
		return $this->city;
	}

	public function getUser(){
		return $this->user;
	}
}

?>