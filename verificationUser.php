<?php
session_start();
include("mesFonctions.php");
foreach ($_POST as $v){
    $v = trim($v);
}
$error = array();
if(empty($_POST['nom'])){
    $error["nom"] = "<p>ce champ est requis</p>";
} else {
    if(strlen($_POST["nom"]) < 3) {
        $error["nom"] = "<p class='message_erreur'>Attention, le <b>nom</b> n'a pas été rempli ou ne peut comporter moins de 3 caractères</p>";
    }
}
if(empty($_POST['prenom'])){
    $error["prenom"] = "<p>ce champ est requis</p>";
} else {
    if(strlen($_POST["prenom"]) < 3) {
        $error["prenom"] = "<p class='message_erreur'>Attention le prénom n'a pas été rempli ou ne peut comporter moins de 3 caractères</p>";
    }
}
if(empty($_POST['dateNaiss'])){
    $error["dateNaiss"] = "<p>ce champ est requis</p>";
}
if(empty($_POST['tel'])){
    $error["tel"] = "<p>ce champ est requis</p>";
} else {
    $test = str_replace([" ", ".", "-", "/"], "", $_POST["tel"]);
    if(strlen($test) < 10) {
        $error["tel"] = "<p class='message_erreur'>la saisie du <b>telephone</b> n'est pas valide</p>";
    }
}
if(empty($_POST['email'])){
    $error["email"] = "<p>ce champ est requis</p>";
} else {
    if(!preg_match("/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/", $_POST["email"])) {
        $error["email"] = "<p class='message_erreur'>Adresse email invalide</p>";
    }
}
if(empty($_POST['rue1'])){
    $error["rue1"] = "<p>ce champ est requis</p>";
}
if(empty($_POST['cp'])){
    $error["codePostal"] = "<p>ce champ est requis</p>";
}
if(empty($_POST['town'])){
    $error["town"] = "<p>ce champ est requis</p>";
}
if(empty($_POST['login'])){
    $error["login"] = "<p>ce champ est requis</p>";
}
if(empty($_POST['mdp1'])){
    $error["mdp1"] = "<p>ce champ est requis</p>";
} else {
    if(strlen($_POST['mdp1']) < 6) {
        $error["mdp1"] = "<p class='message_erreur'>Vous devriez avoir un <b>mot de passe</b> un peu plus difficile</p>";
    }
}
if(empty($_POST['mdp2'])){
    $error["mdp2"] = "<p>ce champ est requis</p>";
} else {
    if(!empty($_POST["mdp1"])) {
        if ($_POST['mdp1'] != $_POST['mdp2']) {
            $error['mdp2'] = "<p class='message_erreur'>Les <b>mot de passe</b> ne correspondent pas</p>";
        }
    }
}
if(empty($_POST['type'])){
    $error["type"] = "<p>ce champ est requis</p>";
}

if (count($error) == 0) {
    // Activation de la gestion des erreurs via exceptions
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        try {
            $link = new mysqli('localhost', 'root', '', 'newworld');
        } catch (mysqli_sql_exception $e) {
            throw new RuntimeException('Failed to connect', 0, $e);
        }
        $link->set_charset('utf8');
        // Et on continue ici toutes les requêtes et leurs traitements
    } catch (mysqli_sql_exception $e) {
        printf('Erreur SQL %s : %s', $e->getCode(), $e->getMessage()); // ou autre comportement
    } catch (Exception $e) {
        echo $e->getMessage();
        if (!is_null($e->getPrevious())) {
            echo "\n".$e->getPrevious()->getMessage();
        }
    }
    #############################################
    ########## ENREGISTREMENT DANS LA BASE ######
    #############################################
    $sql = "SELECT ifnull(max(idUser)+1,100) FROM utilisateur";
    $curseur = mysqli_query($laBase, $sql);
    $tabValeur = mysqli_fetch_array($curseur, MYSQLI_NUM);
    $prochainID = $tabValeur[0];
    //formation de la requête d'insertion
    $sql = "INSERT INTO utilisateur(idUser,nomUser,prenomUser,dateNaiss,telUser,emailUser,rue1User,rue2User,CP,ville,pseudoUser,mdpUser,typeUser)
        VALUES(
        $prochainID,'"
        .$_POST['nom']."','"
        .$_POST['prenom']."','"
        .date('Y-m-d', strtotime($_POST['dateNaiss']))."','"
        .$_POST['tel']."','"
        .$_POST['email']."','"
        .$_POST['rue1']."','"
        .$_POST['rue2']."','"
        .$_POST['cp']."','"
        .$_POST['town']."','"
        .$_POST['login']."','"
        .$_POST['mdp1']."','"
        .$_POST['type']."')";
    //on execute la requête d'information
    if (mysqli_query($laBase, $sql)) {
        header('Location: bienvenue.php?nom='.$_POST['nom'].'&prenom='.$_POST['prenom']);
    } else {
        echo "Erreur 500";
    }
} else {
    print_r("ok");
    $_SESSION['error'] = $error;
    header('Location: inscription.php?error=1');
}
/*session_start();
include("mesFonctions.php");
if(formulairePosteUser())
{
	$error = array();
	//vérification du nom
	$caracteresNom = strlen($_POST['nom']);
	if($caracteresNom < 3)
	{
		$error["nom"] = "<p class='message_erreur'>Attention, le <b>nom</b> n'a pas été rempli ou ne peut comporter moins de 3 caractères</p>";
	}
	//vérification du prénom
	$caracteresPrenom = strlen($_POST['prenom']);
	if($caracteresPrenom < 3)
	{
		$error["prenom"] = "<p class='message_erreur'>Attention le prénom n'a pas été rempli ou ne peut comporter moins de 3 caractères</p>";
	}
	//vérification du téléphone
	$caracteresTelephone = strlen($_POST['tel']);
	if($caracteresTelephone < 10)
	{
		$error['tel'] = "<p class='message_erreur'>la saisie du <b>telephone</b> n'est pas valide</p>";
	}
	//vérification de l'email
	$email = $_POST['email'];
	$point = strpos($email,".");
	$aroba = strpos($email,"@");
	if(!$point||!$aroba)
	{	
		$error['email'] = "<p class='message_erreur'>Votre email doit comporter un <b>point</b> ou un <b>'@'</b></p>"; 
	}
	$caracteresMDP = strlen($_POST['mdp1']);
	if($caracteresMDP < 6)
	{ 
		$error['mdp'] =  "<p class='message_erreur'>Vous devriez avoir un <b>mot de passe</b> un peu plus difficile</p>";
	}
	if($_POST['mdp1']!=$_POST['mdp2'])
	{ 
		$error['mdp2'] = "<p class='message_erreur'>Les <b>mot de passe</b> ne correspondent pas</p>";
	}
	if(count($error) == 0)
	{
		// Activation de la gestion des erreurs via exceptions
		mysqli_report(MYSQLI_REPORT_STRICT);
		try
		{
			try
			{ 
				$link = new mysqli('localhost', 'root', '', 'newworld'); 
			}
			catch(mysqli_sql_exception $e)
			{
				throw new RuntimeException('Failed to connect', 0, $e);
			}
			$link->set_charset('utf8');
			// Et on continue ici toutes les requêtes et leurs traitements
		}
		catch(mysqli_sql_exception $e)
		{
			printf('Erreur SQL %s : %s', $e->getCode(), $e->getMessage()); // ou autre comportement
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			if(!is_null($e->getPrevious()))
			{
   				echo "\n" . $e->getPrevious()->getMessage();
   			}
		}
		#############################################
		########## ENREGISTREMENT DANS LA BASE ######
		#############################################
		$sql="SELECT ifnull(max(idUser)+1,100) FROM utilisateur";
		$curseur=mysqli_query($laBase,$sql);
		$tabValeur=mysqli_fetch_array($curseur,MYSQLI_NUM);
		$prochainID=$tabValeur[0];
	 	//formation de la requête d'insertion
	 	$sql="INSERT INTO utilisateur(idUser,nomUser,prenomUser,dateNaiss,telUser,emailUser,rue1User,rue2User,CP,ville,pseudoUser,mdpUser,typeUser)
	 	VALUES(
	 	$prochainID,'"
		.$_POST['nom']."','"
		.$_POST['prenom']."','"
		.date('Y-m-d',strtotime($_POST['dateNaiss']))."','"
		.$_POST['tel']."','"
		.$_POST['email']."','"
		.$_POST['rue1']."','"
		.$_POST['rue2']."','"
		.$_POST['cp']."','"
		.$_POST['ville']."','"
		.$_POST['login']."','"
		.$_POST['mdp1']."','"
		.$_POST['type']."')";
		//on execute la requête d'information
		if(mysqli_query($laBase,$sql))
		{
			header('Location: bienvenue.php?nom='.$_POST['nom'].'&prenom='.$_POST['prenom']);
		}
		else 
		{ 
			echo "Erreur 500"; 
		}
	}
	else
	{
		$_SESSION['error'] = $error;
		header('Location: inscription.php?error=1');
	}
}
else
{
	envoieMail();
	header('Location: inscription.php?error=empty');
}*/
?>