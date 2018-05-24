<!----------------------------------------------------------------------------------
    @fichier  connexion.php							    							|
    @auteur   Algin TOSHI (Touchard Washington le Mans)								|
    @date     Avril 2018															|
  												|
    @details  Page de demande d'inscription										     		|
 																				    |
------------------------------------------------------------------------------------>
<?php require 'corpsPages/header.php'; ?>

        <h1>Inscription
        <h5> <br/><br/>Merci de renseigner vos informations, l'administrateur verifiera les informations </h5></h1>
        <br>
      
        
<div class="contenu text-left"> 
    
<form class="form-horizontal" action="./authentification/postInscription.php" method="POST">
    <br/>
    <div class="row">
        <div class="col-md-offset-3 col-md-3">
            <div class="form-group">
            <label for="Nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
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
            <input type="mail" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-offset-3 col-md-3">
            <div class="form-group">
            <label for="user">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Nom d'utilisateur" required>
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
            <input type="text" class="form-control" name="telephone" placeholder="Téléphone" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <br/><br/>
    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-3">
            <button name="boutonInscription" type="submit" class="btn btn-default">Envoyer mes informations</button>
        </div>
    </div>
</form> 
</div>


<?php require 'corpsPages/footer.php'; ?>
