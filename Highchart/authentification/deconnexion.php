<!----------------------------------------------------------------------------------
    @fichier  connexion.php							    							|
    @auteur   Algin TOSHI (Touchard Washington le Mans)								|
    @date     Avril 2018															|
    @version  v1.0 - First release													|
    @details  page qui permet de se Deconnecté										     		|
 																				    |
------------------------------------------------------------------------------------>

<?php

 session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['deconnexion'] = 'Vous êtes maintenant déconnecté';
header('Location: ../connexion.php');
