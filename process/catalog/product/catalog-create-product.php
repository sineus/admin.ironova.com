<?php

	include('../../bdd.php');

	//RETRIEVE PRODUCT DATA
	$postData = file_get_contents("php://input");
	$data = json_decode($postData, true);

	$name        = $data['name'];
	$reference   = $data['reference'];
	$barcode_ean = $data['barcode_ean'];
	$barcode_upc = $data['barcode_upc'];
	$category    = $data['category'];
	$price_ht    = $data['price_ht'];
	$price_ttc   = $data['price_ttc'];
	$quantity    = $data['quantity'];
	$id_status   = $data['status'];
	$display     = $data['display'];
	$description = $data['description'];
	$content     = $data['content'];
	$info        = $data['info'];
	$edition     = $data['edition'];
	$url         = $data['url'];
	$width       = $data['width'];
	$height      = $data['height'];
	$depth       = $data['depth'];
	$weight      = $data['weight'];
	$out_of_stock = $data['out_of_stock'];


	$req = $bdd->prepare("INSERT INTO product (
		name, 
		reference,
		barcode_ean, 
		barcode_upc, 
		id_category, 
		price_ht, 
		price_ttc, 
		quantity, 
		id_status, 
		display, 
		description, 
		content,
		info,
		edition, 
		url,
		width,
		height,
		depth,
		weight,
		out_of_stock
	) VALUES(
		:name, 
		:reference,
		:barcode_ean, 
		:barcode_upc, 
		:category, 
		:price_ht, 
		:price_ttc, 
		:quantity, 
		:id_status, 
		:display, 
		:description, 
		:content,
		:info,
		:edition, 
		:url,
		:width,
		:height,
		:depth,
		:weight,
		:out_of_stock
		)");

    $req->execute(array(
        'name'          => $name,
        'reference'     => $reference, 
		'barcode_ean'   => $barcode_ean, 
		'barcode_upc'   => $barcode_upc, 
		'category'      => $category, 
		'price_ht'      => $price_ht, 
		'price_ttc'     => $price_ttc, 
		'quantity'      => $quantity, 
		'id_status'     => $id_status, 
		'display'       => $display, 
		'description'   => $description, 
		'content'       => $content,
		'info'          => $info,
		'edition'       => $edition, 
		'url'           => $url,
		'width'         => $width,
		'height'        => $height,
		'depth'         => $depth,
		'weight'        => $weight,
		'out_of_stock'  => $out_of_stock
    ));
?>