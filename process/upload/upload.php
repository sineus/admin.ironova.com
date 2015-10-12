<?php
    //CONNECT BDD
    include('../../process/bdd.php');

    //RETRIEVE PRODUCT ID
    $productID = $_POST['productID'];
    $productURL = $_POST['productURL'];

    // CREATE PRODUCT FOLDER
    $dirPath = '../../upload/product/'.$productURL;

    if(!file_exists($dirPath)){

        $createFolder = mkdir($dirPath, 0755);
        echo 'Le fichier '.$dirPath.' a bien été créé<br>';

    }else{

        echo 'Le fichier '.$dirPath.' existe déjà<br>';

    }

    //UPLOAD PICTURE      
    $filename = $_FILES['file']['name'];
    $destination = $dirPath.'/'.$filename;

    //URL PATH
    $urlPath = 'http://admin.ironova.com/upload/product/'.$productURL.'/'.$filename;

    echo 'url : '.$urlPath.'<br>';
    echo 'name :'.$filename.'<br>';
    echo 'id : '.$productID.'<br>';

    // MOVE UPLOAD TO FOLDER
    move_uploaded_file( $_FILES['file']['tmp_name'] , $destination );

    $req = $bdd->prepare("INSERT INTO product_img (img_name, path_img, id_prod) VALUES(:img_name, :url, :id)");

    $req->execute(array(
        'img_name' => $filename,
        'url'  => $urlPath, 
        'id'   => $productID
    ));

?>