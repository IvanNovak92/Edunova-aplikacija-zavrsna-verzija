<?php
session_start();

include_once 'funkcije.php';

$rezultataPoStranici=5;
$stranica=1;
$naslovAplikacije= "Skladiste APP";



switch ($_SERVER["HTTP_HOST"]){
	case 'localhost':
		$putanjaAPP="/LjetniRad/";
		$mysqlHost="localhost";
		$mysqlBaza="skladiste";
		$mysqlKorisnik="korisnik";
		$mysqlLozinka="p";
		break;
	case 'ivannovak92.byethost7.com':
		$putanjaAPP="/LjetniRad/";
		$mysqlHost="sql113.byethost7.com";
		$mysqlBaza="b7_20136660_skladiste";
		$mysqlKorisnik="b7_20136660";
		$mysqlLozinka="password";
		break;
	default:
		$putanjaAPP="/";
		break;
		
}

try{
	$veza=new PDO("mysql:host=" . $mysqlHost. ";dbname=" . $mysqlBaza,$mysqlKorisnik,$mysqlLozinka);
	$veza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$veza->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	$veza->exec("SET CHARACTER SET utf8");
	$veza->exec("SET NAMES utf8");

}catch(PDOException $e){
	switch ($e->getCode()){
		case 2002:
			echo"Spajanje na MySql server nije moguće";
			break;
		case 1049:
			echo "Na MySql sereru ne postoji baza sa tim imenom";
			break;
		case 1045:
			echo "Na MySql serveru ne postoji kombinacija danog korisnikog imena i lozinke";
			default:
				print_r($e);
				break;
			
		
	}
	exit;
	
}
