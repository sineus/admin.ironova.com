<?php
	// CONNECT BDD
	include('../../bdd.php');

    // RECOVERED DATA
   	$postData = file_get_contents("php://input");
	$data = json_decode($postData);

	$id_product   = $data->id_product;
	$name         = $data->name;
	$reference    = $data->reference;
	$barcode_ean  = $data->barcode_ean;
	$barcode_upc  = $data->barcode_upc;
	$category     = $data->id_category;
	$price_ht     = $data->price_ht;
	$price_ttc    = $data->price_ttc;
	$quantity     = $data->quantity;
	$id_status    = $data->id_status;
	$display      = $data->display;
	$description  = $data->description;
	$content      = $data->content;
	$info         = $data->info;
	$edition      = $data->edition;
	$url          = $data->url;
	$width        = $data->width;
	$height       = $data->height;
	$depth        = $data->depth;
	$weight       = $data->weight;
	$out_of_stock = $data->out_of_stock;
	$id_cover     = $data->id_cover;

	$req = $bdd->query("SELECT * FROM product WHERE id_product = '".$id_product."'");
	
	while($Odata = $req->fetch()){
		$Oname         = $Odata['name'];
		$Oreference    = $Odata['reference'];
		$Obarcode_ean  = $Odata['barcode_ean'];
		$Obarcode_upc  = $Odata['barcode_upc'];
		$Ocategory     = $Odata['id_category'];
		$Oprice_ht     = $Odata['price_ht'];
		$Oprice_ttc    = $Odata['price_ttc'];
		$Oquantity     = $Odata['quantity'];
		$Oid_status    = $Odata['id_status'];
		$Odisplay      = $Odata['display'];
		$Odescription  = $Odata['description'];
		$Ocontent      = $Odata['content'];
		$Oinfo         = $Odata['info'];
		$Oedition      = $Odata['edition'];
		$Ourl          = $Odata['url'];
		$Owidth        = $Odata['width'];
		$Oheight       = $Odata['height'];
		$Odepth        = $Odata['depth'];
		$Oweight       = $Odata['weight'];
		$Oout_of_stock = $Odata['out_of_stock'];
		$Oid_cover     = $Odata['id_cover'];
	}

	$sql = "UPDATE product SET 
		name         = :name, 
		reference    = :reference,
		barcode_ean  = :barcode_ean, 
		barcode_upc  = :barcode_upc, 
		id_category  = :id_category, 
		price_ht     = :price_ht, 
		price_ttc    = :price_ttc, 
		quantity     = :quantity, 
		id_status    = :id_status, 
		display      = :display, 
		description  = :description, 
		content      = :content,
		info         = :info,
		edition      = :edition, 
		url          = :url,
		width        = :width,
		height       = :height,
		depth        = :depth,
		weight       = :weight,
		out_of_stock = :out_of_stock,
		id_cover     = :id_cover
		WHERE id_product = :id_product";

	$sth = $bdd->prepare($sql);
	$sth->bindValue(':name', !empty($name) ? $name : $Oname);
	$sth->bindValue(':reference', !empty($reference) ? $reference : $Oreference);
	$sth->bindValue(':barcode_ean', !empty($barcode_ean) ? $barcode_ean : $Obarcode_ean);
	$sth->bindValue(':barcode_upc', !empty($barcode_upc) ? $barcode_upc : $Obarcode_upc);
	$sth->bindValue(':id_category', !empty($category) ? $category : $Ocategory);
	$sth->bindValue(':price_ht', !empty($price_ht) ? $price_ht : $Oprice_ht);
	$sth->bindValue(':price_ttc', !empty($price_ttc) ? $price_ttc : $Oprice_ttc);
	$sth->bindValue(':quantity', !empty($quantity) ? $quantity : $Oquantity);
	$sth->bindValue(':id_status', !empty($id_status) ? $id_status : $Oid_status);
	$sth->bindValue(':display', !empty($display) ? $display : $Odisplay);
	$sth->bindValue(':description', !empty($description) ? $description : $Odescription);
	$sth->bindValue(':content', !empty($content) ? $content : $Ocontent);
	$sth->bindValue(':info', !empty($info) ? $info : $Oinfo);
	$sth->bindValue(':edition', !empty($edition) ? $edition : $Oedition);
	$sth->bindValue(':url', !empty($url) ? $url : $Ourl);
	$sth->bindValue(':width', !empty($width) ? $width : $Owidth);
	$sth->bindValue(':height', !empty($height) ? $height : $Oheight);
	$sth->bindValue(':depth', !empty($depth) ? $depth : $Odepth);
	$sth->bindValue(':weight', !empty($weight) ? $weight : $Oweight);
	$sth->bindValue(':out_of_stock', !empty($out_of_stock) ? $out_of_stock : $Oout_of_stock);
	$sth->bindValue(':id_cover', !empty($id_cover) ? $id_cover : $Oid_cover);
	$sth->bindValue(':id_product', $id_product);
	$sth->execute();
	$sth->closeCursor();

	// // DATA OUTPUT
	echo 'Le Projet "'.$Oname.'" a bien était modifié';






