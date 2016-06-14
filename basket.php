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
				
				<div class="col-md-12 margin-top-05-percent">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Mon panier</h3>
						</div> 
						<div class="panel-body">
							<table class="table basket-table">
								<thead>
									<tr>
										<th>Produit</th>
										<th>Nom</th>
										<th>Quantité</th>
										<th>Prix</th>
										<th>Actions</th>
									</tr> 
								</thead>

								<tbody>
									<?php foreach ($_SESSION["basket"]["lots"] as $id => $lot) { ?>
										<tr data-id="<?php echo $id; ?>">
											<td><img width="80" src="<?php echo $lot["picture"]; ?>" alt="Produit" /></td>
											<td><?php echo $lot["name"]; ?></td>
											<td><?php echo $lot["quantity"]; ?></td>
											<td><?php echo $lot["price"]; ?> €</td>
											<td><span class="glyphicon glyphicon-trash cursor-pointer" aria-hidden="true"></span></td>
										</tr>
									<?php } ?>

										<tr>
											<td></td>
											<td></td>
											<td><span id="basket-quantity"><?php echo $_SESSION["basket"]['quantity']; ?></span></td>
											<td><span id="basket-total"><?php echo $_SESSION["basket"]['total']; ?></span> €</td>
											<td></td>
										</tr>
								</tbody>
							</table>

							<div class="pull-right">
								<a class="btn btn-danger">Vider le panier</a>
								<a href="confirmOrder.php" class="btn btn-success">Passer commande</a>
							</div>
						</div>
					</div> 
				</div>
			</section>
		</div>
		<input type="button" class="col-md-offset-8 btn btn-info" value="Retour en arrière" onClick="window.history.back()">

		<?php include __DIR__."/parts/footer.php";?>
		<?php include __DIR__."/parts/scripts.php";?>
	</body>
</html>