<?php
include "../inc/main.php";

/* ############################################
##### AJOUTER UN LOT DANS LE PANIER ###########
###############################################*/

$data = ['success' => 'fail', 
		 'quantity' => 0,
		 'total' => 0];

if($userManager->isConnected()){ // Connecter
	if($_SESSION['userType'] == Enum::USER_BUYER){ // Compte "Acheteur"
		if(isset($_POST['lot'])){ // Présence de l'attribut "lot"
			

			$lot = $lotManager->findLotById($_POST['lot']);
			if($lot != null){ // Le lot existe et a correctement été récupéré
				$id_lot = $_POST['lot'];
				$product = $productManager->findProductById($lot->getProduct());

				// Initialise le lot
				if(!isset($_SESSION["basket"]["lots"][$_POST['lot']])){
					$_SESSION["basket"]["lots"][$id_lot] = [];
					$_SESSION["basket"]["lots"][$id_lot]['picture'] = $product->getPicture();
					$_SESSION["basket"]["lots"][$id_lot]['price'] = 0;
					$_SESSION["basket"]["lots"][$id_lot]['name'] = $product->getLibelle();
					$_SESSION["basket"]["lots"][$id_lot]['quantity'] = 0;
					$_SESSION["basket"]["lots"][$id_lot]['idProduct'] = $product->getId();
				}

				$_SESSION["basket"]["lots"][$id_lot]['price'] += $lot->getPrice();
				$_SESSION["basket"]["lots"][$id_lot]['quantity']++;

				$_SESSION["basket"]['quantity']++;
				$_SESSION["basket"]['total'] += $lot->getPrice();

				$data["total"] = $_SESSION["basket"]['total'];
				$data["quantity"] = $_SESSION["basket"]['quantity'];
				$data["success"] = 'ok';
			}
		}
	}
}

echo json_encode($data);