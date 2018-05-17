<?php 
require_once 'functions.php';
securisation();

if(!empty($_POST)){
     require_once '../connexionBDD.php'; // Connexion à la bdd 
     $user_id = $_SESSION['auth']->idapiculteurs;
     

    //nom
     if (empty($_POST['nom'])){}
     
     if (!empty($_POST['nom']) && !preg_match('/^[a-zA-Z]+$/',$_POST['nom'])){
        $_SESSION['flash']['nom']= "Le champ 'Nom' est incorrect, seul les lettres sont autorisés !";
    } 
     if(!empty($_POST['nom']) && empty($_SESSION['flash']['nom'])){
        $nom =($_POST['nom']);
        $bdd->prepare('UPDATE apiculteurs SET nom = ? WHERE idapiculteurs = ?')->execute([$nom, $user_id]);
            $_SESSION['flash']['success1'] = "Le nom à été changé.";   
        } 
        
   
    //prenom    
        if (empty($_POST['prenom'])){}
        if (!empty($_POST['prenom']) && !preg_match('/^[a-zA-Z]+$/',$_POST['prenom'])){
        $_SESSION['flash']['prenom']= "Le champ 'Prénom' est incorrect, seul les lettres sont autorisés !";
        }
     if(!empty($_POST['prenom']) && empty($_SESSION['flash']['prenom'])){
        $prenom =($_POST['prenom']);
        $bdd->prepare('UPDATE apiculteurs SET prenom = ? WHERE idapiculteurs = ?')->execute([$prenom, $user_id]);
            $_SESSION['flash']['success2'] = "Le prénom à été changé.";   
        } 
        
  
    //email    
         if (empty($_POST['email'])){}
        //Verifie si l'email saisis n'est pas déjà associé à un compte.
            $req = $bdd->prepare('SELECT idapiculteurs FROM apiculteurs WHERE email = ?');
            $req->execute([$_POST['email']]);
            $user = $req->fetch();
            if($user){
                $_SESSION['flash']['email'] = "Cet email est déjà utilisé pour un autre compte.";
            }
            
    if(!empty($_POST['email']) && empty($_SESSION['flash']['email'])){
        $email =($_POST['email']);
        $bdd->prepare('UPDATE apiculteurs SET email = ? WHERE idapiculteurs = ?')->execute([$email, $user_id]);
            $_SESSION['flash']['succcess3'] = "L'email à été changé.";   
        } 
           
        
    //nom d'utilisateur    
        if (empty($_POST['username'])){}
        if (!empty($_POST['username']) && !preg_match('/^[a-zA-Z0-9_]+$/',$_POST['username'])){
        
        $_SESSION['flash']['username']= "Le champ 'Nom d'utilisateur' est incorrect, seul les caractères alphanumériques sont autorisés !";
    } else {
            //Verifie si le nom d'utilisateur n'as pas été déjà pris par quelqu'un d'autre.
            $req = $bdd->prepare('SELECT idapiculteurs FROM apiculteurs WHERE login = ?');
            $req->execute([$_POST['username']]);
            $user = $req->fetch();
            if($user){
                $_SESSION['flash']['username'] = "Ce nom d'utilisateur est déjà pris.";
            }
    } 
        
     if(!empty($_POST['username']) && empty($_SESSION['flash']['username'])){
        $username =($_POST['username']);
        $bdd->prepare('UPDATE apiculteurs SET login = ? WHERE idapiculteurs = ?')->execute([$username, $user_id]);
            $_SESSION['flash']['success4'] = "Le nom d'utilisateur à été changé.";   
        } 
        
        
       
    //telephone    
                if (empty($_POST['telephone'])){}

        
        if (!empty($_POST['telephone']) && !preg_match('~^[0-9]{0,10}$~',$_POST['telephone'])){
        
        $_SESSION['flash']['telephone']= "Le champ 'Téléphone' est incorrect.";
    }
    if(!empty($_POST['telephone']) && empty($_SESSION['flash']['telephone'])){
        $telephone =($_POST['telephone']);
        $bdd->prepare('UPDATE apiculteurs SET telephone = ? WHERE idapiculteurs = ?')->execute([$telephone, $user_id]);
            $_SESSION['flash']['success5'] = "Le téléphone à été changé.";   
        } 
    

    //mot de passe    
               
    if($_POST['password'] != $_POST['password_confirm']){
        $_SESSION['flash']['error1'] = "Les mots de passes ne correspondent pas.";
    }
    if(empty($_POST['password'])){
       
    }else{
        $user_id = $_SESSION['auth']->idapiculteurs;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  
    $bdd->prepare('UPDATE apiculteurs SET mdp = ? WHERE idapiculteurs = ?')->execute([$password, $user_id]);
            $_SESSION['flash']['success'] = "Le mot de passe à été changé.";

    }
    if(!empty($_SESSION['flash'])){
    $_SESSION['flash']['info'] = "Veuillez vous reconnecter pour que vos informations soient mis à jour.";
    
    }
}








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

<!-------------------------------------------------- INFOS PERSONELLES ---------------------------------------------------------->
   <center><h3><small>Consulter et/ou modifier vos informations.</small></h3></center>
<div class="contenu text-left"> 
    <form class="form-horizontal" action=""  method="POST"><!-- action="./authentification/postInscription.php" -->
    <br/>
    <div class="row">
        <div class="col-md-offset-3 col-md-3">
            <div class="form-group">
            <label for="Nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="<?= $_SESSION['auth']->nom ?>" >
            </div>
        </div>
        
        <div class="col-md-offset-1 col-md-3">
            <div class="form-group">
            <label for="Prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="<?= $_SESSION['auth']->prenom ?>" >
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-3 col-md-7">
            <div class="form-group">
            <label for="Email">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="<?= $_SESSION['auth']->email ?>" >
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-offset-3 col-md-3">
            <div class="form-group">
            <label for="user">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="user" name="username" placeholder="<?= $_SESSION['auth']->login ?>" >
            </div>
        </div>

        <div class="col-md-offset-1 col-md-3">
            <div class="form-group">
            <label for="Password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="" >
            </div>
        </div>
        
    </div>
    
    <div class="row">
        <div class="col-md-offset-3 col-md-3">
           <label for="telephone">Téléphone</label>
           <div class="input-group">
            <span class="input-group-addon glyphicon glyphicon-earphone"></span>
            <input type="telephone" class="form-control" name="telephone" placeholder="<?= $_SESSION['auth']->telephone ?>" aria-describedby="basic-addon1" >
           </div>
        </div>
        
        <div class="col-md-offset-1 col-md-3">
            <div class="form-group">
            <label for="Password">Confirmation du mot de passe</label>
            <input type="password" class="form-control" id="password" name="password_confirm" placeholder="" >
            </div>
        </div>
    </div>
    <br/><br/>
    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-3">
            <button  type="submit" class="btn btn-default">Modifier mes informations</button>
        </div>
    </div>
</form> 
</div>


<!-------------------------------------------------- INFOS PERSONELLES ---------------------------------------------------------->

<?php require '../../corpsPages/footer.php'; ?>


