<?php
class Order{
	private $id;
	private $quantity;
	private $price;
	private $userId;
	private $date;

	public function __construct(){
		//
	}

	public function getId(){
		return $this->id;
	}

	public function getQuantity(){
		return $this->quantity;
	}

	public function getPrice(){
		return $this->price;
	}

	public function getUserId(){
		return $this->userId;
	}

	public function getDate(){
		return $this->date;
	}
}

?>