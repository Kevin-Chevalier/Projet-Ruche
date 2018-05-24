$(function ()
{
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

    options.tooltip = {
        formatter: function() {
            return "Date : " + this.x + " Température : " + this.y + " °C" ;
        }
    };

    options.yAxis = [
        {
            title : {
                text: "Temperature"
            },
            labels: {
                formatter: function() {
                return this.value;
                },

                style: {
                    color: '#000'
                }
            }
        },

        {
            title: {
                text: "Valeurs2"
            },
            labels: {
                formatter: function() {
                    return this.value;
                },

                style: {
                    color: '#8C564B'
                }
            },
            opposite: true
        }
    ];

    options.xAxis = {
        categories: [],
        crosshair: true,
        labels: {
            rotation: -45,
            y: 20
        }
    };


    options.plotOptions = {
        series: {
            pointStart: 0
        }
    };        

    options.series = [];
    
    
     
    
$.getJSON('obtenirValeurs.php', function(valeurs) {
    console.log(valeurs);
    options.series = valeurs.series;
    options.plotOptions.series.pointStart = valeurs.pointStart;
    chart = new Highcharts.Chart(options);  
});

});