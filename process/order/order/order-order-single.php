<?php

	include('../../bdd.php');

	$item = $_GET['item'];

	$req = $bdd->prepare('SELECT * FROM commandes WHERE id_commande = ?');
	$req->execute(array($item));
	$result = $req->fetch();

	if($result){

		$json = json_encode($result);
		echo $json;

	}else{

		echo "No items available";

	}