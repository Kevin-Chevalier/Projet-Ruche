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
Données météo éxterieur (OpenWeather)</br>
<center>

<table border="1" class="table table-dark">
    
        <tr>
            <td>La température :</td>
            <td></td>
        </tr>
    
    
        <tr>
            <td>Le vent en m/s :</td>
            <td></td>
        </tr>
        <tr>
            <td>La pression atmosphérique en hPa :</td>
            <td></td>
        </tr>
        <tr>
            <td>L’humidité :</td>
            <td></td>
        </tr>
        <tr>
            <td>La précipitation  :</td>
            <td></td>
        </tr>
    
</table>
</center>
  
<?php require '../../corpsPages/footer.php'; ?>





