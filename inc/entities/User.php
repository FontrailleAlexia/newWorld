<?php
class User{
	private $id;
	private $firstname;
	private $lastname;
	private $email;
	private $birthdate;
	private $phone;
	private $nickname;

	private $address;
	private $address2;
	private $postalcode;
	private $city;

	private $password;

	private $type;

	public function __construct(){
		//
	}

	// #################
	// ################# Getters
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

	public function getBirthDate(){
		return $this->birthdate;
	}

	public function getBirthDateString(){
		if($this->birthdate != null)
			return DateTime::createFromFormat('Y-m-d', $this->birthdate)->format('d/m/Y');

		return "";
	}

	public function getPhone(){
		return $this->phone;
	}

	public function getNickname(){
		return $this->nickname;
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


	public function getPassword(){
		return $this->password;
	}


	public function getType(){
		return $this->type;
	}


	// #################
	// ################# Setters
	public function setFirstname($firstname){
		$this->firstname = $firstname;
	}

	public function setLastname($lastname){
		$this->lastname = $lastname;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setBirthDate($birthDate){
		$this->birthdate = $birthDate;
	}

	public function setPhone($phone){
		$this->phone = $phone;
	}

	public function setNickname($nickname){
		$this->nickname = $nickname;
	}


	public function setAddress($address){
		$this->address = $address;
	}

	public function setAddress2($address2){
		$this->address2 = $address2;
	}

	public function setPostalcode($postalcode){
		$this->postalcode = $postalcode;
	}

	public function setCity($city){
		$this->city = $city;
	}


	public function setPassword($password){
		$this->password = $password;
	}


	public function setType($type){
		$this->type = $type;
	}
}
?>