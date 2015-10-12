<?php
	include('../../bdd.php');
	include_once('config.api.php');

	//RETRIEVE PRODUCT DATA
	$postData = file_get_contents("php://input");
	$data = json_decode($postData, true);

	//PRODUCT ID
	$productID = $data['product'];

	//PRODUCT CATEGORY
	$category = $data['category'];

	//FROM
	// $cp_from = $data['cp_from'];
	// $city_from = $data['city_from'];
	// $country_from = $data['country_from'];

	//TO
	$cp_to = $data['cp_to'];
	$city_to = $data['city_to'];
	$country_to = $data['country'];

	//TYPE SEND
	$type_send = $data['type_send'];

	//SELECT PRODUCT DATA WITH ID
	$req = $bdd->prepare('SELECT * FROM product WHERE id_product = ?');
	$req->execute(array($productID));

	while($product = $req->fetch()){

		$weight = $product['weight'];
		$depth = $product['depth'];
		$width  = $product['width'];
		$height = $product['height'];

	}	

	//CALL API
	//FROM
	$from = array(
		"pays" => "FR", 
		"code_postal" => "13382",
		"type"        => "particulier",
		"ville"       => "Marseille"
	);

	//TO
	$to = array(
		"pays"        => $country_to, 
		"code_postal" => $cp_to, 
		"type"        => "particulier",
		"ville"       => $city_to
	);

	//INFO
	$quotInfo = array(
		"collecte"             => date("Y-m-d"), 
		"delai"                => "aucun",  
		"code_contenu"         => $category,
		// "colis.valeur"         => 1200          //FACULTATIF
		// "colis.description" => "Des journaux" //FACULTATIF
	);

	//API INFO
	$cotCl = new Env_Quotation(array(
		"user" => $userData["login"], 
		"pass" => $userData["password"], 
		"key" => $userData["api_key"]
	));

	//INITIALIZE SHIPPER AND RECIPIENT
	$cotCl->setPerson("expediteur", $from);
	$cotCl->setPerson("destinataire", $to);

	//WORKSPACE ENVIRONMENT
	$cotCl->setEnv('test');

	//INITIALIZE TYPE SEND
	$cotCl->setType($type_send, array(
	  	1 => array(
			"poids" => $weight, 
			"longueur" => $depth, 
			"largeur" => $width, 
			"hauteur" => $height
		)
	));


	$cotCl->getQuotation($quotInfo);

	if(!$cotCl->respError){

		$cotCl->getOffers(false);
		echo json_encode($cotCl);
	}else{
		echo 'Requete non valide<br>';
		echo 'Category: '.$category.'<br>';
		echo 'Zip: '.$cp_to.'<br>';
		echo 'City: '.$city_to.'<br>';
		echo 'Country: '.$country_to.'<br>';
		echo 'Type send: '.$type_send.'<br>';
		echo 'Weight: '.$weight.'<br>';
		echo 'Height: '.$height.'<br>';
		echo 'Depth: '.$depth.'<br>';
		echo 'Width: '.$width.'<br>';
		echo "User: ".$userData["login"]; 
		echo "Pass ".$userData["password"];
		echo "Key ".$userData["api_key"];

	}



