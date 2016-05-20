<?php
session_start();
//création de la classe panier
class panier{
	//initialisation de la variable
	private $DB;

	public function __construct($DB){
		
		//on crée un panier vide
		if(!isset($_SESSION['panier'])){
			$_SESSION['panier'] = array();
		}
		$this->DB = $DB;
		if(isset($_GET['delPanier'])){
			$this->del($_GET['delPanier']);
		}
		if(isset($_POST['panier']['quantity'])){
			$this->recalc();
		}
	}

	public function recalc(){
		foreach($_SESSION['panier']as $product_id => $quantity){
			if(isset($_POST['panier']['quantity'][$product_id])){
				$_SESSION['panier'][$product_id]=$_POST['panier']['quantity'][$product_id];				
			}
		}
		$_SESSION['panier'] = $_POST['panier']['quantity'];
	}

	//connaitre le nombre d'élément dans le panier
	public function count(){
		return array_sum($_SESSION['panier']);
	}

	//connaitre le prix total du panier
	public function total(){
		//on stocke a 0
		$total=0;
		$id=array_keys($_SESSION['panier']);
		if(empty($id)){
			$produit=array();
			$total = 0;
		}else{
			$id = array_filter($id);
			$produit=$this->DB->query('SELECT produit.prixProd,produit.num,produit.libelleProd FROM produit inner join type on type.no = produit.noType WHERE type.no = produit.noType AND num IN ('.implode(',',$id).')');
			foreach ($produit as $prod) {
				$total+=$prod->prixProd * $_SESSION['panier'][$prod->num];
			}
		return $total;
		}
	}

	//permet d'ajouter un produit
	public function add($product_id){
		if(isset($_SESSION['panier'][$product_id])){
			$_SESSION['panier'][$product_id]++;
		}else{
			$_SESSION['panier'][$product_id]=1;
		}
	}

	//supprimer un produit
	public function del($product_id){
		unset($_SESSION['panier'][$product_id]);
	}

	public function vider_panier(){
	    $vide = false;
	    unset($_SESSION['panier']);
	    if(!isset($_SESSION['panier']))
	    {
	        $vide = true;
	    }
	    return $vide;
	}

}