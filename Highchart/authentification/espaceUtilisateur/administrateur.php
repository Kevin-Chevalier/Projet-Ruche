<?php 
require_once 'functions.php';
securisation();
require '../../corpsPages/header.php'; 

//script
if(!empty($_POST)){
    
    $message = array();
    require_once '../connexionBDD.php'; // Connexion à la bdd 
    
    //Verification des informations saisis sur le formulaire avant envois sur la BDD
    if (empty($_POST['nom'])|| !preg_match('/^[a-zA-Z]+$/',$_POST['nom'])){
        $message['nom']= "Le champ 'Nom' est incorrect, seul les lettres sont autorisés !";
    } 
    
    if (empty($_POST['prenom'])|| !preg_match('/^[a-zA-Z]+$/',$_POST['prenom'])){
        
        $message['prenom']= "Le champ 'Prénom' est incorrect, seul les lettres sont autorisés !";
    }
    
    if (empty($_POST['username'])|| !preg_match('/^[a-zA-Z0-9_]+$/',$_POST['username'])){
        
        $message['username']= "Le champ 'Nom d'utilisateur' est incorrect, seul les caractères alphanumériques sont autorisés !";
    } else {
            //Verifie si le nom d'utilisateur n'as pas été déjà pris par quelqu'un d'autre.
            $req = $bdd->prepare('SELECT idapiculteurs FROM apiculteurs WHERE login = ?');
            $req->execute([$_POST['username']]);
            $user = $req->fetch();
            if($user){
                $message['username'] = "Ce nom d'utilisateur est déjà pris.";
            }
    } 
            //Verifie si l'email saisis n'est pas déjà associé à un compte.
            $req = $bdd->prepare('SELECT idapiculteurs FROM apiculteurs WHERE email = ?');
            $req->execute([$_POST['email']]);
            $user = $req->fetch();
            if($user){
                $message['email'] = "Cet email est déjà utilisé pour un autre compte.";
            }
    
    
    if (empty($_POST['telephone'])|| !preg_match('~^[0-9]{0,10}$~',$_POST['telephone'])){
        
        $message['telephone']= "Le champ 'Téléphone' est incorrect.";
    }
    
    
    
    if(empty($message)){  //Si aucune erreur sur le formulaire alors injection des informations dans la BDD
    
        
        $req = $bdd->prepare("INSERT INTO apiculteurs SET nom = ?, prenom = ?, email = ? , login = ?, mdp = ?, telephone = ?, droits = 0");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $req->execute([$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['username'], $password, $_POST['telephone']]);
            
            
             $message['valide']= "Le compte à bien été créé.";
          
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
<?php if(!empty($message)): ?>
    <div class="row">
        <div class="col-md-offset-3 col-md-6 alert alert-warning text-center numColor">
            <ul>
                <?php foreach($message as $error): ?>
                <?= $error; ?><br/>
                <?php endforeach; ?>    
            </ul>
        </div>
    </div>    
<?php endif; ?>
 <center><h3><small>Créer un compte apiculteur</small></h3></center><br>

<div class="contenu text-left"> 
    
    <form class="form-horizontal" action=""  method="POST">
    <br/>
    <div class="row">
        <div class="col-md-offset-3 col-md-3">
            <div class="form-group">
            <label for="Nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" >
            </div>
        </div>
        
        <div class="col-md-offset-1 col-md-3">
            <div class="form-group">
            <label for="Prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-3 col-md-7">
            <div class="form-group">
            <label for="Email">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Adresse e-mail" required>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-offset-3 col-md-3">
            <div class="form-group">
            <label for="user">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="user" name="username" placeholder="Nom d'utilisateur" required>
            </div>
        </div>

        <div class="col-md-offset-1 col-md-3">
            <div class="form-group">
            <label for="Password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-offset-3 col-md-3">
            <div class="input-group">
            <span class="input-group-addon glyphicon glyphicon-earphone"></span>
            <input type="telephone" class="form-control" name="telephone" placeholder="Téléphone" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <br/><br/>
    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-3">
            <button  type="submit" class="btn btn-default">Créer le compte</button>
        </div>
    </div>
</form> 
</div>

  
<?php require '../../corpsPages/footer.php'; ?>
