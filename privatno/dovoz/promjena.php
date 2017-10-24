<?php include_once '../../konfiguracija.php'; provjeraLogin(); 


if(isset($_GET["sifra"])){
	
	$izraz=$veza->prepare("select a.sifra,b.ime, a.datum_berbe, a.datum_dovoza, a.kooperant,a.klasa_robe, b.ziro_racun from 
	dovoz a inner join kooperant b on a.kooperant=b.sifra
	where a.sifra=:sifra");
	$izraz->execute(array("sifra"=>$_GET["sifra"]));
	//instanca klase stdClass koji sadrži sve podatke o smjeru iz baze
	$entitet = $izraz->fetch(PDO::FETCH_OBJ);

}else{
	header("location: index.php");
}
//kliknuo sam na gumb Promjeni
if(isset($_POST["promjena"])){
	$veza->beginTransaction();
	$izraz=$veza->prepare("update dovoz set datum_berbe=:datum_berbe,datum_dovoza=:datum_dovoza,klasa_robe=:klasa_robe where sifra=:sifra");
	$izraz->execute(array("datum_berbe"=>$_POST["datum_berbe"],"datum_dovoza"=>$_POST["datum_dovoza"],"klasa_robe"=>$_POST["klasa_robe"],"sifra"=>$_POST["sifra"] ));
	$izraz=$veza->prepare("update kooperant set ime=:ime, ziro_racun=:ziro_racun where sifra=
	(select kooperant from dovoz where sifra=:sifra)");
	$izraz->execute(array("ime"=>$_POST["ime"],"ziro_racun"=>$_POST["ziro_racun"],"sifra"=>$_POST["sifra"] ));
	$veza->commit();
	//vratim se na pregled 
	header("location: index.php");
}

if(isset($_POST["odustani"])){
	if($_POST["ime"]=="" && $_POST["ziro_racun"]==""){
		$veza->beginTransaction();
		$izraz=$veza->prepare("select kooperant from dovoz where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_POST["sifra"] ));
		$sifraKooperant = $izraz->fetchColumn();
		$izraz=$veza->prepare("delete from dovoz where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_POST["sifra"] ));
		$izraz=$veza->prepare("delete from kooperant where sifra=:sifra");
		$izraz->execute(array("sifra"=>$sifraKooperant ));
		$veza->commit();
	}
	//vratim se na pregled 
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
		<div class="row">
			<div class="large-4 columns large-centered">
					<form method="POST">
						<fieldset class="fieldset">
							<legend>Unosni podaci</legend>
							
							<label for="ime">Kooperant</label>
							<input 	name="ime" id="ime" value="<?php echo $entitet->ime; ?>" type="text" />
							
							<label for="ziro_racun">Ziro racun</label>
							<input 	name="ziro_racun" id="ziro_racun" value="<?php echo $entitet->ziro_racun; ?>" type="text" />
							
							<label for="datum_berbe">Datum berbe</label>
							<input 	name="datum_berbe" id="datum_berbe" value="<?php echo $entitet->datum_berbe; ?>" type="date" />
							
							<label for="datum_dovoza">Datum dovoza</label>
							<input 	name="datum_dovoza" id="datum_dovoza" value="<?php echo $entitet->datum_dovoza; ?>" type="date" />
							
							<label for="klasa_robe">Klasa robe</label>
							<input 	name="klasa_robe" id="klasa_robe" value="<?php echo $entitet->klasa_robe; ?>" type="text" />
												
							<input name="promjena" type="submit" class="button expanded" value="<?php 
							if($entitet->ime=="" && $entitet->ziro_racun==""){
								echo "Dodaj novi";
							}else{
								echo "Promjeni";
							}
							
							?>"/>
							
							<input type="hidden" name="sifra" value="<?php echo $entitet->sifra; ?>" />
							
							<input name="odustani" type="submit" class="alert button expanded" value="Odustani"/>
						</fieldset>
					</form>	
			</div>
		</div>
	
		<?php	include_once '../../skripte.php'; ?>
		
	</body>
</html>
