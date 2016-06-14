<?php
class Lot{
	private $id;
	private $userId;
	private $product;
	private $quantity;
	private $harvestDate;
	private $daysPreserve;
	private $productionMode;
	private $price;
	private $pointOfSale;


	public function __construct(){
		//
	}

	public function getId(){
		return $this->id;
	}

	public function getUserId(){
		return $this->userId;
	}

	public function getProduct(){
		return $this->product;
	}

	public function getQuantity(){
		return $this->quantity;
	}

	public function getHarvestDate(){
		return $this->harvestDate;
	}

	public function getDaysPreserve(){
		return $this->daysPreserve;
	}

	public function getProductionMode(){
		return $this->productionMode;
	}

	public function getPrice(){
		return $this->price;
	}

	public function getPointOfSale(){
		return $this->pointOfSale;
	}
}

?>