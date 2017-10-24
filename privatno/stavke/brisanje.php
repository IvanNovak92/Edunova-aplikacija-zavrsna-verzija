<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

//dolazim s GET metodom s stranice index
if(isset($_GET["sifra"])){
		$veza->beginTransaction();
		$izraz=$veza->prepare("select dovoz from stavke where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_GET["sifra"] ));
		$sifraStavke = $izraz->fetchColumn();
		
		$izraz=$veza->prepare("select roba from stavke where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_GET["sifra"] ));
		$sifraStavke = $izraz->fetchColumn();
				
		$izraz=$veza->prepare("select kooperant from dovoz where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_GET["sifra"] ));
		$sifraStavke = $izraz->fetchColumn();
		
		$izraz=$veza->prepare("delete from stavke where sifra=:sifra");
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
		<?php include_once '../../predlosci/meni.php'; ?>		
		<?php	include_once '../../skripte.php'; ?>
		
	</body>
</html>
