<div style="background-color: black" class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle="example-menu"></button>
  <div id="RWDmenuTitle" class="title-bar-title"><?php echo $naslovAplikacije; ?></div>
</div>

<div style="background-color: black" class="top-bar" id="example-menu">
  <div class="top-bar-left">
    <ul style="background-color: black" class="dropdown menu" data-dropdown-menu>
    	<?php if(!isset($_SESSION["logiran"])): ?>
      <li style="background-color: black" class="menu-text" onclick="location.href='<?php echo $putanjaAPP;  ?>pindex.php';" style="cursor: pointer;">Početna</li>
      <?php endif; ?>
      <?php if(isset($_SESSION["logiran"])): ?>
      <li><a href="<?php echo $putanjaAPP;  ?>privatno/roba/pindex.php">Pocetna stranica</a></li>
      <li>
        <a href="<?php echo $putanjaAPP;  ?>privatno/stavke/index.php">Stavke</a>
        <ul style="background-color:black" class="menu vertical">
          <li><a href="<?php echo $putanjaAPP;  ?>privatno/dovoz/index.php">Dovoz</a></li>
          <li><a href="<?php echo $putanjaAPP;  ?>privatno/kooperant/index.php">Kooperanti</a></li>
          <li><a href="<?php echo $putanjaAPP;  ?>privatno/roba/roba.php">Roba</a></li>
          <li><a href="<?php echo $putanjaAPP;  ?>privatno/komora/index.php">Komore</a></li>      	
        </ul>
      </li>
      
      <?php endif; ?>
      <li><a href="<?php echo $putanjaAPP;  ?>privatno/roba/pindex.php">Pocetna</a></li>
          
    </ul>
  </div>
 <div class="top-bar-right">
    <ul class="menu">
      <li style="width: 100%;">
      	<?php if(!isset($_SESSION["logiran"])): ?>
      	<a href="<?php echo $putanjaAPP;  ?>login.php" class="button expanded">Prijavi se</a>
      	<?php else: ?>
      	<a href="<?php echo $putanjaAPP;  ?>logout.php" class="alert button expanded">Odlogiraj se
      		<?php 
      		//koristim svojstva logiranog operatera
      		echo $_SESSION["logiran"]->ime . " " . $_SESSION["logiran"]->prezime; ?></a>
      	<?php endif; ?>
      	</li>
      	
    </ul>
  </div>
</div>