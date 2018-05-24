<?php
require_once 'dbconfig.inc';


function connexionBDD() {


// connexion à la base
    try {

        $bdd = new PDO('mysql:host=' . SERVEURBD . ';dbname=' . NOMDELABASE, LOGIN, MOTDEPASSE);
    } catch (Exception $ex) {
        die('<br /> Pb de connexion serveur BD : ' . $ex->getMessage());
    }
    return $bdd;
}

function recuperationInformationsRuche($numeroRuche) {
    $bdd = connexionBDD();
    if ($bdd != null) {
        $requete = $bdd->prepare('SELECT *  FROM `ruches` WHERE `idRuches` = :idRuche');
$requete->bindParam(':idRuche', $numeroRuche);
        $requete->execute() or die(print_r($requete->errorInfo()));
        $tabRuche = array();
        while ($ligne = $requete->fetch()) {
            array_push($tabRuche, array(
                'idRuches' => $ligne['idRuches'],
                'nomRuche' => utf8_encode($ligne['nomRuche']),
                'seuilPoids' => utf8_encode($ligne['seuilPoids']),
                'seuilTempBasse' => $ligne['seuilTempBasse'],
                'seuilTempHaute' => $ligne['seuilTempHaute'],
                'longitude' => $ligne['longitude'],
                'latitude' => $ligne['latitude'],
                'altitude' => $ligne['altitude'],
                'ville' => utf8_encode($ligne['ville']),
                'apiculteurs_idapiculteurs' => $ligne['apiculteurs_idapiculteurs'],
                'descriptionRuche' => utf8_encode($ligne['descriptionRuche'])
            ));
        }
        $requete->closeCursor();
        echo json_encode($tabRuche);
    }
}

function recuperationInformations($dateDeDebut, $dateDeFin,$numeroRuche){
    $bdd = connexionBDD();
    if ($bdd != null) {
        $requete = $bdd->prepare('SELECT *  FROM `mesures` WHERE `ruches_idRuches` = :idRuche');
        $requete->bindParam(':idRuche', $numeroRuche);

        $requete->execute() or die(print_r($requete->errorInfo()));
        $tabMesures = array();
        while ($ligne = $requete->fetch()) {
            array_push($tabMesures, array(
                'eclairement' => $ligne['eclairementval'],
                'pression' => $ligne['pressionval'],
                'temperature' => utf8_encode($ligne['tempval']),
                'poids' => $ligne['poidsval'],
                'date' => $ligne['date']
            ));
        }
        $requete->closeCursor();
        echo json_encode($tabMesures);
    }
}
