<?php
include("connexion/connexion.php");
session_start();
include("header.php");
include("mesFonctions.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Saisie des Lots</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="styles/styles.css" type="text/css"/>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.ui/1.8.10/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
        <link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />
        
		<link rel="stylesheet" href="styles/jquery-ui.css"/>

		<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>

		<script type="text/javascript" src="js/clone-form-td-multiple.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

        <script>
  			$(function() {
    			$( "#datepicker" ).datepicker();
  			});
  		</script>
	</head>
	<body>
	<?php
	if(isset($_GET['error']) && $_GET['error']==1){
		$error = $_SESSION['error'];
	}
	?>
	<div class="fond_blanc">
	<fieldset>
	<legend class="titre">SAISIE DES LOTS</legend>
		<p class="asterisque">Tous les champs marqués d'une * sont obligatoire</p>
		<form name="SaisieLot" action="" method="POST">
					<table><tr><td align="right">
								<?php if(isset($error['catégorie'])){echo $error['categorie'];} ?>
								<div class="ecriture"><label for="categorie">*Categorie: </label>
								<select name='categorie' class='votre' id='categorie' onchange='updateSelectProduits()'></div>
								<?php
								//Requete d'affichage des surType
								$reqSurType="select * from surType;";
								//Exécution de la requête
								$resultat=mysqli_query($laBase,$reqSurType);
								//Tant qu'il y a un résultat
								while($ligne=mysqli_fetch_array($resultat))
								{
									//Affichage des surType dans le optgroup
									?><optgroup label="<?=$ligne["libelleSurType"]?>"><?php
									//On récupère le no du surType
									$noSurType=$ligne["no"];
									//Requete d'affichage des type
									$reqTypeP="select * from type where noSurType=$noSurType;";
									//Exécution de la requête
									$resultat2=mysqli_query($laBase,$reqTypeP);
									//Tant qu'il y a un résultat
									while($ligne2=mysqli_fetch_array($resultat2))
									{
										$noTypeP=$ligne2["no"];
										//Affichage du typeP dans la balise option
										?><option value='<?=$noTypeP?>'><?=$ligne2["libelleType"]?></option><?php
									}
								}
								echo "</select><input type='submit' name='ajoutCategorie' value='Choisir le produit'></form></p><form name='formulaire' method='POST' action=''>";
								if(isset($_POST['ajoutCategorie']))
								{
									echo "<p><label for='produit'>*Produit</label><select name='produit' class='votre' id='produit'>";
									$noTypeP=$_POST['categorie'];
									//REQUETE
									$req="select libelleProd from produit where noType=$noTypeP;";
									$result=mysqli_query($laBase,$req);
									while($tab=mysqli_fetch_row($result))
									{
										$produit=$tab[0];
										echo "<option value='<?=$produit?>'";
										if(isset($_POST['produit']) && $produit==$_POST['produit']) echo 'selected';
										echo ">";
										?><?=$produit;
										echo "</option>";
									}
									echo "</select></p>";
								}
								?>
							</td></tr>	
				</form>	
				<form class='align' name='formulaire2' method='POST' action='verificationUserSaisieLot.php'>
						<tr><td align="right">
								<?php if(isset($error['qttMinimaleLot'])){echo $error['qttMinimaleLot'];} ?>
								<p class="ecriture"><label for="qttMinimaleLot">*Quantité (kg): </label>
								<input type="number" min="0" name="qttMinimaleLot" placeholder="Veuillez tapez votre quantité" class="votre"/></p>
							</td></tr><tr><td align="right">
								<?php if(isset($error['dateLot'])){echo $error['dateLot'];} ?>
								<p class="ecriture"><label for="dateLot">*Date de récolte/production: </label>
								<input type="text" name="dateLot" id="datepicker" placeholder="date de recolte" class="votre"/></p>
							</td></tr><tr><td align="right">
								<?php if(isset($error['modeProductionLot'])){echo $error['modeProductionLot'];} ?>
								<p class="ecriture"><label for="modeProductionlot">*Mode de production: </label>
								<span class="custom-dropdown custom-dropdown--white">
								<select name="modeProductionLot" class="custom-dropdown__select custom-dropdown__select--white">
								<?php
								$reqTypeUtilisateur="select * from modeProd;";
								//Exécution de la requête
								$resultat=mysqli_query($laBase,$reqTypeUtilisateur);
								//Tant qu'il y a un résultat
								while($ligne=mysqli_fetch_array($resultat)){
									echo '<option value="'.$ligne['id'].'">'.$ligne['mode'].'</option>';
								}
								?> </select></span></p>
							</td></tr><tr><td align="right">
								<?php if(isset($error['nbJourConservation'])){echo $error['nbJourConservation'];} ?>
								<p class="ecriture"><label for="nbJourConservation">*Nombre de jour de conservation: </label>
								<input type="number" min="0" name="nbJourConservation" placeholder="nombre de jour"" class="votre"/></p>
							</td></tr><tr><td align="right">	
								<p class="ecriture"><label for="prixLot">*Prix unitaire: </label>
								<input type="number" min="0" name="prixLot" step="0.01" placeholder='prix du lot' class="votre"/></p>
							</td></tr><tr><td align="right">
								<p class="ecriture"><label for="pointDeVente">*Point de vente: </label>
								<input type="text" name="login" list='listeDesPointsDeVente' placeholder='point de vente' class="votre"/></p>
							</td></tr><tr><td align="right">
								<p class="envoyer"><input type="submit" value="Envoyer"></p></div>
							</td></tr></table>
	</div>
</form>

<?php include "footer_rien.php"; ?>