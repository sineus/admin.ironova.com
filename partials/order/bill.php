<!--ORDER / BILL-->
<div class="col-sm-12">
    <h5 class="sub-title">Commandes / Factures</h5>
    <h1 class="main-title">Factures</h1>
</div>
<div class="col-sm-12">

</div>
<div class="col-sm-12">
	<div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-shopping-cart panel-icon" aria-hidden="true"></span> 
            Test envoimoinscher API
            <div class="admin-option-btn">
            <a href="" data-toggle="tooltip" data-placement="top" title="Rafraîchir les données"><i class="glyphicon glyphicon-refresh" ng-click="getAllCustomerAddress()"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<?php
				// DATA CONFIG API KEY
	  			$userData = parse_ini_file("../../process/class/utils/config.ini");
	  			ini_set('error_reporting',E_ALL & ~E_NOTICE); 

	  			// AUTOLOAD CLASS
				require_once("../../process/class/utils/autoload.php");


				// GET CATEGORY PRODUCT===============================================
				$categoriesStyle = 'style="font-weight:bolder;"';

				// Initialisation de la classe chargée de récupérer les catégories 
				$contentCl = new Env_ContentCategory(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));

				// Cette méthode permet de récupérer la liste des catégories
				$contentCl->getCategories();

				// Celle-ci charge la liste des catégories de contenus (sous-catégories)
				$contentCl->getContents(); 

				// Grâce à cette méthode vous pouvez récupérer les sous-catégories d'une seule catégorie
				$child = $contentCl->getChild(10000);
			?>
			<h3>Choix Catégorie (file: get_categories_simple.php)</h3>
			<p>
				<label id="categories" for="categories">Sélectionnez votre catégorie</label>
				<select name="categories">
					<option value="<?php echo $contentCl->contents[0][0]['code'];?>"><?php echo $contentCl->contents[0][0]['label'];?></option>
						<?php foreach($contentCl->categories as $c => $category) { ?>
							<optgroup label="<?php echo $category['label'];?>">
								<?php foreach($contentCl->contents[$category['code']] as $ch => $child) { ?>
									<option value="<?php echo $child['code'];?>"><?php echo $child['label'];?></option>
								<?php } ?>
							</optgroup>
						<?php } ?>
				</select></p>
				<h3>Liste transporteurs (file: get_carriers_list.php)</h3>
			<?php
				//PREPARE REQUEST FOR ENVOIMOINSCHER==================================
				$orderPMStyle = 'style="font-weight:bold;"';

				/* Préparation, envoi de la requête à l'API et reception de la réponse */
				$lcCl = new Env_CarriersList(array("user" => $userData['login'], "pass" => $userData['password'], "key" => $userData['api_key']));
				$lcCl->setEnv("test");
				$lcCl->loadCarriersList("Prestashop","3.0.0");

				$family = array(
					"1" => "Economique",
					"2" => "Expressiste"
				);

				$zone = array(
					"1" => "France",
					"2" => "International",
					"3" => "Europe"
				);

				echo "<pre>".print_r($lcCl->carriers,true)."</pre>";

				/* If there is no errors, we display the datas */
				if(!$lpCl->curlError && !$lpCl->respError) { 
			?>
			<style type="text/css">
				table tr td {border:1px solid #000000; padding:5px; }
			</style>
			<table>
				<tr>
					<td>Opérateur</td>
					<td>Service</td>
					<td>Description</td>
					<td>Famille</td>
					<td>Zone</td>
					<td>Depot point relais</td>
					<td>Retrait point relais</td>
				</tr>
				<?php	foreach($lcCl->carriers as $carrier){	?>
					<tr>
						<td><?php echo $carrier['ope_name']." (".$carrier['ope_code'].")"; ?></td>
						<td><?php echo $carrier['srv_name']." (".$carrier['srv_code'].")"; ?></td>
						<td><?php echo "<u>Label</u> : ".$carrier['label_store']."<br/><u>Description</u> : ".$carrier['description']." (".$carrier['description_store'].")"; ?></td>
						<td><?php echo $family[$carrier['family']]; ?></td>
						<td><?php echo $zone[$carrier['zone']]; ?></td>
						<td><?php echo $carrier['parcel_pickup_point']=="1"?"Oui":"Non"; ?></td>
						<td><?php echo $carrier['parcel_dropoff_point']=="1"?"Oui":"Non"; ?></td>
					</tr>
				<?php	}	?>
			</table>
			<?php
				}
				/* Cas d'erreur */
				elseif($lcCl->respError) {
  					echo "La requête n'est pas valide : ";
  					foreach($lcCl->respErrorsList as $m => $message) { 
    					echo "<br />".$message['message'];
  					}
				}else{
					"<b>Une erreur pendant l'envoi de la requête </b> : ".$cotCl->curlErrorText; 
				}

			?>
			<h3>Coût des transports (file: get_cotation_api.php)</h3>
			<?php
				//GET COTATION OF ORDER=======================================================
				$quotationPSStyle = 'style="font-weight:bold;"';

				foreach($_GET as $k => $get) {
  					$_GET[$k] = mb_convert_encoding(urldecode($_GET[$k]), "UTF-8");
				}

				// création du destinataire et de l'expéditeur - classe séparée car dans l'avenir on voudra 
				// peut-être gérer les carnets d'adresses ou gestion de compte à distance (via une smartphone par exemple)
				$to = array(
					"pays" => "FR", 
					"code_postal" => "75002", 
					"ville" => "Paris", 
					"type" => "particulier", 
					"adresse" => "41, rue Saint Augustin"
				);
				$from = array(
					"pays" => "FR", 
					"code_postal" => "13002",   
					"ville" => "Marseille", 
					"type" => "particulier", 
					"adresse" => "1, rue Chape"
				); 
	
				// On créé la cotation
				$date = new DateTime();
				$date->add(new DateInterval('P10D'));
				$quotInfo = array("collecte" => $date->format('Y-m-d'), "delay" => "aucun",  "content_code" => 50113);
				if($_GET["ope"] != "" && $_GET["ope"] != "all") { 
				  	$quotInfo["operator"] = $_GET["ope"];
				}
				$cotCl = new Env_Quotation(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
				// Initialisation de l'expéditeur et du destinataire
				$cotCl->setPerson("shipper", $from);
				$cotCl->setPerson("recipient", $to);
				// Précision de l'environnement de travail 
				$cotCl->setEnv('test'); 
				// Initialisation du type d'envoi
				$cotCl->setType(
					"colis", array(
						1 => array(
							"poids"    => 1, 
							"longueur" => 18, 
							"largeur"  => 18,
							"hauteur"  => 18
						)
					)
				);
	
				$cotCl->getQuotation($quotInfo);
				if($cotCl->curlError) {     
  					echo "<b>Une erreur pendant l'envoi de la requête </b> : ".$cotCl->curlErrorText;   
  					die();     
				}    
				elseif($cotCl->respError) {   
  					echo "La requête n'est pas valide : ";   
  					foreach($cotCl->respErrorsList as $m => $message) { 
    					echo "<br /><b>".$message['message']."</b>";    
  					}  
  					die();  
				}
				else {
			?>
			<style type="text/css">
				table tr td {border:1px solid #000000; padding:5px; }
			</style>
			<table>
				<?php
	  				$cotCl->getOffers(true);
					foreach($cotCl->offers as $o => $offre) {
				?>
				<tr id="ope-<?php echo $o;?>-tr">
					<td><input type="radio" name="ope" id="ope-<?php echo $o;?>" value="<?php echo $offre["operator"]["code"];?>" class="chkbox selectOpe" /> <label for="ope-<?php echo $o;?>">choisir cette offre</label></td>
					<td><img src="<?php echo $offre["operator"]["logo"];?>" alt="" /></td>
					<td>
						<?php 
							foreach($offre["characteristics"] as $c => $char) {
								echo $char.'<br />';  
								unset($offre["characteristics"][$c]);  
								if($c == 3) { 
									break; 
								} 
							}  
						?>
						<span id="char-<?php echo $o;?>" class="hidden"><?php echo implode("<br /> - ", $offre["characteristics"]); ?></span>
						<p>Mandatory : </p>
						<ul><?php foreach($offre['mandatory'] as $m => $mandatory) { ?><li><?php echo $m; ?></li><?php } ?></ul>
					</td>
					<td class="price">
						<?php echo $offre['price']['tax-exclusive'];?>€
						<input type="hidden" name="ope-<?php echo $o;?>-price" id="ope-<?php echo $o;?>-price" value="<?php echo htmlspecialchars($offre['price']['tax-exclusive']);?>" />
						<input type="hidden" name="ope-<?php echo $o;?>-operator" id="ope-<?php echo $o;?>-operator" value="<?php echo htmlspecialchars($offre['operator']['label']);?>" />
						<input type="hidden" name="ope-<?php echo $o;?>-service" id="ope-<?php echo $o;?>-service" value="<?php echo htmlspecialchars($offre['service']['label']);?>" />
						<input type="hidden" name="ope-<?php echo $o;?>-infos" id="ope-<?php echo $o;?>-infos" value="<?php echo htmlspecialchars(implode("<br/> - ", $offre["characteristics"]));?>" />
					</td>
					<td>
						<?php   	
							if(count($offre['mandatory']['depot.pointrelais']) > 0) {
								?>
								<p class="arrow smaller selectPr">Points de proximité de départ</p>
								<ul>
									<?php foreach($offre['mandatory']['depot.pointrelais']['array'] as $p) echo '<li>'.$p.'</li>'; ?>
								</ul>
						<?php 	} ?>
						<br />
						<?php 	
							if(count($offre['mandatory']['retrait.pointrelais']) > 0) {
								$pr = explode(" ", $offre['mandatory']['retrait.pointrelais']['type']);
								foreach($pr as $p => $point) {
									if(trim($point) != "") {
										$poi[$p] = trim($point);
									}
								}
						?>
								<p class="arrow smaller selectPr">Points de proximité d'arrivée</p>
								<ul>
									<?php foreach($offre['mandatory']['depot.pointrelais']['array'] as $p) echo '<li>'.$p.'</li>'; ?>
								</ul>
						<?php } ?>
					</td>
				</tr>
					<?php
						}
					}
				?> 
			</table>

<h3>Liste Devis livraison (file: get_cotation.php)</h3>
<?php
$quotationStyle = 'style="font-weight:bold;"';

// Précision de l'expéditeur et du destinataire
$to = array(
	"pays" => "FR", 
	"code_postal" => "75002", 
	"ville" => "Paris", 
	"type" => "particulier", 
	"adresse" => "41, rue Saint Augustin"
	);
$from = array(
	"pays" => "FR", 
	"code_postal" => "13002",   
	"ville" => "Marseille", 
	"type" => "particulier", 
	"adresse" => "1, rue Chape"); 
// Informations sur la cotation (date d'enlèvement, le délai, le code de contenu)
$quotInfo = array("collecte" => date("Y-m-d"), "delai" => "aucun",  
"code_contenu" => 10120);
// Initialisation de la classe
$cotCl = new Env_Quotation(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
// Initialisation de l'expéditeur et du destinataire
$cotCl->setPerson("expediteur", $from);
$cotCl->setPerson("destinataire", $to);
// Précision de l'environnement de travail 
$cotCl->setEnv('test'); 
// Initialisation du type d'envoi
$cotCl->setType(
	"colis", 
	array(
		1 => array(
			"poids" => 2, 
			"longueur" => 18, 
			"largeur" => 18,
			"hauteur" => 18
		)
	)
	);
	
$cotCl->getQuotation($quotInfo);
// Si pas d'erreur CURL
if(!$cotCl->curlError) { print_r($pointCl->respErrorsList);
  // Si pas d'erreurs de la requête, on affiche le résultat
  if(!$cotCl->respError) {
    $cotCl->getOffers(false);
?>
<style type="text/css">
table tr td {border:1px solid #000000; padding:5px; }
</style>
<table>
	<thead>
		<tr>
			<td>Transp / Service</td>
			<td>Prix</td>
			<td>Collection</td>
			<td>Livraison</td>
			<td>Détails</td>
			<td>Alertes</td>
			<td>Informations <br />à fournir</td>
		</tr>
	</thead>
	<tbody>
<?php foreach($cotCl->offers as $o => $offre) { ?>
			<tr>
				<td><b><?php echo $o;?></b>. <?php echo $offre['operator']['label'];?> / <?php echo $offre['service']['code'];?></td>
				<td><?php echo $offre['price']['tax-exclusive'];?> <?php echo $offre['price']['currency'];?></td>
				<td><?php echo $offre['collection']['type'];?></td>
				<td><?php echo $offre['delivery']['type'];?></td>
				<td><?php echo implode('<br /> - ', $offre['characteristics']); ?></td>
				<td><?php echo $offre['alert']; ?></td>
				<td><?php foreach($offre['mandatory'] as $m => $mandatory) { ?> - <?php echo $m; ?><br /><?php } ?></td>
			</tr>
<?php } ?>
	</tbody>
</table>
<?php
  } 
  else {
    echo "La requête n'est pas valide : ";
    foreach($cotCl->respErrorsList as $m => $message) { 
      echo "<br />".$message["message"];
    }
  }
}
else {
  echo "<b>Une erreur pendant l'envoi de la requête </b> : ".$cotCl->curlErrorText;
  die();
}
?>
<h3>Liste des pays (file: get_country_simple.php)</h3>
<?php
$countriesStyle = 'style="font-weight:bold;"';

// Initialisation de la classe pays
$countryCl = new Env_Country(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
// Récupération des pays
$countryCl->getCountries();
?>
<p>
	<label for="countries">Sélectionnez votre pays : </label>
	<select id="countries" name="countries">
<?php foreach($countryCl->countries as $c => $country) { ?>  
			<option value="<?php echo $country['code'];?>"><?php echo $country['label'];?></option> 
<?php } ?>
	</select>
</p>
<?php
// Récupération d'un pays (Pays-Bas)
$countryCl->getCountry("NL");
?>
<p>Les destinations vers les Pays-Bas : 
	<ul>
<?php foreach($countryCl->country as $c => $country) { ?>
		<li><?php echo $country["label"];?></li>
<?php } ?>
	</ul>
</p>

<?php
/* Préparation, envoi de la requête à l'API et reception de la réponse */
$lpCl = new Env_ListPoints(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
$lpCl->setEnv('test');
$params = array('srv_code' => 'RelaisColis', "collecte"=> "exp", 'pays' => 'FR', 'cp' => '13002', 'ville' => 'MARSEILLE');
$lpCl->getListPoints("SOGP", $params);

/* If there is no errors, we display the datas */
if(!$lpCl->curlError && !$lpCl->respError) { 
?>
<style type="text/css">
	table tr td {border:1px solid #000000; padding:5px; }
</style>
<?php
$jourSemaine = array(
	1 => 'Lundi',
	2 => 'Mardi',
	3 => 'Mercredi',
	4 => 'Jeudi',
	5 => 'Vendredi',
	6 => 'Samedi',
	7 => 'Dimanche'
);
?>
<h3>Liste points relais (file: get_listpoints.php)</h3>
<p>Exemple points relais <?php echo $params['ville']; ?></p>
<table>
	<tr>
		<td>Code</td>
		<td>Nom</td>
		<td>Adresse</td>
		<td>Ville</td>
		<td>CP</td>
		<td>Pays</td>
		<td>Téléphone</td>
		<td>Déscription</td>
		<td>Calendrier</td>
	</tr>
<?php	foreach($lpCl->listPoints as $point){	?>
		<tr>
			<td><?php echo $point['code']; ?></td>
			<td><?php echo $point['name']; ?></td>
			<td><?php echo $point['address']; ?></td>
			<td><?php echo $point['city']; ?></td>
			<td><?php echo $point['zipcode']; ?></td>
			<td><?php echo $point['country']; ?></td>
			<td><?php echo $point['phone']; ?></td>
			<td><?php echo $point['description']; ?></td>
			<td>
				<table>
					<tr>
						<td>Jour semaine</td>
						<td>Ouverture am</td>
						<td>Fermeture am</td>
						<td>Ouverture pm</td>
						<td>Fermeture pm</td>
					</tr>
<?php			foreach($point['days'] as $day){	?>
						<tr>
							<td><?php echo $jourSemaine[$day['weekday']]; ?></td>
							<td><?php echo $day['open_am']; ?></td>
							<td><?php echo $day['close_am']; ?></td>
							<td><?php echo $day['open_pm']; ?></td>
							<td><?php echo $day['close_pm']; ?></td>
						</tr>
<?php			}	?>
				</table>
			</td>
		</tr>
<?php	}	?>
</table>
<?php
}
/* Cas d'erreur */
elseif($lpCl->respError) {
  echo "La requête n'est pas valide : ";
  foreach($lpCl->respErrorsList as $m => $message) { 
    echo "<br />".$message['message'];
  }
}
else {
	"<b>Une erreur pendant l'envoi de la requête </b> : ".$cotCl->curlErrorText; 
}
?>

<h3>envoyer une commande (file: get_order.php)</h3>
<?php
	// Informations sur l'expéditeur et le destinataire 
$from = array("pays" => "FR", "code_postal" => "75002", "type" => "entreprise","societe" => "maSociete",
"ville" => "Paris", "adresse" => "41, rue Saint-Augustin | 3e étage", 
"civilite" => "M", "prenom" => "Développeur", "nom" => "Boxtale", "email" => "dev@boxtale.com",
"tel" => "0601010101", "infos" => "Frapper 3 fois");
$to = array("pays" => "FR", "code_postal" => "13002", "type" => "particulier",
"ville" => "Marseille", "adresse" => "6, rue Bonneterie",
"civilite" => "M", "prenom" => "David", "nom" => "Kubler", 
"email" => "kubler.david.esdac@gmail.com", "tel" => "0666325655", "infos" => "");

// Informations sur la cotation
$quotInfo = array(
	"collecte" => date("Y-m-d"), 
	"delai" => "aucun",  
	"code_contenu" => 10120,
	"code_contenu" => 10120,
	"code_contenu" => 10120,
  "type_emballage.emballage" => 1, // <== Type emballage
	"operateur" => "POFR",
	"collection_type" => "DROPOFF_POINT",
	"delivery_type" => "PICKUP_POINT",
	"depot.pointrelais" => "POFR-POST", 
	"retrait.pointrelais" => "SOGP-I1151", 
	"colis.description" => "Le Monde, années 1990-1992"
);
$cotCl = new Env_Quotation(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
$cotCl->setPerson("expediteur", $from);
$cotCl->setPerson("destinataire", $to);
$cotCl->setEnv('test'); 
$cotCl->setType("colis", array(
	1 => array(
		"poids" => 1, 
		"longueur" => 20, 
		"largeur" => 20, 
		"hauteur" => 20)
	)
);

$orderPassed = $cotCl->makeOrder($quotInfo, true);
if(!$cotCl->curlError && !$cotCl->respError) { 
  if($orderPassed) {
    echo "L'envoi a été correctement réalisé sous référence ".$cotCl->order['ref'];
  }
  else {
    echo "L'envoi n'a pas été correctement réalisé. Une erreur s'est produite.";
  }
}
elseif($cotCl->respError) {
  echo "La requête n'est pas valide : ";
  foreach($cotCl->respErrorsList as $m => $message) { 
    echo "<br />".$message['message'];
  }
}
else {
  echo "<b>Une erreur pendant l'envoi de la requête </b> : ".$cotCl->curlErrorText; 
}
?>

<h3>LISTE POINT RELAIS API (file: get_point_simple_api.php)</h3>
<?php
// Exemple de traduction pour les codes d'erreur
$codesTranslated = array("http_file_not_found" => "Page n'existe pas", 
"type_not_correct" => "Please, select the right point type");

// Initialisation de la classe points relais
$pointCl = new Env_ParcelPoint(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
// Example avec deux points relais, un pour RelaisColis, l'autre pour Sernam; pour ce faire
// on doit mettre $constructList en true
$pointCl->constructList = true;
// Récupération des points relais, un par un
// Chaque point relai est rajouté avec les autres dans $pointCl->points

  
$typesTrad = array("exp" => "pickup_point", "dest" => "dropoff_point");

/* Dans le cas ou aucune variable get n'est specifiée => valeurs par defaut */
$points = isset($_GET['points'])?$_GET['points']:'SOGP-C3084,SOGP-C3159';
$qui = isset($_GET['qui'])?$_GET['qui']:'dest';

$pointsGet = explode(",", $points);
foreach($pointsGet as $p => $point) { 
  $pointCl->getParcelPoint($typesTrad[$qui], trim($point)); 
}
		 
foreach($pointCl->points[$typesTrad[$qui]] as $p => $point) { 
?> 
<p>
	<input name="pointrelais-<?php echo $qui;?>" type="radio" value="<?php echo $point["name"];?>|||<?php echo $point["address"];?>|||<?php echo $point["zipcode"];?>|||<?php echo $point["city"];?>" />
<?php echo $point["name"];?> <br /><?php echo $point["address"];?> <br />
<?php echo $point["zipcode"];?> <?php echo $point["city"];?> 
</p>
    <?php
  }
  
 
?> 
<h3>Status de la commande "1310211971LOCO3917FR" (file: get_status.php)</h3>
<?php
	$cotCl = new Env_OrderStatus(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$cotCl->getOrderInformations("1509212807POFR057AFR");
	if(!$cotCl->curlError && !$cotCl->respError) { 
		echo json_encode($cotCl);
	}
	elseif($cotCl->respError) {
	  echo "La requête n'est pas valide : ";
	  foreach($cotCl->respErrorsList as $m => $message) { 
	    echo "<br />".$message['message'];
	  }
	}
	else {
	  echo "<b>Une erreur pendant l'envoi de la requête </b> : ".$cotCl->curlErrorText; 
	}
?>