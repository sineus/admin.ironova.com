<?php

	include('../../bdd.php');

	$item = $_GET['item'];

	$req = $bdd->prepare('SELECT * FROM product_category WHERE url = ?');
	$req->execute(array($item));
	$result = $req->fetch();

	if($result){

		$json = json_encode($result);
		echo $json;

	}else{

		echo "Aucune catégorie";

	}