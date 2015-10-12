<?php

	include('../../bdd.php');
	
	$item = $_GET['id_img'];

	$req = $bdd->prepare('DELETE FROM product_img WHERE id = ?');
	
	if($req->execute(array($item))){
		echo 'Image supprimé avec succés';
	}else{
		echo 'Erreur l\'image n\'a pas été supprimé';
	}