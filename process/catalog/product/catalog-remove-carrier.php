<?php
	// CONNECT BDD
	include('../../bdd.php');

    // RECOVERED DATA
    $id_product = $_GET['productID'];
	$carrier = $_GET['carrier'];

	//INSERT CARRIER
	$req = $bdd->prepare('DELETE FROM product_carrier WHERE id_carrier = ? AND id_prod = ?');
	$req->execute(array($carrier,$id_product));
	$req->closeCursor();

	// // DATA OUTPUT
	echo 'Carrier deleted';






