<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

$greska=array();

if(isset($_POST["naziv"])){
	if(trim($_POST["naziv"])===""){
		$greske["naziv"]="Obavezan unos broja komore";
	}
	
	if(count($greska)==0){
		$izraz=$veza->prepare("insert into komora (naziv,polje,kapacitet_boxeva,komad_box)
		 values (:naziv,:polje,:kapacitet_boxeva,:komad_box)");
		$unioRedova = $izraz->execute($_POST);
	}
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../predlosci/head.php'; ?>
	</head>
	<body>
		<?php include_once '../../predlosci/meni.php'; ?>
		<div class="row" align="center">
			<div class="large-4 columns large-centered">
					<form method="POST">
						<fieldset class="fieldset">
							<legend>Unosni podaci</legend>
							
							<label id="lnaziv" for="naziv">Naziv komore</label>
							<input 
							name="naziv" id="naziv" 
							value="<?php echo isset($_POST["naziv"]) ? $_POST["naziv"] : "Komora" ?>" 
							type="text" />
							<br />
							<label for="polje">Polje</label>
							<input name="polje" id="polje" type="text" value="X" />
							<br />
							
							<label for="kapacitet_boxeva">Kapacitet boxeva</label>
							<input name="kapacitet_boxeva" id="kapacitet_boxeva" type="number" />
							<br />
							
							<label for="komad_box">Komada boxa</label>
							<input name="komad_box" id="komad_box" type="number" />
							<br />
			
							<input type="submit" class="button expanded" value="Dodaj"/>
							<br />
							<a href="index.php" class="alert button expanded">Prekini unos</a>
							<?php if(isset($unioRedova) && $unioRedova>0):?>
							<h1 id="unio" class="success button expanded">Uspjesno ste dodali robu</h1>														
							<?php endif;?>
						</fieldset>
					</form>	
			</div>
		</div>
		
		</script>
		
			</body>
</html>