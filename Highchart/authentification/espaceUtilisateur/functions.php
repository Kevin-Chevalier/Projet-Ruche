<?php 

function debug($variable){
	echo '<pre>' , print_r($variable,true). '</pre>';
}

function securisation(){
    if(session_status()== PHP_SESSION_NONE){
    
        session_start();
    } 
 if(!isset($_SESSION['auth'])){
     $_SESSION['flash']['securisation'] = "Vous n'avez pas le droit d'accéder à cette page";
     header('Location: connexion.php');
     exit();
    }
}