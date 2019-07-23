require('./bootstrap');
import React, { Component } from 'react';

var Chart = require('chart.js');

function addAppComponent(){
  require ('./components/react-app-component');
}

function addHomeComponent(){
  require ('./components/react-home-component');
}

function addApartmentsComponent() {
  require('./components/react-apartment-component')
}

function addMap() {
  // Qui viene impostata una variabile che rappresenta un array. Rispettivamente ci sono la latitudine e la longitudine. Questi dati possono essere recuperati passando nell'url della show la query o in alternativa nascondendo i dati che ci servono da qualche parte e recuperandoli con jquery.
  var lat=$('#map').data('lat');
  var lng=$('#map').data('lng');
  var myCoordinates = [lat,lng];
  // Questo non è obbligatorio.
  tomtom.setProductInfo('boolbnb', '1.0');
  // Instanzio la variabile map che corrisponde alla mappa che verrà visualizzata. Da notare la chiave center a cui viene dato il valore che corrisponde alle nostre coordinate.
  // Non è localizzata
  var map= tomtom.L.map('map', {
    key: 'xrIKVZTiqc6NhEvGHRbxYYpsyoLoR2wD',
    source: 'vector',
    basePath: '/tomtom-sdk',
    center: myCoordinates,
    zoom: 16,
    language: "it-IT"
  });
  // Qui inserisco anche un marker che viene posizionato esattamente sull'abitazione.
  var marker = tomtom.L.marker(myCoordinates).addTo(map);
  marker.bindPopup('Appartamento').openPopup();
}

function addStatsCharts(ctx,chartLabel) {
  var stats = ctx.data('stats');
  var monthsLabels = ctx.data('months');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: monthsLabels,
      datasets: [{
        label: chartLabel,
        data: stats,
        backgroundColor: ' #FF5A5F',
        borderColor: ' #FF5A5F',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      responsive: false,
      maintainAspectRatio: false
    }
  });
}

function init() {
  $('.alert').fadeOut(10000);
  //Se è presente il wrapper della mappa, raccoglie i dati per popolarlo.
  if ($('#map').length){
    addMap();
  }

  //Se verranno aggiunte le statistiche, carica i dati per popolarle.
  if ($('#visualsChart').length && $('#messagesChart').length){
    addStatsCharts($('#visualsChart'),'Visuals');
    addStatsCharts($('#messagesChart'),'Messages');
  }

  if (document.getElementById('app')) {
    addAppComponent();
  }

  if (document.getElementById('home')) {
    addHomeComponent();
  }

  if (document.getElementById('apartments-component-wrapper')) {
    addApartmentsComponent();
  }

  //Fa in modo che la navbar vari tra invisibile e visibile nella home.
  $(function(e) {
    $(window).scroll(function(e) {
      if ($(".navbar").offset().top>=600) {
        $('.navbar').addClass('original-header');
      }
      if ($(".navbar").offset().top<=600) {
        $('.navbar').removeClass('original-header');
      }
    });
  });

  //Specifica cosa avviene quando viene cliccato l'indirizzo mail all'interno della lista dei messaggi.
  $('.emailLink').on('click', function (event) {
    event.preventDefault();
    url = 'mailto:' + $(this).data('mail') + '?subject=Risposta al messaggio su BoolBnB per appartamento ' + "'" + $(this).data('title') + "'";
    var win = window.open(url, '_blank');
    win.focus();
  });
}

$(document).ready(init);
