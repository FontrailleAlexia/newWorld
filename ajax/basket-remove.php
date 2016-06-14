<?php
include "../inc/main.php";

$data = ['success' => 'fail',
		 'quantity' => 0,
		 'total' => 0];

if($userManager->isConnected()){ // Connecter
	if($_SESSION['userType'] == Enum::USER_BUYER){ // Compte "Acheteur"
		if(isset($_POST['lot'])){ // Présence du lot dans le panier
			$lot = $_SESSION["basket"]["lots"][$_POST['lot']];
			if(isset($lot)){ // 
				$_SESSION["basket"]["quantity"] -= $lot["quantity"];
				$_SESSION["basket"]["total"] -= $lot["price"];

				$data["total"] = $_SESSION["basket"]['total'];
				$data["quantity"] = $_SESSION["basket"]['quantity'];

				unset($_SESSION["basket"]["lots"][$_POST['lot']]);
				$data["success"] = 'ok';
			}

		}else{
			$_SESSION["basket"]["lots"] = [];
			$_SESSION["basket"]["quantity"] = 0;
			$_SESSION["basket"]["total"] = 0;
			$data["success"] = 'ok';
		}
	}
}

echo json_encode($data);