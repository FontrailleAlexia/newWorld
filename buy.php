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

$items = [];
$param = "shelf=";

if(isset($_GET['shelf'])){
	$items = $categoryManager->findAllFromShelf($_GET['shelf']);
	$param = "category=";

} else if(isset($_GET['category'])){
	$items = $lotManager->findAllFromCategory($_GET['category']);

} else{
	$items = $shelfManager->findAll();
}


// Initialise le panier
if(!isset($_SESSION["basket"])){
	$_SESSION["basket"] = [];
	$_SESSION["basket"]['total'] = 0;
	$_SESSION["basket"]['quantity'] = 0;
	$_SESSION["basket"]['lots'] = [];
}
?>

<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="utf-8" />
		<?php include __DIR__."/parts/stylesheets.php";?>
		<title>Acheter</title>
	</head>
	
	<body>
		<?php include __DIR__."/parts/header.php";?>
		
		<div class="wrapped container">

			<section>
				<?php include __DIR__."/parts/message.php";?>
				
				<div class="col-md-2 col-md-offset-10 basket">
					<a href="basket.php">
						<img src="images/basket.png" alt="Panier" width="50" class="center-block"/>
					</a>

					<ul class="margin-top-05"> 
						<li>Quantité : <strong><span id="basket-quantity"><?php echo $_SESSION["basket"]['quantity']; ?></span></strong></li>
						<li>Total : <strong><span id="basket-total"><?php echo $_SESSION["basket"]['total']; ?></span>€</strong></li>
					</ul>
				</div>

				<div class="col-md-12 margin-top-05-percent">
					<?php foreach ($items as $item) {
						$lot = null;
						if(isset($_GET['category'])){
							$lot = $item;
							$item = $productManager->findProductById($item->getProduct());

						}else{?>
						<a href="?<?php echo $param . $item->getId();?>">
						<?php }?>

							<div class="col-md-3 buy-item text-center">
								<?php if($lot != null){?>
								<div class="price">
									<span class="badge"><?php echo $lot->getPrice();?> €</span>
								</div>
								<?php }?>

								<div class="row">
									<img src="<?php echo $item->getPicture();?>" alt="<?php echo $item->getLibelle();?>" />
								</div>

								<div class="row">
									<h4><?php 
										echo $item->getLibelle();
										if($lot != null){
											echo " X" . $lot->getQuantity();
										}
									?></h4>
								</div>

								<?php if($lot != null){?>
								<div class="add-button">
									<img data-id="<?php echo $lot->getId();?>" src="images/plus.png" title="Ajouter ce produit" alt="Plus" />
								</div>
								<?php }?>
							</div>

						<?php if(!isset($_GET['category'])){?>
						</a>
						<?php }?>
					<?php }?>
				</div>
				<input type="button" class="col-md-offset-8 btn btn-info" value="Retour en arrière" onClick="window.history.back()">
			</section>
		</div>

		<?php include __DIR__."/parts/footer.php";?>
		<?php include __DIR__."/parts/scripts.php";?>
	</body>
</html>