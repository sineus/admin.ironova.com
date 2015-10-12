<?php
	// CONNECT BDD
	include('../../bdd.php');

	$req = $bdd->prepare("UPDATE clients SET new = 0 WHERE new = 1");
	$req->execute();





