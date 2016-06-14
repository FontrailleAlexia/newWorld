<?php
class PdoOrderManager extends AbstractPdoManager{
	public function __construct(){
		parent::__construct();
	}

	public function save($basket){
		$this->PDO->beginTransaction();

		try{
			$stm = $this->PDO->prepare("INSERT INTO `order` (quantity,price,userId,date) VALUES (
				:quantity,
				:price,
				:userId,
				NOW())");

			$stm->bindValue(':quantity', $basket['quantity']);
			$stm->bindValue(':price', $basket['total']);
			$stm->bindValue(':userId', $_SESSION['id']);
			$stm->execute();

			$orderId = $this->PDO->lastInsertId();
			foreach ($basket["lots"] as $productId => $lot) {
				$stm = $this->PDO->prepare("INSERT INTO `orderproduct` (orderId,productId,price,quantity) VALUES (
					:orderId,
					:productId,
					:price,
					:quantity)");	

				$stm->bindValue(':orderId', $orderId);
				$stm->bindValue(':productId', $productId);
				$stm->bindValue(':price', $lot["price"]);
				$stm->bindValue(':quantity', $lot["quantity"]);
				$stm->execute();
			}

			$this->PDO->commit();
			return true;

		}catch(Exception $e){
			echo $e->getMessage();
			$this->PDO->rollback();
			return false;
		}
	}

/*
	public function search($query){
		$stm = $this->PDO->prepare("SELECT * FROM orderProduct WHERE orderProduct LIKE :query ORDER BY orderProduct LIMIT 12");
		$stm->bindValue(':query', $query . "%");
		$stm->execute();

		$stm->setFetchMode(PDO::FETCH_CLASS, 'Zonage');
		return $stm->fetchAll();
	}*/
}