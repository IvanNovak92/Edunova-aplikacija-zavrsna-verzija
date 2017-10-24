<?php

include_once '../../konfiguracija.php'; provjeraLogin();

$veza->beginTransaction();


$izraz=$veza->prepare("insert into kooperant(ime,ziro_racun) values ('','')");
$izraz->execute();
$zadnji = $veza->lastInsertId();

$izraz=$veza->prepare("insert into dovoz(kooperant,datum_berbe,datum_dovoza,klasa_robe) values ('" . $zadnji . "','','','')");
$izraz->execute();
$zadnji = $veza->lastInsertId();
$veza->commit();

header("location: promjena.php?sifra=" . $zadnji);

