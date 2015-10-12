<?php
	// CONNECT BDD
	include('../../bdd.php');

    // RECOVERED DATA
    $id_product = $_GET['productID'];

    // SELECT CARRIER ID WITH PRODUCT ID
    $req = $bdd->prepare('SELECT id_carrier FROM product_carrier WHERE id_prod = ?');
    $req->execute(array($id_product));

    $idCarrier = $req->fetchAll(PDO::FETCH_ASSOC);

    if($idCarrier){

	    $arr = [];
	    foreach($idCarrier as $row => $innerArray){
	    	foreach($innerArray as $innerRow => $value){
	    		array_push($arr, $value);
	    	}
	    }
	    $req = $bdd->prepare('SELECT * FROM iro_carrier WHERE id IN (' . implode(',', $arr) . ')');
		$req->execute();


	    $carrier = $req->fetchAll(PDO::FETCH_ASSOC);
	    echo json_encode($carrier);
	}else{
		
	}