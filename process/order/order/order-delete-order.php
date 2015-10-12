<?php
	include('../../bdd.php');
	
	$item = $_GET['orderID'];

	$req = $bdd->prepare('DELETE FROM commandes WHERE id_commande = ?');
	
	if($req->execute(array($item))){
		echo 'La commande n° '.$item.' a été supprimée avec succées';
	}else{
		echo 'Erreur la commande n\'a pas été supprimé';
	}