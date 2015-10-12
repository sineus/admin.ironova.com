<?php
	include('../../bdd.php');
	
	$item = $_GET['addressID'];

	$req = $bdd->prepare('DELETE FROM clients_adresses WHERE id_adresse = ?');
	
	if($req->execute(array($item))){
		echo 'L\'adresse n°'.$item.' a été supprimée avec succées';
	}else{
		echo 'Erreur l\'adresse n\'a pas été supprimé';
	}