<?php

 session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['deconnexion'] = 'Vous êtes maintenant déconnecté';
header('Location: ../connexion.php');
