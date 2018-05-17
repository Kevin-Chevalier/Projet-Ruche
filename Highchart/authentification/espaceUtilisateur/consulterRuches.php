<?php 
require_once 'functions.php';
securisation();
require '../../corpsPages/header.php'; 
?>

<!-------------------------------------------------- MENU UTILISATEUR ---------------------------------------------------------->

<h2>Vous êtes actuellement Connecté</h2><br>
 
        <div class="col-sm-offset-1 col-sm-10">
        <ul class="nav nav-tabs">        
            <a name="boutonRuches" class="btn btn-default" href="consulterRuches.php">Vos ruches</a> 
            <a name="boutonCreer"class="btn btn-default" href="creerRuche.php">Créer une ruche</a> 
            <a name="boutonInfos" type="submit" class="btn btn-default" href="infosPerso.php">Informations personnelles</a> 
            <a name="boutonAdmin" type="submit" class="btn btn-default" href="administrateur.php">Administration</a> 
        </ul>
        </div>

<br><br>
 <!-------------------------------------------------- CONSULTER RUCHES ---------------------------------------------------------->

ruche 1 ruche 2

  
<?php require '../../corpsPages/footer.php'; ?>




