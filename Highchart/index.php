<!----------------------------------------------------------------------------------
    @fichier  index.php								
    @auteur   Algin TOSHI (Touchard Washington le Mans)				
    @date     Avril 2018							
    @version  v1.0 - First release						
    @details  Page d'accueil de presentation de la ruche connectée		
 										
------------------------------------------------------------------------------------

@@@@@@@   @@@@@@   @@@  @@@   @@@@@@@  @@@  @@@   @@@@@@   @@@@@@@   @@@@@@@      @@@  @@@  @@@   @@@@@@    @@@@@@   @@@  @@@  @@@  @@@  @@@   @@@@@@@@  @@@@@@@   @@@@@@   @@@  @@@
@@@@@@@  @@@@@@@@  @@@  @@@  @@@@@@@@  @@@  @@@  @@@@@@@@  @@@@@@@@  @@@@@@@@     @@@  @@@  @@@  @@@@@@@@  @@@@@@@   @@@  @@@  @@@  @@@@ @@@  @@@@@@@@@  @@@@@@@  @@@@@@@@  @@@@ @@@
  @@!    @@!  @@@  @@!  @@@  !@@       @@!  @@@  @@!  @@@  @@!  @@@  @@!  @@@     @@!  @@!  @@!  @@!  @@@  !@@       @@!  @@@  @@!  @@!@!@@@  !@@          @@!    @@!  @@@  @@!@!@@@
  !@!    !@!  @!@  !@!  @!@  !@!       !@!  @!@  !@!  @!@  !@!  @!@  !@!  @!@     !@!  !@!  !@!  !@!  @!@  !@!       !@!  @!@  !@!  !@!!@!@!  !@!          !@!    !@!  @!@  !@!!@!@!
  @!!    @!@  !@!  @!@  !@!  !@!       @!@!@!@!  @!@!@!@!  @!@!!@!   @!@  !@!     @!!  !!@  @!@  @!@!@!@!  !!@@!!    @!@!@!@!  !!@  @!@ !!@!  !@! @!@!@    @!!    @!@  !@!  @!@ !!@!
  !!!    !@!  !!!  !@!  !!!  !!!       !!!@!!!!  !!!@!!!!  !!@!@!    !@!  !!!     !@!  !!!  !@!  !!!@!!!!   !!@!!!   !!!@!!!!  !!!  !@!  !!!  !!! !!@!!    !!!    !@!  !!!  !@!  !!!
  !!:    !!:  !!!  !!:  !!!  :!!       !!:  !!!  !!:  !!!  !!: :!!   !!:  !!!     !!:  !!:  !!:  !!:  !!!       !:!  !!:  !!!  !!:  !!:  !!!  :!!   !!:    !!:    !!:  !!!  !!:  !!!
  :!:    :!:  !:!  :!:  !:!  :!:       :!:  !:!  :!:  !:!  :!:  !:!  :!:  !:!     :!:  :!:  :!:  :!:  !:!      !:!   :!:  !:!  :!:  :!:  !:!  :!:   !::    :!:    :!:  !:!  :!:  !:!
   ::    ::::: ::  ::::: ::   ::: :::  ::   :::  ::   :::  ::   :::   :::: ::      :::: :: :::   ::   :::  :::: ::   ::   :::   ::   ::   ::   ::: ::::     ::    ::::: ::   ::   ::
   :      : :  :    : :  :    :: :: :   :   : :   :   : :   :   : :  :: :  :        :: :  : :     :   : :  :: : :     :   : :  :    ::    :    :: :: :      :      : :  :   ::    : 
-->                                                                                                                                                                                                                                                                      


<?php require 'corpsPages/header.php'; ?> 
    
    <h1>Présentation du système</h1><br><br>
	
	<div class="contenu text-left"> 
            
        <h4>La ruche connectée est un outil de suivi en temps réel de colonies d’abeilles.
            Elle consiste à équiper la ruche d’abeilles en y ajoutant des capteurs pour permettre 
            d’obtenir différentes informations tel que la température intérieure, l’humidité le poids et le comptage des abeilles.
            Le système est architecturée autour de deux systèmes :
            <br>Un système à côté de la ruche composée d’une raspberry pi avec ses capteurs, sa caméra et son alimentation autonome.
            <br>Un système serveur Web, base de données sous linux debian avec un modem GSM . Ce système est nommé Data Aggregator<br>
        </h4><br>
					<center> <img src="image/synoptique.png" alt=""/></center>
	</div>
	
<?php require 'corpsPages/footer.php'; ?>




