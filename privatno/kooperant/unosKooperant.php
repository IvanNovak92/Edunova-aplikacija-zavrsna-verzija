<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

$greska=array();

if(isset($_POST["ime"])){
	if(trim($_POST["ime"])===""){
		$greske["ime"]="Morate unjeti ime kooperanta";
	}
	
	if(count($greska)==0){
		$izraz=$veza->prepare("insert into kooperant (ime,ziro_racun) values (:ime,:ziro_racun)");
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
							
							<label id="ime" for="ime">Kooperant</label>
							<input <?php 
							if(isset($greske["ime"])){
								echo " style=\"background-color: #f7e4e1\" ";
							}
							?> 
							name="ime" id="ime" value="<?php echo isset($_POST["ime"]) ? $_POST["ime"] : "" ?>" type="text" />
							<br />
							<label for="ziro_racun">Ziro racun</label>
							<input name="ziro_racun" id="ziro_racun" type="number"min="11" maxlength="11" />
							
							<input type="submit" class="button expanded" value="Dodaj"/>
							
							<a href="index.php" class="alert button expanded">Prekini unos</a>
							<?php if(isset($unioRedova) && $unioRedova>0):?>
							<h1 id="unio" class="success button expanded">Uspjesno ste dodali kooperanta</h1>														
							<?php endif;?>
						</fieldset>
					</form>	
			</div>
		</div>
		
		
			</body>
</html>