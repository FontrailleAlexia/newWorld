<?php
require "db.class.php";
$DB = new DB();
require "panier.class.php";
$panier = new panier($DB);
$json=array('error' => true);
//si le num existe
if(isset($_GET['num'])){
	$prod=$DB->query('SELECT num FROM lot, produit WHERE num=:num', array('num' => $_GET['num']));
	//si le produit n'existe pas
	if(empty($prod)){
	$json['message']="<h1>Ce produit n'existe pas</h1>";
	}
	$panier->add($prod[0]->num);
	$json['error']=false;
	$json['total']=$panier->total();
	$json['count']=$panier->count();
	$json['message']='Le produit a bien été ajouté a votre panier';
}else{
	$json['message']="<h1>Vous n'avez pas sélectionné de produit à ajouter au panier</h1>";
}

echo json_encode($json);
?>