<?php
	
	//CONNECT BDD
	include('../../bdd.php');

	$id = $_GET['productID'];

	$req = $bdd->prepare("SELECT * FROM product_img WHERE id_prod = ?");
	$req->execute(array($id));

	$result = $req->fetchAll(PDO::FETCH_ASSOC);

	if($result){

		$json = json_encode($result);
		echo $json;

	}