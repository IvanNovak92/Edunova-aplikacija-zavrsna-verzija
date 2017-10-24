<?php

include_once '../../konfiguracija.php'; provjeraLogin();

$veza->beginTransaction();


$izraz=$veza->prepare("insert into kooperant(ime,ziro_racun) values ('','')");
$izraz->execute();
$zadnji = $veza->lastInsertId();

$izraz=$veza->prepare("insert into dovoz(kooperant,datum_berbe,datum_dovoza,klasa_robe) values ('" . $zadnji . "','','','')");
$izraz->execute();
$zadnji = $veza->lastInsertId();
$zadnji2=$zadnji=$veza->lastInsertId();

$izraz=$veza->prepare("insert into roba(vrsta_robe) values ('')");
$izraz->execute();
$zadnji3 = $veza->lastInsertId();

$izraz=$veza->prepare("insert into komora(naziv,kapacitet_boxeva,komad_box) values ('','','')");
$izraz->execute();
$zadnji4 = $veza->lastInsertId();

$izraz=$veza->prepare("insert into stavke(naziv,komora,roba,kolicina,dovoz) values ('Izmjenite br stavke','" . $zadnji4 . "','" . $zadnji3 . "','','" . $zadnji2 . "')");
$izraz->execute();
$zadnji5=$veza->lastInsertId();

$veza->commit();

header("location: promjena.php?sifra=" . $zadnji5);

