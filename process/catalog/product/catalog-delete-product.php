<?php

	include('../../bdd.php');
	
	$item = $_GET['productID'];

	$req = $bdd->prepare('DELETE FROM product WHERE id_product = ?');
	
	if($req->execute(array($item))){
		echo 'Produit supprimé avec succés';
	}else{
		echo 'Erreur le produit n\'a pas été supprimé';
	}