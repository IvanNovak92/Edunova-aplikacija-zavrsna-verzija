<?php include_once '../../konfiguracija.php'; provjeraLogin(); 


if(isset($_GET["sifra"])){
	$izraz=$veza->prepare("select * from kooperant where sifra=:sifra");
	$izraz->execute(array("sifra"=>$_GET["sifra"]));
	$kooperant = $izraz->fetch(PDO::FETCH_OBJ);
	if(isset($_GET["uvjet"])){
		$kooperant->uvjet =$_GET["uvjet"];
	}
}

if(isset($_POST["sifra"])){
	
	$uvjet="";
	if(isset($_POST["uvjet"])){
		$uvjet=$_POST["uvjet"];
		unset($_POST["uvjet"]);
	}
	$izraz=$veza->prepare("update kooperant set ime=:ime, 
							ziro_racun=:ziro_racun where sifra=:sifra");
	$izraz->execute($_POST);
	
	header("location: index.php?uvjet=" . $uvjet);

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
							
							<label id="ime" for="ime">Kooperant</label>
							<input 	name="ime" id="ime" value="<?php echo $kooperant->ime; ?>" type="text" />
							<br />
							
							<label for="ziro_racun">Ziro racun</label>
							<input name="ziro_racun" id="ziro_racun" type="number" min="11" maxlength="11" value="<?php echo $kooperant->ziro_racun; ?>"/>
							<br />						
							<input type="submit" class="succes button expanded" value="Promjeni"/>
							<br />
							<input type="hidden" name="sifra" value="<?php echo $kooperant->sifra; ?>" />
							<?php if(isset($_GET["uvjet"])):?>
							<input type="hidden" name="uvjet" value="<?php echo $kooperant->uvjet; ?>" />
							
							<?php endif;?>
							<a href="index.php" class="alert button expanded">Odustani</a>
						</fieldset>
					</form>	
			</div>
		</div>
		
		<?php	include_once '../../skripte.php'; ?>
		
	</body>
</html>