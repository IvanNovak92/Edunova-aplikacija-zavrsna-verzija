<?php include_once '../../konfiguracija.php'; provjeraLogin(); ?>
<?php 
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
include_once '../../predlosci/head.php';
  ?>
	</head>
	<body>
	<?php include_once '../../predlosci/meni.php';?>
		<div class="row">
			<div class="large-12 columns">
				<div class="callout">
					<div class="row">
						<div class="large-6 columns">
							<form method="GET">
								<input type="text" placeholder="dio naziva" name="uvjet" 
								value="<?php echo $uvjet; ?>"/>	
							</form>
							
						</div>						
						<div class="large-6 columns">
							<a href="unosRobe.php" class="success button expanded">Dodaj novu</a>
						</div>
					</div>
					<table class="hover unstriped">
						<thead>
							<tr>
								<th>Vrsta robe</th>
								<th>Naziv</th>	
								<th>Jedinica mjere</th>	
								<th>Akcija</th>						
							</tr>
						</thead>
						<tbody>
							<?php 						
							$izraz = $veza->prepare("select sifra,vrsta_robe,naziv,jedinica_mjere from roba
							where vrsta_robe like :uvjet");
							$uvjet="%" . $uvjet . "%";
							$izraz->execute(array("uvjet"=>$uvjet));
							$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);			
							foreach ($rezultati as $red) :
							?>
							<tr>								
								<td><?php echo $red->vrsta_robe; ?></td>
								<td><?php echo $red->naziv; ?></td>
								<td><?php echo $red->jedinica_mjere; ?></td>
								<td><a href="promjenaRobe.php?sifra=<?php echo $red -> sifra;

									if (isset($_GET["uvjet"])) {
										echo "&uvjet=" . $_GET["uvjet"];
									}
								?>">Promjeni</a>  
								
								<a href="brisanjeRobe.php?sifra=<?php echo $red -> sifra;
									if (isset($_GET["uvjet"])) {
										echo "&uvjet=" . $_GET["uvjet"];
									}
								?>">Obriši</a>
								
								
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>					
				</div>
				
			</div>
		</div>
		<?php
		include_once '../../skripte.php';
 ?>
		
	</body>
</html>