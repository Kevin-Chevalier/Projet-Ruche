<!----------------------------------------------------------------------------------
    @fichier  connexion.php							    							|
    @auteur   Algin TOSHI (Touchard Washington le Mans)								|
    @date     Avril 2018															|
    @version  v1.0 - First release													|
    @details  connexion à la bdd										     		|
 																				    |
------------------------------------------------------------------------------------>


<?php

require_once('definitions.inc.php');

// connexion à la base


    $bdd = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, UTILISATEUR,PASSE);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


