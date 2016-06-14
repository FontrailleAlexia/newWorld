<?php
header('Content-Type: application/json');

include "../inc/main.php";

$response = array("error" => true);
/*
if($type != 2){
	$response["error_msg"] = "Vous n'avez pas de compte acheteur, vous ne pouvez vous connecter.";

}*/if (isset($_POST["type"]) && isset($_POST["id"])) {
	$type = $_POST['type'];
	$id = $_POST['id'];
	$response["data"] = [];

	if($type < 2){
		$list = [];

		if($type == 1)
			$list = $categoryManager->findAllFromShelf($id);
		else
			$list = $shelfManager->findAll();

		foreach ($list as $item) {
			$id = $item->getId();
			$response["data"][$id] = [];
			$response["data"][$id]["picture"] = $item->getPicture();
			$response["data"][$id]["libelle"] = $item->getLibelle();
		}

	}else{
		$list = $lotManager->findAllFromCategory($id);

		foreach ($list as $item) {
			$lot = $item;
			$item = $productManager->findProductById($item->getProduct());

			$id = $lot->getId();
			$response["data"][$id] = [];
			$response["data"][$id]["picture"] = $item->getPicture();
			$response["data"][$id]["libelle"] = $item->getLibelle();
			$response["data"][$id]["price"] = $lot->getPrice();
			$response["data"][$id]["quantity"] = $lot->getQuantity();
		}

	}

	$response["error"] = false;
} else {
    // paramètres POST manquants
    $response["error_msg"] = "Paramètres obligatoires manquant!";
}

echo json_encode($response);