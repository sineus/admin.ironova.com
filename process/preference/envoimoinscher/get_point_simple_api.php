<?php
	include_once('config.api.php');

	$city = $_GET['city'];
	$zip = $_GET['zip'];

	$lpCl = new Env_ListPoints(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$lpCl->setEnv('test');
	$params = array('srv_code' => 'RelaisColis', "collecte"=> "exp", 'pays' => 'FR', 'cp' => $zip, 'ville' => $city);
	$lpCl->getListPoints("SOGP", $params);

	echo json_encode($lpCl);
	 
 