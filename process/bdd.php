<?php
	// CONNECT BDD
	// PRODUCTION
	// $host = 'ironovacmo2015.mysql.db';
	// $name = 'ironovacmo2015';
	// $user = 'ironovacmo2015';
	// $psw = 'RPzaYCjhEFUR';

	//TEST
	$host = 'localhost';
	$name = 'ironovacmo2015';
	$user = 'root';
	$psw = 'david';

	try{
	   	$bdd = new PDO('mysql:host='.$host.';dbname='.$name, $user, $psw, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	    $bdd->exec("SET CHARACTER SET utf8");
	}
	catch(Exception $e){
	    die('Erreur : '.$e->getMessage());
	}
	date_default_timezone_set('UTC');
?>