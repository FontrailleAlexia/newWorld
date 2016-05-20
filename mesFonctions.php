<?php 
//Inclusion de connexion
include ("connexion/connexion.php");

######################################
################### LOT ##############
######################################

//Si un des champs n'est pas rempli
function formulairePoste()
{
	if(!empty($_POST['categorie'])){return false;}
	if(!empty($_POST['produit'])){return false;}
	if(!empty($_POST['quantite'])){return false;}
	if(!empty($_POST['unite'])){return false;}
	if(!empty($_POST['dateRecolte'])){return false;}
	if(!empty($_POST['modeProduction'])){return false;}
	if(!empty($_POST['nbJourConservation'])){return false;}
	if(!empty($_POST['prixLot'])){return false;}
	if(!empty($_POST['pointDeVente'])){return false;}
	return true;
}

##########################################
############## UTILISATEUR ###############
##########################################

//Si un des champs n'est pas rempli
function formulairePosteUser()
{
	if(empty($_POST['nom'])){return false;}
	if(empty($_POST['prenom'])){return false;}
	if(empty($_POST['dateNaiss'])){return false;}
	if(empty($_POST['tel'])){return false;}
	if(empty($_POST['email'])){return false;}
	if(empty($_POST['rue1'])){return false;}
	if(empty($_POST['cp'])){return false;}
	if(empty($_POST['ville'])){return false;}
	if(empty($_POST['login'])){return false;}
	if(empty($_POST['mdp1'])){return false;}
	if(empty($_POST['mdp2'])){return false;}
	if(empty($_POST['type'])){return false;}
	return true;
}

function envoieMail()
{
	$mail = 'roxy.diesel@hotmail.fr'; // Déclaration de l'adresse de destination.
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)){
		$passage_ligne = "\r\n";
	} else {
		$passage_ligne = "\n";
	}
	//=====Déclaration des messages au format texte et au format HTML.
	$message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
	$message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
	//==========
	//=====Lecture et mise en forme de la pièce jointe.
	$fichier   = fopen("images/image.jpg", "r");
	$attachement = fread($fichier, filesize("images/image.jpg"));
	$attachement = chunk_split(base64_encode($attachement));
	fclose($fichier);
	//=====Création de la boundary.
	$boundary = "-----=".md5(rand());
	$boundary_alt = "-----=".md5(rand());
	//=====Définition du sujet.
	$sujet = "Hey mon ami !";
	//=====Création du header de l'e-mail.
	$header = "From: \"WeaponsB\"<weaponsb@mail.fr>".$passage_ligne;
	$header.= "Reply-to: \"WeaponsB\" <weaponsb@mail.fr>".$passage_ligne;
	$header.= "MIME-Version: 1.0".$passage_ligne;
	$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
	//=====Création du message.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
	$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
	//=====Ajout du message au format texte.
	$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;
	$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
	//=====Ajout du message au format HTML.
	$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;
	//=====On ferme la boundary alternative.
	$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
	$message.= $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout de la pièce jointe.
	$message.= "Content-Type: image/jpeg; name=\"image.jpg\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
	$message.= "Content-Disposition: attachment; filename=\"image.jpg\"".$passage_ligne;
	$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	//=====Envoi de l'e-mail.
	mail($mail,$sujet,$message,$header);
	//==========
}

//Fonction vérification date
function VerifierDateValide($Date){
    $Date=explode("/",$Date);
    if (checkdate($Date[0], $Date[1], $Date[2])){
        return true;
    }
    else{
        return false;
    }
}
?>