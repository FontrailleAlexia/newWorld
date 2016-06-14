<?php

include "inc/main.php";

// Pas connecté
if(!$userManager->isConnected()){
	header('location: login.php'); 
	die;
}

// Vérification d'un compte "Acheteur"
if($_SESSION['userType'] != Enum::USER_BUYER){
	header('location: profile.php'); 
	die;
}

if($orderManager->save($_SESSION["basket"])){
	$_MSG_INFO = "La commande a bien été enregistrée.";
	unset($_SESSION["basket"]);
}else{
	$_MSG_ERROR = "La commande n'a pas été enregistrée.";
}

/*if(!isset($_SESSION["basket"])){
	header('location: buy.php');
}*/

?>

<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="utf-8" />
		<?php include __DIR__."/parts/stylesheets.php";?>
		<title>Confirmation de la commande</title>
	</head>
	
	<body>
		<?php include __DIR__."/parts/header.php";?>
		
		<div class="wrapped container">

			<section>
				<?php include __DIR__."/parts/message.php";?>

				<div class="col-md-12 margin-top-05-percent">
					
				</div>
			</section>
		</div>

		<?php include __DIR__."/parts/footer.php";?>
		<?php include __DIR__."/parts/scripts.php";?>
	</body>
</html>