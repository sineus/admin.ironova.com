<?php
	// CONNECT BDD
	include('../../bdd.php');

    // RECOVERED DATA
    $id_product = $_GET['productID'];
	$carrier = $_GET['carrier'];

	//INSERT CARRIER
	$req = $bdd->prepare("INSERT INTO product_carrier (id_carrier, id_prod) VALUES('$carrier', '$id_product')");
	$req->execute();
	$req->closeCursor();

	// // DATA OUTPUT
	echo 'Carrier added';






