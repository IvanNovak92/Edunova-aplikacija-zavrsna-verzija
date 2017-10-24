<?php
include_once '../../konfiguracija.php';
provjeraLogin();
 ?>
<?php
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";
?>
<head> <?php
include_once '../../predlosci/head.php';
  ?>
	
</head>
<body bgcolor="E9967A">
	<?php
	include_once '../../predlosci/meni.php';
  ?>
	<div class="row" align="center">
<div class="large 6 columns">
				<div class="callout large-6 columns">
					<div class="row">
						<div class="small-4 large-6 columns" align="left">
							<form method="GET">
								<input type="text" placeholder="Unesite kooperanta" name="uvjet" 
								value="<?php echo $uvjet; ?>"/>	
							</form>
							
						<div class="row">
						<div class="small-4 large-6 columns" align="right">
					
							<a href="unosDovoz.php" class="success button expanded">Novi dovoz robe</a>
							
					
						
					<table style="text-align: left">
						<thead>
							<tr>
								<th>Datum berbe</th>
								<th>Datum dovoza</th>
								<th>Klasa robe</th>
								<th>Kooperant</th>
								<th>Akcija</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$izraz = $veza->prepare("select a.sifra,a.datum_berbe,a.datum_dovoza,a.klasa_robe, 
							b.ime
							from dovoz a inner join kooperant b on a.kooperant=b.sifra
							where ime like :uvjet
							group by a.sifra,a.datum_berbe,a.datum_dovoza,a.klasa_robe, 
							Kooperant ");
							$uvjet="%" . $uvjet . "%";
							$izraz->execute(array("uvjet"=>$uvjet));
							$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
							foreach ($rezultati as $red) :
							?>
							<tr>
								<td><?php echo $red -> datum_berbe; ?></td>
								<td><?php echo $red -> datum_dovoza; ?></td>
								<td><?php echo $red -> klasa_robe; ?></td>
								<td><?php echo $red -> ime; ?></td>
								
								<td><a href="promjena.php?sifra=<?php echo $red -> sifra;

									if (isset($_GET["uvjet"])) {
										echo "&uvjet=" . $_GET["uvjet"];
									}
								?>">Promjeni</a> 
								
								
								<a href="brisanje.php?sifra=<?php echo $red -> sifra;
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
					</div>
			</div>
		</div>
		
		
		<?php
		include_once '../../skripte.php';
 ?>
		
	</body>
</html>