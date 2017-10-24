<?php 
include_once 'konfiguracija.php';
 if(!isset($_POST["korisnik"]) || !isset($_POST["korisnik"])){
 	header("location:" . $putanjaAPP . "index.php");
	
 }
$izraz=$veza->prepare("select * from operater where email=:email and lozinka=md5(:lozinka)");
$izraz->execute(array("email"=>$_POST["korisnik"], "lozinka" =>$_POST["lozinka"]));
$operater= $izraz->fetch(PDO::FETCH_OBJ);
if($operater!=null){
	$_SESSION["logiran"]=$operater;
	header("location:" . $putanjaAPP . "privatno/roba/pindex.php");
}
else{
	header("location:" . $putanjaAPP . "login.php?neuspio&korisnik=" . $_POST["korisnik"]);
	

}

 