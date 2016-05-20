<?php
session_start();
include("mesFonctions.php");
if(formulairePoste())
	{
		$error = array();
		
		//vérifiation de la quantité
		if($_POST['quantite'] <= 0){$error["quantite"] = "<p class='message_erreur'>Attention, la <b>quantité</b> ne peut être inférieur ou égal à 0</p>";}
		
		//vérification du prix du lot
		if($_POST['prixLot'] <= 0){$error['prixLot'] = "<p class='message_erreur'>Attention, le <b>prix du lot</b> ne peut être inférieur ou égal à 0</p>";}
 			
		if($_POST['mdp1']!=$_POST['mdp2']){ $error['mdp2'] = "<p class='message_erreur'>Les <b>mot de passe</b> ne correspondent pas</p>";}
		if(count($error) == 0){
		// Activation de la gestion des erreurs via exceptions
		mysqli_report(MYSQLI_REPORT_STRICT);
 
		try{
   			try{
      			$link = new mysqli('localhost', 'root', '', 'newworld');
   			}
   			catch(mysqli_sql_exception $e){
      			throw new RuntimeException('Failed to connect', 0, $e);
   			}
   			$link->set_charset('utf8');
   		// Et on continue ici toutes les requêtes et leurs traitements
		}
		catch(mysqli_sql_exception $e){
   			printf('Erreur SQL %s : %s', $e->getCode(), $e->getMessage()); // ou autre comportement
		}
		catch(Exception $e){
   			echo $e->getMessage();
   			if(!is_null($e->getPrevious())){
      			echo "\n" . $e->getPrevious()->getMessage();
   			}
		}
				#############################################
				########## ENREGISTREMENT DANS LA BASE ######
				#############################################
				$sql="SELECT ifnull(max(idLot)+1,100) FROM lot";
				$curseur=mysqli_query($laBase,$sql);
				$tabValeur=mysqli_fetch_array($curseur,MYSQLI_NUM);
				$prochainID=$tabValeur[0];
			 	//formation de la requête d'insertion
			 	$sql="INSERT INTO lot(idLot,dateLot,modeProductionLot,nbJourConservationLot,prixLot,qttMinimaleLot,uniteMesure,noProduit,noUser)
			 	VALUES(
			 	$prochainID,'"
				.date('Y-m-d',strtotime($_POST['dateRecolte']))."','"
				.$_POST['modeProduction']."','"
				.$_POST['nbJourConservation']."','"
				.$_POST['prixLot']."','"
				.$_POST['quantite']."','"
				.$_POST['unite']."','"
				.$_POST['noProduit']."','"
				.$_POST['noUser']."')";
				//on execute la requête d'information
				if(mysqli_query($laBase,$sql)){
					header('Location: bienvenue.php?nom='.$_POST['nom'].'&prenom='.$_POST['prenom']);
				}else {
					echo "Erreur 500";
				}
			}
			else {
				$_SESSION['error'] = $error;
				header('Location: saisieLot.php?error=1');
			}
		} else {
		header('Location: saisieLot.php?error=empty');
}
		?>