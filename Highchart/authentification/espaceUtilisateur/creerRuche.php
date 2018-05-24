<?php 
require_once 'functions.php';
securisation();
require '../../corpsPages/header.php'; 

//script
if(!empty($_POST)){
     $message = array();
     require_once '../connexionBDD.php'; // Connexion à la bdd 
     $user_id = $_SESSION['auth']->idapiculteurs;
     
    
  
   
   if(empty($_SESSION['flash']['ville'])){ //Si aucune erreur sur le formulaire alors injection des informations dans la BDD
    
        
        $req = $bdd->prepare("INSERT INTO ruches SET ville = ?, longitude = ?, latitude = ?, seuilPoids = ?, seuilTempBasse = ?, seuilTempHaute = ?, descriptionRuche = ?, apiculteurs_idapiculteurs = $user_id");
        
        $req->execute([$_POST['ville'], $_POST['longitude'], $_POST['latitude'], $_POST['poidsMin'], $_POST['tempMin'], $_POST['tempMax'], $_POST['description']]);
            
            
             $_SESSION['flash']['ruche'] = "La ruche à été crée.";
     
    }
 
}
?>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script> 


 <script type="text/javascript">                                    // -------------------JAVASCRIPT------------------//
   
		// quelques variables globales  
  		var map,geocoder,marker;  
		var adresse	; 
		var previsions=5	;
		var latlng	;
		
		$(function()	
		{
                        geocoder = new google.maps.Geocoder() ;   // un ddécodeur d'adresse
	  	       $("#adresse").click(function()
	   	   	{   
	               	adresse     = $('#adresse').val()   ;              
	                geocoder.geocode({'address':adresse},Analyse);// décodage de l'adresse           
	  	          
	  	    });
			
		});        

		

        function Analyse(results, status) 
        {
		
             /* Si l'adresse a pu être géolocalisé */
             if (status == google.maps.GeocoderStatus.OK) 
             {
			 	 	latlng = results[0].geometry.location;
                   /* Récuperation de sa latitude et de sa longitude */
                   $("#lat").val(latlng.lat());
                   $("#lng").val(latlng.lng());
                   var myOptions = 
                   {
                         zoom : 12,
                         center : results[0].geometry.location,
                         mapTypeId : google.maps.MapTypeId.ROADMAP
                   };
             		/* Affichage de la carte centrale sur cette position géographique */
                   map = new google.maps.Map($('#mappy')[0],myOptions);
				   
				   // Création d'un marker et positionnement sur la carte  
                   marker = new google.maps.Marker({  
                      position: latlng	,  
                      map: map , // ou encore : marker.setmap(map) un peu plus loin
                      title: "latitude : "+latlng.lat()+" longitude : "+latlng.lng()
                    });
					  
					google.maps.event.addListener(map,'click',function(event)
					{
						var latlng = event.latLng;
						geocoder.geocode({'latLng':latlng},function(results, status){
								$('#adresse').val(results[0].formatted_address);
								marker.setMap(null)	;
								marker = new google.maps.Marker({  
                      			position: latlng	,  
                      			map: map , // ou encore : marker.setmap(map) un peu plus loin
                      			title: "latitude : "+latlng.lat()+" longitude : "+latlng.lng()
                    			});	
						});
					
					
                                        
                                        
                                        
                                        
                                        
                                document.getElementById("longitude").value =  latlng.lng().toFixed(2) ;            
                                document.getElementById("latitude").value =  latlng.lat().toFixed(2) ;                       
                                        
                                        
					});
             }
             else 
                alert("Le gÃ©ocodage n\'a pu Ãªtre effectuÃ© car: " + status);
        }

//affichage tableau données

		
		   
        </script>
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
        <div class="col-md-offset-4 col-md-4">
            <div class="form-group">
            <label for="ville">Ville:</label>
            <input type="text" class="form-control" id="adresse" name="ville" value="Le Mans"   >
            </div>
        </div>
        
    </div>
    <div class="row">
	        	 <div class="col-md-offset-2 col-md-8 text-center">
                             <h6>[ Veuillez cliquer sur l'endroit où se situe la ruche ]</h6>
			  			<div id="mappy" style="height: 200px"></div>
				</div>
                        </div>	
 <br>
    <div class="row">
         <div class="col-md-offset-3 col-md-2">
            <div class="form-group">
            <label for="longitude">Longitude (°)</label>
            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="" required>
            </div>
        </div>
        
        <div class="col-md-offset-0 col-md-2">
            <div class="form-group">
            <label for="latitude">Latitude (°)</label>
            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="" required>
            </div>
        </div>
     </div>

<br>
    <div class="row">
         <div class="col-md-offset-3 col-md-2">
            <div class="form-group">
            <label for="longitude">Poids min. (Kg)</label>
            <input type="text" class="form-control" id="longitude" name="poidsMin" placeholder="" required>
            </div>
        </div>
        
        <div class="col-md-offset-0 col-md-2">
            <div class="form-group">
            <label for="latitude">Température min. (°C)</label>
            <input type="text" class="form-control" id="latitude" name="tempMin" placeholder="" required>
            </div>
        </div>
   

     <div class="col-md-offset-0 col-md-2">
            <div class="form-group">
            <label for="latitude">Température max. (°C)</label>
            <input type="text" class="form-control" id="latitude" name="tempMax" placeholder="" required>
            </div>
        </div>
     </div>
<br>
<div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="form-group">
            <label for="description">Description ( Facultatif )</label>
            <input type="text" class="form-control" id="email" name="description" placeholder="" required>
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
