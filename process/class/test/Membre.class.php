<?php
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

	class Membre{

		public function __construct($idMembre){

				global $bdd;


				$req = $bdd->prepare('SELECT * FROM clients WHERE id_client = '.$idMembre.'');

				$req->execute();

				while($donnees = $req->fetch()){

					$this->pseudo = $donnees['prenom'];
					$this->email = $donnees['email'];
				}

		}	

		// private $pseudo;
		// private $email;
		private $signature;
		private $actif;

		public function envoyerEmail($titre, $message){

			mail($this->email, $titre, $message);

		}

		public function bannir(){

			$this->actif = false;
			$this->envoyerEmail('Vous avez été banni', 'Ne revenez plus');
			
		}

		public function getPseudo(){

			return $this->pseudo;

		}

		public function getEmail(){

			echo $this->email;

		}

		public function setPseudo($nouveauPseudo){

			if(!empty($nouveauPseudo) AND strlen($nouveauPseudo) < 15){

				$this->pseudo = $nouveauPseudo;

			}
		}

	}
