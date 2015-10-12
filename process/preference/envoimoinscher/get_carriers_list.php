<?php

	include_once('config.api.php');

	//RETRIEVE FAMILY VALUE
	$type = $_GET['type'];

	// GET CARRIER LIST API	
	$lcCl = new Env_CarriersList(array("user" => $userData['login'], "pass" => $userData['password'], "key" => $userData['api_key']));
	$lcCl->setEnv("test");
	$lcCl->loadCarriersList("Prestashop","3.0.0");

	$family = array(
		"1" => "Economique",
		"2" => "Expressiste"
	);

	$zone = array(
		"1" => "France",
		"2" => "International",
		"3" => "Europe"
	);

	if(!$lpCl->curlError && !$lpCl->respError) {
		// CREATE ARRAY
		$data = array();

		// PUSH INTO ARRAY
		foreach($lcCl->carriers as $carrier){
			if(!in_array($type, $carrier, true)){
				array_push($data, $carrier);
			}

		}
		// OUTPUT DATA JSON
		echo json_encode($data);

	}elseif($lcCl->respError) {
		//ERROR
		echo "La requête n'est pas valide : ";
			foreach($lcCl->respErrorsList as $m => $message) { 
				echo "<br />".$message['message'];
			}
	}else{
		"<b>Une erreur pendant l'envoi de la requête </b> : ".$cotCl->curlErrorText; 
	}