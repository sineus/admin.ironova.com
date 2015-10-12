<?php
	// CONNECT BDD
	include('../../bdd.php');

    // RECOVERED DATA
   	$postData = file_get_contents("php://input");
	$data = json_decode($postData);

	$id  = $data->id;
	$name         = $data->name;
	$description  = $data->description;
	$url          = $data->url;

	$req = $bdd->query("SELECT * FROM product_category WHERE id = ".$id."");
	
	while($Odata = $req->fetch()){
		$Oname        = $Odata['name'];
		$Odescription = $Odata['description'];
		$Ourl         = $Odata['url'];
	}

	$sql = "UPDATE product_category SET name = :name, description = :description, url = :url WHERE id = :id";
	$sth = $bdd->prepare($sql);
	$sth->bindValue(':name', !empty($name) ? $name : $Oname);
	$sth->bindValue(':description', !empty($description) ? $description : $Odescription);
	$sth->bindValue(':url', !empty($url) ? $url : $Ourl);
	$sth->bindValue(':id', $id);
	$sth->execute();
	$sth->closeCursor();

	// // DATA OUTPUT
	echo 'La catégorie '.$Oname.' a bien été modifiée';






