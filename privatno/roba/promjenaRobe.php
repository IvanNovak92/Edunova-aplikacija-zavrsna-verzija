<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["sifra"])){
	$izraz=$veza->prepare("select * from roba where sifra=:sifra");
	$izraz->execute(array("sifra"=>$_GET["sifra"]));
	$roba = $izraz->fetch(PDO::FETCH_OBJ);
	if(isset($_GET["uvjet"])){
		$roba->uvjet =$_GET["uvjet"];
	}
}

if(isset($_POST["sifra"])){
	
	$uvjet="";
	if(isset($_POST["uvjet"])){
		$uvjet=$_POST["uvjet"];
		unset($_POST["uvjet"]);
	}
	$izraz=$veza->prepare("update roba set vrsta_robe=:vrsta_robe,naziv=:naziv,
	jedinica_mjere=:jedinica_mjere where sifra=:sifra");
	$izraz->execute($_POST);
	
	header("location: roba.php?uvjet=" . $uvjet);



}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../predlosci/head.php'; ?>
	</head>
	<body bgcolor="E9967A">
		<?php include_once '../../predlosci/meni.php'; ?>
		<div class="row">
			<div class="large-4 columns large-centered">
					<form method="POST">
						<fieldset class="fieldset">
							<legend>Obavite izmjenu na polju kojem želite</legend>
							
							<label id="lvrsta_robe" for="vrsta_robe">Vrsta robe</label>
							<input 	name="vrsta_robe" id="vrsta_robe" 
							value="<?php echo $roba->vrsta_robe; ?>" type="text" />
							<br />
							
							<label id="naziv" for="naziv">Naziv</label>
							<input 	name="naziv" id="naziv" 
							value="<?php echo $roba->naziv; ?>" type="text" />
							<br />
							<label id="jedinica_mjere" for="jedinica_mjere">Jedinica mjere</label>
							<input 	name="jedinica_mjere" id="jedinica_mjere" 
							value="<?php echo $roba->jedinica_mjere; ?>" type="text" />
							<br />
							<input type="submit" class="succes button expanded" value="Promjeni"/>
							<br />
							<input type="hidden" name="sifra" value="<?php echo $roba->sifra; ?>" />
							<?php if(isset($_GET["uvjet"])):?>
							<input type="hidden" name="uvjet" value="<?php echo $roba->uvjet; ?>" />
							
							<?php endif;?>
							<a href="roba.php" class="alert button expanded">Odustani</a>
						</fieldset>
					</form>	
			</div>
		</div>
		
		<?php	include_once '../../skripte.php'; ?>
		
	</body>
</html>