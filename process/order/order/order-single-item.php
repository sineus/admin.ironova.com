<?php
	
	//CONNECT BDD
	include('../../bdd.php');

	$id = $_GET['id'];

	$req = $bdd->prepare("SELECT * FROM commandes_line as A INNER JOIN product_img as B ON A.id_produit = B.id_prod INNER JOIN product as C ON B.id = C.id_cover WHERE rid_commande = ?");
	$req->execute(array($id));

	$result = $req->fetchAll(PDO::FETCH_ASSOC);

	if($result){

		$json = json_encode($result);
		echo $json;

	}