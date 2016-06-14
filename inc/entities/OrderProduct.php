<?php
class OrderProduct{
	private $id;
	private $orderId;
	private $productId;
	private $price;
	private $quantity;

	public function __construct(){
		//
	}

	public function getId(){
		return $this->id;
	}

	public function getOrderId(){
		return $this->orderId;
	}

	public function getProductId(){
		return $this->productId;
	}

	public function getPrice(){
		return $this->price;
	}

	public function getQuantity(){
		return $this->quantity;
	}
}

?>