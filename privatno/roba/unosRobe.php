<?php
include_once '../../konfiguracija.php';
provjeraLogin();

$greska = array();

if (isset($_POST["vrsta_robe"])) {
	if (trim($_POST["vrsta_robe"]) === "") {
		$greske["vrsta_robe"] = "Obavezan unos vrste robe";
	}

	if (count($greska) == 0) {
		$izraz = $veza -> prepare("insert into roba (vrsta_robe,naziv,jedinica_mjere)
		 values (:vrsta_robe,:naziv,:jedinica_mjere)");
		$unioRedova = $izraz -> execute($_POST);
	}
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../../predlosci/head.php';
		?>
	</head>
	<body>
		<?php
		include_once '../../predlosci/meni.php';
		?>
		<div class="row" align="center">
			<div class="large-4 columns large-centered">
				<form method="POST">
					<fieldset class="fieldset">
						<legend>
							Unosni podaci
						</legend>

						<label id="vrsta_robe" for="vrsta_robe">Vrsta Robe</label>
						<input <?php
						if (isset($greske["vrsta_robe"])) {
							echo " style=\"background-color: #f7e4e1\" ";
						}
						?>
						name="vrsta_robe" id="vrsta_robe"
						value="<?php echo isset($_POST["vrsta_robe"]) ? $_POST["vrsta_robe"] : "" ?>"
						type="text" />
						<br />
						<label for="naziv">Naziv</label>
						<input name="naziv" id="naziv" type="text"/>
						<br />

						<label for="jedinica_mjere">Jedinica mjere</label>
						<input name="jedinica_mjere" id="jedinica_mjere" type="text"/>
						<br />

						<input type="submit" class="button expanded" value="Dodaj"/>
						<br />
						<a href="roba.php"
						class="alert button expanded">Prekini unos</a>
						<?php if(isset($unioRedova) && $unioRedova>0):
						?>
						<h1 id="unio"
						class="success button expanded">Uspjesno ste dodali robu</h1>
						<?php endif; ?>
					</fieldset>
				</form>
			</div>
		</div>

	</body>
</html>