<?php

	include('../bdd.php');

	// RETRIEVE DATA
   	$postData = file_get_contents("php://input");
	$request = json_decode($postData, true);
	$login = $request['login_mail'];
	$psw = sha1($request['login_password']);

	// VERIFY LOGIN AND PSW
	$req = $bdd->prepare("SELECT count(*) FROM iro_admin WHERE login = ? AND password = ?");
	$req->execute(array($login, $psw));
	$result = $req->fetch();

	$reqName = $bdd->prepare("SELECT * FROM iro_admin WHERE login = ? AND password = ?");
	$reqName->execute(array($login, $psw));
	$resultName = $req->fetch();

	while($data = $reqName->fetch()){
		$name = $data['name'];
	}

	$admin = array(
		'login'   => $login,
		'name'    => $name,
		'auth'    => true 
	);

	// BOOL RESULT (OUTPUT ANGULAR)
	if($login != '' && $psw != ''){
		if($result[0] == 1){

			echo json_encode($admin);

		}else if($result[0] == 0){

			echo 'You are not connected';

		}else{

			echo 'Problem with database';

		}
	}else{

		echo 'Field required';

	}