<?php
	include_once('config.api.php');

	//INITIALIZE CLASS CATEGORY
	$countryCl = new Env_Country(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));

	//RETRIEVE COUNTRY LIST
	$countryCl->getCountries();

	echo json_encode($countryCl);


				