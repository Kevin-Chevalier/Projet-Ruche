/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function ()
{
$("#dateDeDebut, #dateDeFin").datepicker({ //pour mettre les datepicker en français
        altField: "#datepicker,",
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.',
        dateFormat: 'yy-mm-dd'
    });
    });


$(document).ready(function () {
  var numeroRuche = $(".numColor").text();
//RÃ©cupÃ©ration des plans prÃ©sents sur la BDD.
$.ajax({
url: 'recuperationInformations.php',
        type: 'POST',
 data: { numeroRuche: numeroRuche },
        dataType: 'json',
        //En cas de sucÃ¨es de la requÃªte, on affiche le retour texte
        success: function (donnees, status, xhr) {
                
                var chart;
                var couleurs = ["#1f77b4"];
                var options = {};
                

                    options.chart = {
                        renderTo: 'graphique',
                        height: 600,
                        marginTop: 70,
                        marginLeft: 70,
                        marginRight: 70,
                        backgroundColor: '#F9F9F9',
                        type: 'line'
                };
                options.credits = {
                enabled: false
                };
                options.colors = couleurs;
                options.title = {
                text: " ",
                        margin: 10
                };
                options.tooltip = {
                    formatter: function () {
                        return "Date : " + this.x + "<br /> Température : " + this.y + " °c";
                    }
                };
                options.yAxis = [
                                    {
                                        title: {
                                            text: "temperature en °c" //Donne un titre à l'axe des Y
                                        },
                                        labels: {
                                            formatter: function () {
                                                return this.value; // Affiche les valeur de l'axe Y
                                            },
                                            style: {
                                                color: '#000'
                                            }
                                        }
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
                                options.series = [
                                    {
                                        name: 'temperature °c',
                                        data: []
                                    },
                ];
                $.getJSON('recuperationInformations.php', function (recuperationInformations) {
                $.each(recuperationInformations, function (index, ligne) {
                            options.series[0].data.push(ligne.temperature); //Affichage des données en Y
                            options.xAxis.categories.push(ligne.date);    //Affichage des données en X
                });
                        chart = new Highcharts.Chart(options);
                });
                $("#erreur").text("");
        },
        error: function (xhr, status, error) {
        alert("param : " + xhr.responseText);
                alert("status : " + status);
                alert("error : " + error);
        }

});
        var numeroRuche = $(".numColor").text();
        console.log(numeroRuche);
        $.ajax({
        url: 'recuperationEnvoieRuche.php',
               type: 'POST',
                data: {
                    numeroRuche: numeroRuche
                },
                dataType: 'json',
                success: function(donnees, status, xhr) {
                     $.each(donnees, function (index, ligne) {
                 $(".localisation").append("Localisation<br /><u>Longitude :</u> "+ligne.longitude+"°<br /><u>Latitude :</u> "+ligne.latitude+"°<br /><u>Altitude :</u> "+ligne.altitude + " mètres");
                 });
               
                },
                error: function(xhr, status, error) {
                alert("param : " + xhr.responseText);
                alert("status : " + status);
                alert("error : " + error);
                }
        });
});
