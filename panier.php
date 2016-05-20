<?php require "_header.php"; ?>
<html>
<head>
	<title> Mon panier</title>
	<meta charset='utf8'>
	<link rel="stylesheet" href="styles/styles.css" type="text/css"/>
</head>
<body>
	<br><br><br><br><br><br>
	<div class="checkout">
		<div class="title">
			<div class="wrap">
				<h2 class="first">Mon panier</h2>
			</div>
		</div>
		<form method="POST" action="">
			<table class="rowtitle" border="1">
				<tr>
					<div class="rowtitle">
						<th><span class="photo"></th>
						<th><span class="name">Nom du produit</span></th>
						<th><span class="price">Prix</span></th>
						<th><span class="quantity">Quantité</span></th>
						<th><span class="subtotal">Prix avec TVA</span></th>
						<th><span class="action">Action</span></th>
					</div>
				</tr>
				<?php 

				//récupérer les clés du tableau
				$id=array_keys($_SESSION['panier']);
				if(empty($id)){
					$produit=array();
					?>
					<tr><td colspan="6">Il n'y a aucun produit dans votre panier, pensez a le remplir :3 </td></tr>
					<?php
				}else{
					$id = array_filter($id);

					$produit=$DB->query('SELECT produit.num, produit.libelleProd, surType.libelleSurType, surType.no, produit.prixProd FROM produit inner join type on produit.noType = type.no inner join surType on surType.no = type.noSurType WHERE surType.no = type.noSurType AND produit.noType = type.no AND num IN ('.implode(',',$id).')');
					foreach($produit as $prod): ?>
					<tr>
						<div class="row">
							<td><img class="image_produit" src="images/img_produit/<?php echo $prod->num; ?>.png" /></td>
							<td><span class="name"><?php echo $prod->libelleProd ?></span></td>
							<td><span class="price"><?php echo number_format($prod->prixProd,2,',',' '); ?>€</span></td>
							<td><span class="quantity"><input type="text" name="panier[quantity][<?php echo $prod->num; ?>]" value="<?php echo $_SESSION['panier'][$prod->num]; ?>" width='30'></span></td>
							<td><span class="Subtotal"><?php echo number_format($prod->prixProd*1.196,2,',',' '); ?>€</span></td>
							<td><span class="action">
								<a href="panier.php?delPanier=<?php echo $prod->num; ?>" class="del"><img class="delete" src="images/supprimer.png"></a>
							</span></td>
						</div>
					</tr>
				<?php endforeach; 
				}
				?>
				
				
			</table>
			<div class="rowtotal">
				<span class="total">Total : <?php echo number_format($panier->total(),2,',',' '); ?></span>
			</div>
			<input type="submit" value="Recalculer">
			<input type="submit" value="Commander">
			<?php
			//$vider = vider_panier();
			//Panier <?php echo($vider?"vidé":"encore plein"); ?>.
			?>
		</form>

<?php require "footer_rien.php"; ?>