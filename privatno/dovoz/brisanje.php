<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

//dolazim s GET metodom s stranice index
if(isset($_GET["sifra"])){
		$veza->beginTransaction();
		$izraz=$veza->prepare("select kooperant from dovoz where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_GET["sifra"] ));
		$sifraKooperant = $izraz->fetchColumn();
		$izraz=$veza->prepare("delete from dovoz where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_GET["sifra"] ));
		$veza->commit();
		header("location: index.php");
	}

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../predlosci/head.php'; ?>
	</head>
	<body>
		<?php include_once '../../predlosci/izbornik.php'; ?>
		
		<?php	include_once '../../predlosci/podnozje.php'; ?>
		<?php	include_once '../../predlosci/skripte.php'; ?>
		
	</body>
</html>
