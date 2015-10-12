<?php
	include_once('config.api.php');

	//INITIALIZE CLASS CATEGORY
	$contentCl = new Env_ContentCategory(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));

	//RETRIEVE CATEGORY LIST
	$contentCl->getCategories();

	//RETRIEVE EACH SUBCATEGORY LIST
	$contentCl->getContents(); 

	//RETRIEVE SUBCATEGORY OF ONE CATEGORY
	$child = $contentCl->getChild(10000);

	echo json_encode($contentCl);


				