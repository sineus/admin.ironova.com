<?php
	//INCLUDE BDD AND UTILS LIBRARY
	include('../../bdd.php');
	include('../../class/utils/utils.php');

	//ERROR ARRAY
	$error = array(
		"type" => 0,
		"message" => "Veuillez remplir correctement vos informations"
	);

	//RETRIEVE API DATA
	$postData = file_get_contents("php://input");

	if($postData <= 0){

		$data = json_decode($postData, true);

		$login = $data['login'];
		$psw = $data['psw'];
		$key_api_test = $data['key_api_test'];
		$key_api_prod= $data['key_api_prod'];
		$gender = $data['gender'];
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$society = $data['society'];
		$address = $data['address'];
		$zip = $data['zip'];
		$city = $data['city'];
		$phone = $data['phone'];
		$mail = $data['mail'];
		$dde = $data['dde'];
		$fde = $data['fde'];

		// VERIFY DATA
		if(!empty($login) && !empty($psw) && !empty($key_api_test) && !empty($key_api_prod) && !empty($gender)
			&& !empty($first_name) && !empty($last_name) && !empty($society) && !empty($address) && !empty($zip)
			&& !empty($city) && !empty($phone) && !empty($mail) && !empty($dde) && !empty($fde)){

			//INSERT TO BDD
			$req = $bdd->prepare('INSERT INTO iro_envoimoinscher (
				id,
				login,
				psw,
				key_api_test, 
				key_api_prod, 
				gender, 
				first_name,
				last_name,
				society,
				address,
				zip,
				city,
				phone,
				mail,
				dde,
				fde
			)
			VALUES(
				1,
				:login,
				:psw,
				:key_api_test, 
				:key_api_prod, 
				:gender, 
				:first_name,
				:last_name,
				:society,
				:address,
				:zip,
				:city,
				:phone,
				:mail,
				:dde,
				:fde
				)
			ON DUPLICATE KEY UPDATE
				login = :login,
				psw = :psw,
				key_api_test = :key_api_test, 
				key_api_prod = :key_api_prod, 
				gender = :gender, 
				first_name = :first_name,
				last_name = :last_name,
				society = :society,
				address = :address,
				zip = :zip,
				city = :city,
				phone = :phone,
				mail = :mail,
				dde = :dde,
				fde = :fde
				');

			$req->execute(array(
				"login"        => $login,
				"psw"          => $psw,
				"key_api_test" => $key_api_test, 
				"key_api_prod" => $key_api_prod, 
				"gender"       => $gender, 
				"first_name"   => $first_name,
				"last_name"    => $last_name,
				"society"      => $society,
				"address"      => $address,
				"zip"          => $zip,
				"city"         => $city,
				"phone"        => $phone,
				"mail"         => $mail,
				"dde"          => $dde,
				"fde"          => $fde
			));

			//ADD CONFIG API TO INI FILE
			$sampleData = array(
            	'CONFIG' => array(
                	'login' => $login,
                	'password' => $psw,
                	'api_key' => $key_api_test
            	)
            );
			write_ini_file($sampleData, '../../class/utils/config.ini', true);

			//OUTPUT
			echo 'Vos informations ont bien été enregistrées';

		}else{
			//OUTPUT ERROR
			echo json_encode($error);

		}
	}else{
		//OUTPUT ERROR
		echo json_encode($error);

	}



