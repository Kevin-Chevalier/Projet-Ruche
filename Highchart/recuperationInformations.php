<?php
require_once 'fonctions.inc';


$numeroRuche = $_POST['numeroRuche'];
$dateDeDebut = $_POST['dateDeDebut'];
$dateDeFin = $_POST['dateDeFin'];
recuperationInformations($dateDeDebut, $dateDeFin,$numeroRuche);
