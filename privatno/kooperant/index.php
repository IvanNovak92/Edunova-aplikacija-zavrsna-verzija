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
<body>
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
					
							<a href="unosKooperant.php" class="success button expanded">Dodaj novog kooperanta</a>
							
					
						
					<table style="text-align: left">
						<thead>
							<tr>
								<th>Ime</th>
								<th>Ziro racun</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
							$izraz = $veza->prepare("select sifra, ime,ziro_racun from kooperant
							where ime like :uvjet
							group by ime,ziro_racun ");
							$uvjet="%" . $uvjet . "%";
							$izraz->execute(array("uvjet"=>$uvjet));
							$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
							foreach ($rezultati as $red) :
							?>
							<tr>
								<td><?php echo $red -> ime; ?></td>
								<td><?php echo $red -> ziro_racun; ?></td>
								
								<td><a href="promjenaKooperant.php?sifra=<?php echo $red -> sifra;

									if (isset($_GET["uvjet"])) {
										echo "&uvjet=" . $_GET["uvjet"];
									}
								?>">Promjeni</a> 
								
								
								<a href="brisanjeKooperant.php?sifra=<?php echo $red -> sifra;
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