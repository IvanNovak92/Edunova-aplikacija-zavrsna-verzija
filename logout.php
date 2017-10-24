<?php include_once '../konfiguracija.php';  

session_destroy();
header("location: " . $putanjaAPP . "login.php?odlogiranSi");