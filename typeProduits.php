<?php require "_header.php";
if(isset($_GET['id_surtype'])){
	$no_type = $_GET['id_surtype'];
}else {
	header('Location: acheter.php');
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Type Produits</title>
		<link rel="stylesheet" href="styles/styles.css" type="text/css"/>
		<meta charset='utf8'>
	</head>
	<body>
		<br><br><br><br><br><br><br><br><br>
		<div class="row">
			<?php
			
			//création de la requête
			$types=$DB->query('SELECT * FROM type WHERE noSurType = ?',array($no_type));?>
			<?php foreach($types as $type): ?>
				<a href="afficherProduits.php?id_type=<?php echo $type->no;?>">
				<fieldset class="fieldset_produit">
					<img class="image_produit" src="images/img_categorie/<?php echo $type->no; ?>.png" />
					<?php echo $type->libelleType; ?>
				</fieldset>
				</a>
			<?php endforeach ?>
		</div>

<?php
	require "footer_acheter.php";
	require "footer_rien.php";
?>