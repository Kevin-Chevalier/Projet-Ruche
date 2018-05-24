<!----------------------------------------------------------------------------------
    @fichier  connexion.php							    							|
    @auteur   Algin TOSHI (Touchard Washington le Mans)								|
    @date     Avril 2018															|
    @version  v1.0 - First release													|
    @details  Page de recuperation du mot de passe										     		|
 																				    |
------------------------------------------------------------------------------------>

<?php require 'corpsPages/header.php'; ?>

        <h1>Réinitialiser votre mot de passe <br/><br/><small><h4> Saisissez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe. </h4></small></h1>
        <br><br>
            
<div class="contenu text-left"> 
            
    <form class="form-horizontal" action="./authentification/auth.php" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-5" for="usr">Adresse e-mail :</label>
                <div class="col-sm-3">
                <input name="mailRecup" type="text" class="form-control" id="mail" placeholder="Entrez votre adresse e-mail" required>
            </div>
        </div>
    <br/>
        <div class="form-group">
                <div class="col-sm-offset-5 col-sm-3">
                <button name="bouton1"type="submit" class="btn btn-default">Envoyer</button>
            </div>
        </div>
  
    </form> 
         
</div>
<?php require 'corpsPages/footer.php'; ?>

