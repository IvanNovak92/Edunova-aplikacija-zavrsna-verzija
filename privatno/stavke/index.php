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
					
							<a href="unosStavke.php" class="success button expanded">Novi dovoz robe</a>
							
					
						
					<table style="text-align: left">
						<thead>
							<tr>
								<th>Stavka</th>
								<th>Komora</th>
								<th>Roba</th>
								<th>Kolicina</th>
								<th>Dovoz</th>
								<th>Kooperanti</th>
								<th>Akcija</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$izraz = $veza->prepare("select a.sifra,a.naziv as Stavka,a.komora,a.roba, 
							a.kolicina,a.dovoz,e.ime as Kooperanti
							from stavke a 
							inner join dovoz b on a.dovoz=b.sifra
							inner join komora c on a.komora=c.sifra
							inner join roba d on a.roba=d.sifra
							inner join kooperant e on b.kooperant=e.sifra							
							where roba like :uvjet");
							$uvjet="%" . $uvjet . "%";
							$izraz->execute(array("uvjet"=>$uvjet));
							$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
							foreach ($rezultati as $red) :
							?>
							<tr>
								<td><?php echo $red -> Stavka; ?></td>
								<td><?php echo $red -> komora; ?></td>
								<td><?php echo $red -> roba; ?></td>
								<td><?php echo $red -> kolicina; ?></td>
								<td><?php echo $red -> dovoz; ?></td>
								<td><?php echo $red -> Kooperanti; ?></td>
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