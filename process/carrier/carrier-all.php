<?php
	
	//CONNECT BDD
	include('../bdd.php');

	$id_product = $_GET['productID'];

	$req = $bdd->prepare("SELECT * FROM iro_carrier as A WHERE NOT EXISTS (SELECT * FROM product_carrier as B WHERE A.id = B.id_carrier AND B.id_prod = $id_product)");
	$req->execute();

	$result = $req->fetchAll(PDO::FETCH_ASSOC);

	if($result){

		$json = json_encode($result);
		echo $json;

	}