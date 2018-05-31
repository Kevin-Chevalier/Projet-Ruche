<?php


require_once("dbconfig.inc");
function connexionBDD() {


// connexion à la base
    try {

        $bdd = new PDO('mysql:host=' . SERVEURBD . ';dbname=' . NOMDELABASE, LOGIN, MOTDEPASSE);
    } catch (Exception $ex) {
        die('<br /> Pb de connexion serveur BD : ' . $ex->getMessage());
    }
    return $bdd;
}


function obtenirValeur() {
$bdd = connexionBDD();
 $requete = $bdd->prepare('SELECT *  FROM `mesures` WHERE `ruches_idRuches` = :idRuche');
$requete->bindParam(':idRuche', $_GET['id']); 
$requete->execute() or die(print_r($requete->errorInfo()));
$temperature = array();
$humidite = array();
$pression = array();
$poids = array();
$eclairement = array();
$date = array();
$datecomp = array();


while($ligne = $requete->fetch()){
    array_push($temperature, floatval($ligne['tempval']));
    array_push($humidite, floatval($ligne['humidval']));
    array_push($pression, floatval($ligne['pressionval']));
    array_push($poids, floatval($ligne['poidsval']));
    array_push($eclairement, floatval($ligne['eclairementval']));
    array_push($date, date($ligne['date'])); //rentre la date dans le tableau 
    array_push($datecomp, date($ligne['date'])); //inverse la date pour permettre la comparaison avec les datepicker.
}

$valeurs = array();
$tooltip = array();


$series = array();
$tooltip['valueSuffix'] = " °C";
$serie['name'] = "Température";
$serie['type']  = "spline";
$serie['tooltip'] = $tooltip;
$serie['data']  = $temperature;
array_push($series, $serie);

$tooltip['valueSuffix'] = " %";
$serie['name'] = "Humidité";
$serie['type']  = "spline";
$serie['tooltip'] = $tooltip;
$serie['data']  = $humidite;
array_push($series, $serie);

$tooltip['valueSuffix'] = " hPa";
$serie['name'] = "Pression";
$serie['type']  = "spline";
$serie['tooltip'] = $tooltip;
$serie['data']  = $pression;
array_push($series, $serie);

$tooltip['valueSuffix'] = " lux";
$serie['name'] = "Eclairement";
$serie['type']  = "spline";
$serie['tooltip'] = $tooltip;
$serie['data']  = $eclairement;
array_push($series, $serie);


$tooltip['valueSuffix'] = " g";
$serie['name'] = "Poids";
$serie['type']  = "spline";
$serie['tooltip'] = $tooltip;
$serie['yAxis']=1;
$serie['data']  = $poids;
array_push($series, $serie);


$valeurs['series'] = $series;

echo json_encode($valeurs);
}
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
obtenirValeur(connexionBDD());