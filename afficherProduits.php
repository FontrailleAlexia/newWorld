<?php require "_header.php"; 
if(isset($_GET['id_type'])){
	$no_type = $_GET['id_type'];
}else {
	header('Location: acheter.php');
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Acheter</title>
		<link rel="stylesheet" href="styles/styles.css" type="text/css"/>
		<meta charset='utf8'>
	</head>
	<body>
		<br><br><br><br><br><br><br><br><br>
		<div class="row">
			<?php

			//création de la requête
			$produits=$DB->query('SELECT produit.prixProd,produit.num,produit.libelleProd FROM produit inner join type on type.no = produit.noType WHERE type.no = ? order by num', array($no_type));?>
			<?php foreach($produits as $prod): ?>
				<fieldset class="fieldset_produit">
					<img class="image_produit" src="images/img_produit/<?php echo $prod->num; ?>.png" />
					<?php echo $prod->libelleProd; ?>
					<a href="#" class="price_acheter"><?php echo number_format($prod->prixProd,2,',',' '); ?></a>
					<a class="add addPanier" href="addpanier.php?num=<?php echo $prod->num; ?>"><img class="add" src="images/plus.png"></a>
				</fieldset>
			<?php endforeach ?>
		</div>

<?php
	require "footer_acheter.php";
	require "footer_rien.php";
?>