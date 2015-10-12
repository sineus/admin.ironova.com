<?php
	
	//CONNECT BDD
	include('../../bdd.php');

	$req = $bdd->prepare("SELECT * FROM iro_envoimoinscher WHERE id = 1");
	$req->execute();

	$result = $req->fetchAll(PDO::FETCH_ASSOC);

	if($result){

		$json = json_encode($result);
		echo $json;

	}