<?php
session_start();
include("header.php");
include("connexion/connexion.php");
include("mesFonctions.php");
?>
<html lang="en">
	<head>
		<title>Inscription</title>
		<meta charset=utf8>
		<link rel="stylesheet" href="styles/styles.css" type="text/css"/>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script>
  			$(function() {
    			$( "#datepicker" ).datepicker();
  			});
 		</script>
  		<script type="text/javascript">
			$().ready(function() {

				 $("#cp").autocomplete({
				     source: 'get_cp_list.php',
								 autoFocus: true
				 });

				 $("#town").autocomplete({
				     source: 'get_town_list.php',
									minLength: 3
				 });
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
	<legend class="titre">INSCRIPTION</legend>
		<a href="connexion.php" class="lienConnexion">Déja inscrit?</a>
		<p class="asterisque">Tous les champs marqués d'une * sont obligatoires</p>
		<form name="inscription" action="verificationUser.php" method="POST">
			<table><tr><td align="right">
						<?php if(isset($error['nom'])){echo $error['nom'];} ?>
						<div class="ecriture"><label for="nom">*Nom: </label>
						<input type="text" name="nom" placeholder="Veuillez tapez votre nom" alt="Entrez un nom avec minimum 2 caractères" class="votre" /></div>
					</td></tr><tr><td align="right">
						<?php if(isset($error['prenom'])){echo $error['prenom'];} ?>
						<p class="ecriture"><label for="prenom">*Prénom: </label>
						<input type="text" name="prenom" placeholder="Veuillez tapez votre prénom" class="votre"/></p>
					</td></tr><tr><td align="right">
						<p class="ecriture"><label for="dateNaiss">*Date de naissance: </label>
						<input type="text" name="dateNaiss" placeholder="15/12/1994" id="datepicker" class="votre"/></p>
					</td></tr><tr><td align="right">
						<?php if(isset($error['tel'])){echo $error['tel'];} ?>
						<p class="ecriture"><label for="tel">*Téléphone: </label>
						<input type="text" name="tel" placeholder="0665063363" class="votre"/></p>
					</td></tr><tr><td align="right">
						<?php if(isset($error['email'])){echo $error['email'];} ?>
						<p class="ecriture"><label for="email">*email: </label>
						<input type="email" name="email" placeholder="jdupond@gmail.com" class="votre"/></p>
					</td></tr><tr><td align="right">
						<?php if(isset($error['rue1'])){echo $error['rue1'];} ?>
						<p class="ecriture"><label for="rue1">*Rue 1: </label>
						<input type="text" name="rue1" placeholder="Rue n°1" class="votre"/></p>
					</td></tr><tr><td align="right">
						<?php if(isset($error['rue2'])){echo $error['rue2'];} ?>
						<p class="ecriture"><label for="rue2">Rue 2: </label>
						<input type="text" name="rue2" placeholder="Rue n°2" class="votre"/></p>
					</td></tr><tr><td align="right">
						<?php if(isset($error['cp'])){echo $error['cp'];} ?>
						<p class="ecriture"><label for='codePostal'>Entrez un code postal : </label>
						<input type="text" name="cp" id="cp" size="84" onClick="cfgCP(this);" onBlur="cfgCP(this)" onKeyPress="cfgCP(this)" onFocus="cfgCP(this)" placeholder="Entrez votre code postal" onChange="cfgCP(this)" />
					</td></tr><tr><td align="right">
						<?php if(isset($error['town'])){echo $error['town'];} ?>
						<p class="ecriture"><label for="ville">ou une ville: </label>
						<input type="text" name="town" id="town" size="50" onBlur="cfgTown(this)" onKeyPress="cfgTown(this)" onFocus="cfgTown(this)" placeholder="Entrez votre ville" onSelect="cfgTown(this)" />
					</td></tr><tr><td align="right">
						<?php if(isset($error['departement'])){echo $error['departement'];} ?>
						<label for="departement">ou un département :</label>
						<input type="text" name="departement" placeholder="Entrez votre département" id="departement" size="50" onBlur="cfgDEP(this)" onKeyPress="cfgDEP(this)" onFocus="cfgDEP(this)" />
					</td></tr><tr><td align="right">
						<?php if(isset($error['region'])){echo $error['region'];} ?>
						<label for="region">ou une région :</label>
						<input type="text" name="region" placeholder="Entrez une région" id="region" size="50" />
					</td></tr><tr><td align="right">
						<?php if(isset($error['country'])){echo $error['country'];} ?>
						<label for="country">ou un pays :</label>
						<input type="text" name="country" placeholder="Entrez un pays" id="country" size="50" /><tr><td align="right">
					</td></tr><tr><td align="right">
						<?php if(isset($error['login'])){echo $error['login'];} ?>
						<p class="ecriture"><label for="login">*login: </label>
						<input type="text" name="login" placeholder="Un petit login ?" class="votre"/></p>
					</td></tr><tr><td align="right">	
						<?php if(isset($error['mdp'])){echo $error['mdp'];} ?>
						<p class="ecriture"><label for="mdp">*mot de passe: </label>
						<input type="password" name="mdp1" placeholder="Mot de passe" class="votre"/></p>
					</td></tr><tr><td align="right">	
						<?php if(isset($error['mdp2'])){echo $error['mdp2'];} ?>
						<p class="ecriture"><label for="mdp2">*Confirmation du MDP: </label>
						<input type="password" name="mdp2" placeholder="Veuillez confirmer le mot de passe" class="votre"/></p>
					</td></tr><tr><td align="right">	
						<p class="ecriture">Type : 
						<span class="custom-dropdown custom-dropdown--white">
						<select name="type" class="custom-dropdown__select custom-dropdown__select--white">
						<?php
						$reqTypeUtilisateur="select * from typeUtilisateur;";
						//Exécution de la requête
						$resultat=mysqli_query($laBase,$reqTypeUtilisateur);
						//Tant qu'il y a un résultat
						while($ligne=mysqli_fetch_array($resultat)){
							echo '<option value="'.$ligne['noType'].'">'.$ligne['libelleType'].'</option>';
						}
						?> </select></span>
					</td></tr><tr><td align="right">
						<p class="envoyer"><input type="submit" value="Envoyer"></p></div>
					</td></tr></table>
	</fieldset>
</div>

<script type="text/javascript">
function cfgTown(str) {
	var i = str.value.indexOf("(", 1);
	var j = str.value.indexOf("-", 1);
	var k = str.value.indexOf("*", 1);
	
    if (i != -1) { 
        document.getElementsByName('departement')[0].value = str.value.substr(j+2, k-j-3);
        document.getElementsByName('region')[0].value      = str.value.substr(k+2, 30);
        document.getElementsByName('cp')[0].value          = str.value.substr(i+1, 5);
        document.getElementsByName('town')[0].value        = str.value.substr(0, i-1);
        document.getElementsByName('country')[0].value     = 'FRANCE';
       }
}

function cfgCP(str)
{
    var reg = new RegExp("[0-9]{5}");
	
    if (str.value.length > 5 && reg.test(str.value)) { 
		var ii = str.value.indexOf("(", 1);
		var jj = str.value.indexOf("-", 1);
     	var kk = str.value.indexOf("*", 1);
		
        document.getElementsByName('region')[0].value      = str.value.substr(kk+2, 20);
        document.getElementsByName('departement')[0].value = str.value.substr(jj+2, kk-jj-3);
        document.getElementsByName('town')[0].value        = str.value.substr(ii+1, jj-ii-4);
        document.getElementsByName('cp')[0].value          = str.value.substr(0, 5);
        document.getElementsByName('country')[0].value     = 'FRANCE';
       }
}

function cfgDEP(str)
{
	var ll = str.value.indexOf("-", 1);
	var mm = str.value.indexOf("(", 1);
	
    if (ll != -1) { 
        document.getElementsByName('region')[0].value      = str.value.substr(ll+2, 30);
        document.getElementsByName('departement')[0].value = str.value.substr(0, ll-1);
        document.getElementsByName('country')[0].value     = 'FRANCE';
       }
}

//    document.getElementsByName('cp')[0].focus();
   document.getElementsByName('town')[0].focus();
</script>
	</form>

<?php include "footer_rien.php"; ?>