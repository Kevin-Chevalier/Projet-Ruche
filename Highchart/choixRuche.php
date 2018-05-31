<?php require 'corpsPages/header.php'; 

    
  echo "<h1>Ruche [<a class=\"numColor\">" . $_GET['id'] . "</a>]</h1>";

?>

                     
        <br><br>

            
<div class="contenu text-left">
<div id="graphique" style="padding: 5px;"></div>

                <div id="date">
                    <input type="text"  placeholder="Date de début" id="dateDeDebut"/>
                    <input type="text"  placeholder="Date de fin" id="dateDeFin"/>
                </div>

            
<div class="localisation"></div>
         
</div>

<?php require 'corpsPages/footer.php'; ?>
