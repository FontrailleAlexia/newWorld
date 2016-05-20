<?php require "_header.php"; ?>
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
			$categorie=$DB->query('SELECT * FROM surtype');?>
			<?php foreach($categorie as $categ): ?>
				<a href="typeProduits.php?id_surtype=<?php echo $categ->no;?>">
				<fieldset class="fieldset_produit">
					<img class="image_produit" src="images/img_categorie/<?php echo $categ->no; ?>.png" />
					<?php echo $categ->libelleSurType; ?>
				</fieldset>
				</a>
			<?php endforeach ?>
		</div>

<?php
	require "footer_acheter.php";
	require "footer_rien.php";
?>