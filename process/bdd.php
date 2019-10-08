<?php
	// Silence is golden

	try{
	   	$bdd = new PDO('mysql:host='.$host.';dbname='.$name, $user, $psw, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	    $bdd->exec("SET CHARACTER SET utf8");
	}
	catch(Exception $e){
	    die('Erreur : '.$e->getMessage());
	}
	date_default_timezone_set('UTC');
?>
