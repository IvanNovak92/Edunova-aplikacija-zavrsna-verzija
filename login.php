<?php include_once 'konfiguracija.php';  ?>
<head>
	<?php include_once 'predlosci/head.php'; ?>
</head>
<body bgcolor="E9967A">
	<div class="row">
			<div class="large-6 large-centered columns">
				<div class="callout">
				
				<div align="center" class="row">
					
						<h1 style="width: 100%; text-align: center"><?php echo $naslovAplikacije ?></h1>
						<?php 
						if(isset($_GET["neuspio"])){
							echo "Niste dobro unjeli korisnika i lozinku!";
						}
						
						if(isset($_GET["nemateOvlasti"])){
							echo "Potreban je login!";
						}
						
						if(isset($_GET["odlogiranSi"])){
							echo "Odjavljeni ste!";
						}
						 ?>
						 <form method="post" action="<?php echo $putanjaAPP;  ?>autorizacija.php" style>
						 <label for="korisnik">Email</label>
						 <input type="text" name="korisnik" id="korisnik" placeholder="ivannovak92@yahoo.com" title="ivannovak92@yahoo.com"
						 value="<?php echo isset($_GET["korisnik"]) ? $_GET["korisnik"] : "" ;  ?>" />
						 <label for="lozinka">Lozinka</label>
						
						 <input type="password"name="lozinka" id="lozinka" placeholder="p" />
						 <input type="submit" class="button expanded" style="background-color: green" value="Autorizacija" />
						 	
						 </form>
						 <?php include_once 'skripte.php';   ?>
</body>