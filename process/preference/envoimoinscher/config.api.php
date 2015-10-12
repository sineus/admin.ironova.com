<?php
	// DATA CONFIG API KEY
	$userData = parse_ini_file("../../class/utils/config.ini");
	ini_set('error_reporting',E_ALL & ~E_NOTICE); 

	// AUTOLOAD CLASS
	require_once("../../class/utils/autoload.php");