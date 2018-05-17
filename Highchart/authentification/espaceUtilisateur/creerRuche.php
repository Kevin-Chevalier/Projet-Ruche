<?php 
require_once 'functions.php';
securisation();
require '../../corpsPages/header.php'; 

//script
if(!empty($_POST)){
     $message = array();
     require_once '../connexionBDD.php'; // Connexion à la bdd 
     $user_id = $_SESSION['auth']->idapiculteurs;
     
    
    
     
     if (empty($_POST['ville'])|| !preg_match('/^[a-zA-Z]+$/',$_POST['ville'])){
        $_SESSION['flash']['ville'] = "Le champ 'Ville' est incorrect, seul les lettres sont autorisés !";
    } 
     
  
   if(empty($_SESSION['flash']['ville'])){ //Si aucune erreur sur le formulaire alors injection des informations dans la BDD
    
        
        $req = $bdd->prepare("INSERT INTO ruches SET ville = ?, longitude = ?, latitude = ? ,  altitude= ?, descriptionRuche = ?, apiculteurs_idapiculteurs = $user_id");
        
        $req->execute([$_POST['ville'], $_POST['longitude'], $_POST['latitude'], $_POST['altitude'], $_POST['description']]);
            
            
             $_SESSION['flash']['ruche'] = "La ruche à été crée.";
          
    }
 
}
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
 
<!-------------------------------------------------- ADMINISTRATEUR ---------------------------------------------------------->
<br/>

 <center><h3><small>Créer une nouvelle ruche</small></h3></center><br>

<div class="contenu text-left"> 
    
    <form class="form-horizontal" action=""  method="POST">
    <br/>
    <div class="row">
        <div class="col-md-offset-3 col-md-1">
            <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" placeholder="" >
            </div>
        </div>
        
    </div>

    <div class="row">
         <div class="col-md-offset-3 col-md-2">
            <div class="form-group">
            <label for="longitude">Longitude(en degrés)</label>
            <input type="text" class="form-control" id="ville" name="longitude" placeholder="" >
            </div>
        </div>
        
        <div class="col-md-offset-0 col-md-2">
            <div class="form-group">
            <label for="latitude">Latitude(en degrés)</label>
            <input type="text" class="form-control" id="prenom" name="latitude" placeholder="" >
            </div>
        </div>
        
        <div class="col-md-offset-0 col-md-2">
            <div class="form-group">
            <label for="altitude">Altitude</label>
            <input type="text" class="form-control" id="prenom" name="altitude" placeholder="" >
            </div>
        </div>
    </div>


<div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="form-group">
            <label for="description">Description ( Facultatif )</label>
            <input type="text" class="form-control" id="email" name="description" placeholder="" >
            </div>
        </div>
    </div>
    
    <br/><br/>
    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-3">
            <button  type="submit" class="btn btn-default">Créer la ruche</button>
        </div>
    </div>
</form> 
</div>

  
<?php require '../../corpsPages/footer.php'; ?>
