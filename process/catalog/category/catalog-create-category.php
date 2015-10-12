<?php

	include('../../bdd.php');

	//RETRIEVE PRODUCT DATA
	$postData = file_get_contents("php://input");
	$data = json_decode($postData, true);

	$name        = $data['name'];
	$description = $data['description'];
	$url         = $data['url'];


	$req = $bdd->prepare("INSERT INTO product_category (
		name, 
		description,
		url
	) VALUES(
		:name, 
		:description,
		:url
		)");

    $req->execute(array(
        'name'          => $name,
        'description'   => $description, 
		'url'           => $url
    ));
?>