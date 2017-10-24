<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["sifra"])){
	$izraz=$veza->prepare("select * from komora where sifra=:sifra");
	$izraz->execute(array("sifra"=>$_GET["sifra"]));
	$komora = $izraz->fetch(PDO::FETCH_OBJ);
	if(isset($_GET["uvjet"])){
		$komora->uvjet =$_GET["uvjet"];
	}
}

if(isset($_POST["sifra"])){
	
	$uvjet="";
	if(isset($_POST["uvjet"])){
		$uvjet=$_POST["uvjet"];
		unset($_POST["uvjet"]);
	}
	$izraz=$veza->prepare("update komora set naziv=:naziv, 
							polje=:polje,
							kapacitet_boxeva=:kapacitet_boxeva,
							komad_box=:komad_box where sifra=:sifra");
	$izraz->execute($_POST);
	
	header("location: index.php?uvjet=" . $uvjet);
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../predlosci/head.php'; ?>
	</head>
	<body>
		<?php include_once '../../predlosci/meni.php'; ?>
		<form method="POST">
		<div class="row">
			<div class="large-8 columns large-centered">
				<div class="row">
					<div class="large-6 columns">
							
								<fieldset class="fieldset">
									<legend>Unosni podaci</legend>
									
									<label id="naziv" for="naziv">Naziv</label>
									<input 	name="naziv" id="naziv" 
									value="<?php echo $komora->naziv; ?>"
									 type="text" />
									
									<label id="polje" for="polje">Polje</label>
									<input 	name="polje" id="polje" 
									value="<?php echo $komora->polje; ?>"
									type="text" />
																
									<label id="kapacitet_boxeva" 
									for="kapacitet_boxeva">Kapacitet boxa</label>
									<input 	name="kapacitet_boxeva" id="kapacitet_boxeva" 
									value="<?php echo $komora->kapacitet_boxeva; ?>" 
									type="number"/>
									
									<label id="komad_box" 
									for="komad_box">Komada boxa</label>
									<input 	name="komad_box" id="komad_box" 
									value="<?php echo $komora->komad_box; ?>" 
									type="number"/>
									
									
									
									
							
					
				<input type="submit" class="succes button expanded" value="Promjeni"/>
							<br />
							<input type="hidden" name="sifra" 
							value="<?php echo $komora->sifra; ?>" />
							
							<?php if(isset($_GET["uvjet"])):?>
							<input type="hidden" name="uvjet" 
							value="<?php echo $komora->uvjet; ?>" />
							
							<?php endif;?>
				
					<a href="index.php" class="alert button expanded">Odustani</a>			
			</div>
		</div>
		</form>	

		<?php	include_once '../../skripte.php'; ?>
		
	</body>
</html>