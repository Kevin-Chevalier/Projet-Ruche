$(function ()
{
    //var numeroRuche = $(".numColor").text();
    $("#dateDeDebut, #dateDeFin").datepicker({ //pour mettre les datepicker en franÃ§ais
        altField: "#datepicker,",
        closeText: 'Fermer',
        prevText: 'PrÃ©cÃ©dent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'AoÃ»t', 'Septembre', 'Octobre', 'Novembre', 'DÃ©cembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'AoÃ»t', 'Sept.', 'Oct.', 'Nov.', 'DÃ©c.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.',
        dateFormat: 'yy-mm-dd'
    });

    var chart;
    var couleurs = ["#FF0000", "#FFFF00", "#40FF00", "#00FFFF", "#0000FF", "FF00FF", "000000"];
    var options = {};


    options.chart = {
        renderTo: 'graphique',
        height: 500,
        marginTop: 70,
        marginLeft: 100,
        marginRight: 100,
        backgroundColor: '#F9F9F9',
        type:'line'
    };

    options.credits = {
        enabled: false
    };

    options.colors = couleurs;
    options.title = {
        text: "Mesures de la ruche",
        margin: 10
    };

    //options.tooltip = {
    //    formatter: function() {
    //        return "Date : " + this.x + " Température : " + this.y + " °C" ;
    //    }
    //};
    
    options.tooltip = {
			shared: true,
			borderColor: '#4b85b7',
			backgroundColor: '#edf1c8',
			dateTimeLabelFormats:{second:"%A %e %B à %Hh%M"}
                        };

    options.yAxis = [
        { //Primary Axis
            gridLineWidth: 1,
				labels: {
					format: '{value}',
					style: {
						
					}
				},
				title: {
					text: 'Temperature',
					style: {
						
					}
				}
},
{ // Secondary yAxis
				gridLineWidth: 0,
				title: {
					text: 'Humidité',
					style: {
						
					},
				},	
				
				labels: {
					format: '{value}',
					style: {
						
					}
				},
				opposite: true

},
    ];

    options.xAxis = {
        type: 'datetime',
			startOnTick: false,
            labels: {
                overflow: 'justify'
            },
        crosshair: true
        
    };


    options.plotOptions = {
        spline: {
                lineWidth: 2,   // épaisseur de la ligne
		states: {
                    hover: {
                        lineWidth: 2  // épaisseur de la ligne quand la souris est au dessus
                    }
                }
        
        }
        ,
        series: {
            pointStart: 0
        }
    };        

    options.series = [];
    
 idRuche = $(".numColor").text();
 console.log("ruche id : " + idRuche);
     
    
$.getJSON('obtenirValeurs.php?id='+idRuche, function(valeurs) {
    console.log(valeurs);
    options.series = valeurs.series;
    options.plotOptions.series.pointStart = valeurs.pointStart;
    chart = new Highcharts.Chart(options);  
});

function affiche( json ) {               	
		console.log(json);
			
		options.series 		= json.series;
		options.title.text 	= json.title;
		options.plotOptions.spline.pointStart = Date.parse(json.to); // pointStart définit la première valeur de x ici se sera json.to.
		chart = Highcharts.chart('graphique', options );
		chart.series[4].hide(); // le courant n'est pas affichée par défaut.
		
	}
	

	
	// fonction pour lancer la requete AJAX methode GET
	function cb(debut, fin) {
		start = debut;
		end = fin;
		$('#reportrange span').html('du ' + debut.format('DD/MM/YYYY') + ' au ' + fin.format('DD/MM/YYYY'));
		$.getJSON("obtenirValeurs.php", {to: debut.format('MMMM D, YYYY'), from: fin.format('MMMM D, YYYY'), grandeur:grandeur}, affiche);
	}

	$('#reportrange').daterangepicker({
		"locale": {
			"format": "DD/MM/YYYY",
			"separator": " - ",
			"applyLabel": "Appliquer",
			"cancelLabel": "Annuler",
			"fromLabel": "de",
			"toLabel": "à",
			"customRangeLabel": "Définir l'intervalle",
			"weekLabel": "W",
			"daysOfWeek": [
				"Di",
				"Lu",
				"Ma",
				"Me",
				"Je",
				"Ve",
				"Sa"
			],
			"monthNames": [
				"Janvier",
				"Février",
				"Mars",
				"Avril",
				"Mai",
				"Juin",
				"Juillet",
				"Août",
				"Septembre",
				"Octobre",
				"Novembre",
				"Decembre"
			],
			"firstDay": 1
		},

		startDate: start,
		endDate: end,
		ranges: {
		   'Aujourd\'hui': [moment(), moment()],
		   'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		   'Derniers 7 jours': [moment().subtract(6, 'days'), moment()],
		   'Derniers 30 jours': [moment().subtract(29, 'days'), moment()],
		   'Ce mois': [moment().startOf('month'), moment().endOf('month')],
		   'Mois précédent': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		}
				
	}, cb);		

    cb(start, end);
$('input[name="daterange"]').daterangepicker();
});