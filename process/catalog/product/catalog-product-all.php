<?php
	
	//CONNECT BDD
	include('../../bdd.php');

	$req = $bdd->prepare('SELECT * FROM product as A INNER JOIN product_img as B ON A.id_cover = B.id GROUP BY B.id');
	$req->execute();
	$arr1 = $req->fetchAll(PDO::FETCH_ASSOC);

	$req = $bdd->prepare('SELECT product.* FROM product WHERE NOT EXISTS(SELECT NULL FROM product_img WHERE product.id_cover = product_img.id)');
	$req->execute();

	$arr2 = $req->fetchAll(PDO::FETCH_ASSOC);

	$arrFinal = array_merge($arr1, $arr2);

	if($arrFinal){

		$json = json_encode($arrFinal);
		echo $json;

	}