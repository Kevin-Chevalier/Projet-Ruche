# Modem GSM

## Procédure de test

Connecter le **modem** sur la prise USB / Série

Puis ouvrir le **Terminal**

Ensuite *apt-get install minicom*

Après l'installation, lancement de minicom

			
		Si le modem est branché en serie :
			- minicom -d /dev/ttyS0
		Si le modem est branché en usb :
			- minicom -d /dev/ttyUSB0

Arrivé sur la page principale de minicom il faut activer l'echo local pour voir ce que l'on écrit :

**CTRL + A puis Z**

Ensuite l'activation de l'echo 
			- Taper '**E**'
En restant dans les options, on va vérifier les paramètres du modem
		- Taper '**O**'
		- Puis sélectionnez '**Serial port setup**'
	En ce qui nous concerne, on doit avoir '**115 200 8N1**' au niveau des '**Bps/Par/Bits**'

On définis aussi l'Hardware Flow Control et le Software flow Control sur '**NO**'
Ensuite, on peut sortir du mode de paramétrage avec "Save setup as dfl"

Une fois finis, on peut tester le modem avec la commande **AT**

La réponse doit être "**OK**"

*Exemple :*
AT                                                                           
OK 
Après avoir vérifier que le modem fonctionne, on entre le code PIN
AT+CPIN="**CODEPIN**"

La reponse doit être :**+CPIN: READY** suivi de **OK** puis **CALL READY**

*Exemple :*
AT+CPIN=0000                                                                 
+CPIN: READY                                                                 
                                                                             
OK                                                                        
                                                                          
Call Ready

Si le modem retourne ‘**+CPIN : SIM PIN**’ si le code est mauvais.
Si le modem retourne ‘**+CPIN: SIM PUK**’ si le code PUK est réclamé.

Ensuite, on va passer le Modem GSM en mode text
**AT+CMGF=1**
( AT+CMGF=0 pour le passer en mode PDU)

Une fois le modem prêt, il reste plus qu'a  envoyer un SMS
**AT+CMGS="+*NUMERODETELEPHONE*"**
 **> *Message à envoyer***
 *( **Entrée** pour le retour a la ligne et **CTRL + Z** pour envoyer le SMS )*
Le retour doit être :
**+CMGS: (XX)**

OK
*Exemple :*
**AT+CMGS="+0624505413"**
**> test**
**>** 
**+CMGS: 84**

**OK**

