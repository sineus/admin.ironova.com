<?php
	include('../../bdd.php');
	
	$item = $_GET['categoryID'];

	$req = $bdd->prepare('DELETE FROM product_category WHERE id = ?');
	
	if($req->execute(array($item))){
		echo 'La catégorie a été supprimée avec succées';
	}else{
		echo 'Erreur la catégorie n\'a pas été supprimé';
	}