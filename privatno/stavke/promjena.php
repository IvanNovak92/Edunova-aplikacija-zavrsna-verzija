<?php include_once '../../konfiguracija.php'; provjeraLogin(); 


if(isset($_GET["sifra"])){
	
	$izraz=$veza->prepare("select a.sifra,a.naziv,a.komora,a.roba, 
							a.kolicina,a.dovoz,
							b.datum_berbe,b.datum_dovoza,b.kooperant,b.klasa_robe,
							c.naziv nazivKomora,c.polje,c.kapacitet_boxeva,c.komad_box,
							d.vrsta_robe,
							e.ime,e.ziro_racun
							from stavke a 
							inner join dovoz b on a.dovoz=b.sifra
							inner join komora c on a.komora=c.sifra
							inner join roba d on a.roba=d.sifra
							inner join kooperant e on b.kooperant=e.sifra		
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
	
	//dovoz
	$izraz=$veza->prepare("update dovoz set datum_berbe=:datum_berbe,datum_dovoza=:datum_dovoza,
	klasa_robe=:klasa_robe where sifra=:sifra");
	$izraz->execute(array("datum_berbe"=>$_POST["datum_berbe"],"datum_dovoza"=>$_POST["datum_dovoza"],
	"klasa_robe"=>$_POST["klasa_robe"],"sifra"=>$_POST["sifra"] ));
	
	//kooperant
	$izraz=$veza->prepare("update kooperant set ime=:ime, ziro_racun=:ziro_racun where sifra=
	(select kooperant from dovoz where sifra=:sifra)");
	$izraz->execute(array("ime"=>$_POST["ime"],"ziro_racun"=>$_POST["ziro_racun"],"sifra"=>$_POST["sifra"] ));
	
	//komora
	$izraz=$veza->prepare("update komora set naziv=:naziv, polje=:polje where sifra=
	(select komora from stavke where sifra=:sifra)");
	$izraz->execute(array("naziv"=>$_POST["nazivKomora"],"polje"=>$_POST["polje"],"sifra"=>$_POST["sifra"] ));
	
	//roba
	$izraz=$veza->prepare("update roba set vrsta_robe=:vrsta_robe where sifra= (select roba from stavke where sifra=:sifra)");
	$izraz->execute(array("vrsta_robe"=>$_POST["vrsta_robe"],"sifra"=>$_POST["sifra"] ));
	
	//stavke
	$izraz=$veza->prepare("update stavke set naziv=:naziv,kolicina=:kolicina where sifra=:sifra");
	$izraz->execute(array("naziv"=>$_POST["naziv"],"kolicina"=>$_POST["kolicina"],"sifra"=>$_POST["sifra"] ));
	
	
	
	
	$veza->commit();
	//vratim se na pregled 
	header("location: index.php");
}

if(isset($_POST["odustani"])){
	if($_POST["naziv"]=="" && $_POST["ziro_racun"]==""){
		$veza->beginTransaction();
		$izraz=$veza->prepare("select dovoz from stavke where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_POST["sifra"] ));
		$sifraStavke = $izraz->fetchColumn();
		
		$izraz=$veza->prepare("select roba from stavke where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_POST["sifra"] ));
		$sifraStavke = $izraz->fetchColumn();
		
		$izraz=$veza->prepare("select komora from stavke where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_POST["sifra"] ));
		$sifraStavke = $izraz->fetchColumn();
		
		$izraz=$veza->prepare("select kooperant from dovoz where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_POST["sifra"] ));
		$sifraStavke = $izraz->fetchColumn();
		
		$izraz=$veza->prepare("delete from stavke where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_POST["sifra"] ));
		
		$izraz=$veza->prepare("delete from kooperant where sifra=:sifra");
		$izraz->execute(array("sifra"=>$sifraStavke ));
		
		$izraz=$veza->prepare("delete from dovoz where sifra=:sifra");
		$izraz->execute(array("sifra"=>$sifraStavke ));
		
		$izraz=$veza->prepare("delete from roba where sifra=:sifra");
		$izraz->execute(array("sifra"=>$sifraStavke ));
		
		$izraz=$veza->prepare("delete from komora where sifra=:sifra");
		$izraz->execute(array("sifra"=>$sifraStavke ));
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
							<legend>Obavezno unjeti sve podatke</legend>
							
							<label for="naziv">Naziv stavke</label>
							<input 	name="naziv" id="naziv" value="<?php echo $entitet->naziv; ?>" type="text" />
							
							<label for="polje">Polje u komori</label>
							<input 	name="polje" id="polje" value="<?php echo $entitet->polje; ?>" type="text" />
							
							<label for="nazivKomora">Naziv komore</label>
							<input 	name="nazivKomora" id="nazivKomora" value="<?php echo $entitet->nazivKomora; ?>" type="text" />
													
							<label for="vrsta_robe">Vrsta robe</label>
							<input 	name="vrsta_robe" id="vrsta_robe" value="<?php echo $entitet->vrsta_robe; ?>" type="text" />
							
							<label for="kolicina">Kolicina u kg</label>
							<input 	name="kolicina" id="kolicina" value="<?php echo $entitet->kolicina; ?>" type="text" />
							
							<label for="dovoz">Sifra dovoza </label>
							<input 	name="dovoz" id="dovoz" value="<?php echo $entitet->dovoz; ?>" type="text" />
							
																					
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
							if($entitet->naziv=="" && $entitet->ziro_racun==""){
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
