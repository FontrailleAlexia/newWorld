<?php
session_start();

//Connexion à la base de données

require "connexion.php";
//$maBase = connexion();

$tabRes = array();

//Vérification du pseudo et mot de passe
if(isset($_GET['pseudo']) && isset($_GET['mdp']))
{
	$requete = "SELECT id FROM users WHERE nickname = '".$_GET['pseudo']."' AND password = '".md5($_GET['mdp'])."'";
	$curseur = mysqli_query($laBase,$requete);
	$tabRes = mysqli_fetch_row($curseur);
	echo json_encode($tabRes);
}

//Enregistrement de l'utilisateur
if(isset($_GET['prenom']) && isset($_GET['nom']) && isset($_GET['email']) && isset($_GET['dateNaiss']) && isset($_GET['phone']) && isset($_GET['pseudo']) && isset($_GET['address']) && isset($_GET['address2']) && isset($_GET['CP']) && isset($_GET['mdp']) && isset($_GET['type']))
{
	$requete = "SELECT max(id)+1 FROM users";
	$curseur = mysqli_query($laBase,$requete);
	$id = mysqli_fetch_row($curseur);

	$requete = "INSERT INTO users(id, firstname, lastname, email, birthdate, phone, nickname, address, address2, postalcode, city, md5(password), type)
				VALUES ("
				.$id[0].",'"
				.$_GET['prenom']."','"
				.$_GET['nom']."','"
				.$_GET['email']."','"
				.$_GET['dateNaiss']."','"
				.$_GET['phone']."','"
				.$_GET['pseudo']."','"
				.$_GET['address']."','"
				.$_GET['address2']."','"
				.$_GET['CP']."','"
				.$_GET['city']."','
				password('".$_GET['mdp']."'))"
				.$_GET['type'];
	$curseur = mysqli_query($laBase,$requete);
}

//Vérification de l'email
if(isset($_GET['email']))
{
	$requete = "SELECT id FROM users WHERE email = '".$_GET['email']."'";
	$curseur = mysqli_query($laBase,$requete);
	$id = mysqli_fetch_row($curseur);

	echo json_encode($id);
}
?>
