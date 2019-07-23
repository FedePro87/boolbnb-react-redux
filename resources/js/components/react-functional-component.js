import React, { Component } from 'react';
import AdvancedSearch from '../components/react-advanced-search-component';
import Apartments from '../components/react-apartment-component';
import ReactDOM from 'react-dom';
import { Provider,connect } from 'react-redux';
import store from '../reducers/store';
import { addressChanged, updateAddressResults, updateQueryResults } from '../actions/actions';

export default class FunctionalComponent extends Component {
  constructor(props) {
    super(props);

    store.subscribe(() => {
      if (store.getState().updateNow) {
        if (store.getState().addressSelected) {
          this.search(true);
        } else if(!store.getState().addressSelected){
          this.search();
        }
      }
    });
  }

  search(addressesSelected,advancedData){
    let currentStore= store.getState();
    let self= this;
    let query=currentStore.addressSearched;
    var numberOfRooms = currentStore.rooms;
    var bedrooms = currentStore.bedrooms;
    var radius = currentStore.radius;
    var services = currentStore.services;

    const outData = {
      access_token:"pk.eyJ1IjoiYm9vbGVhbmdydXBwbzQiLCJhIjoiY2p4YnN5N3ltMDdkbjNzcGVsdW54eXFodCJ9.BP8Cf-t-evfHO22_kDFzbg",
      types:"place,address",
      autocomplete:true,
      limit:6
    };

    $.ajax({
      url:'https://api.mapbox.com' + '/geocoding/v5/mapbox.places/' + query +'.json',
      method:"GET",
      data:outData,
      success:function(inData,state){
        let resultsArray = inData['features'];
        let addressArray=[];

        // Crea i risultati di ricerca in tempo reale.
        for (let i = 0; i < resultsArray.length; i=i+1) {
          let resultAddress=resultsArray[i]['place_name'];
          addressArray.push(resultAddress);
        }

        //Popola di nuovo i risultati soltanto se sto digitando un indirizzo. Non lo fa in tutti gli altri casi(indirizzo selezionato)
        if (!addressesSelected) {
          store.dispatch(updateAddressResults(addressArray));
        }

        let myQuery = resultsArray[0];
        let myCoordinates = myQuery['center'];
        let lat = myCoordinates[1];
        let lon = myCoordinates[0];
        self.setState({latComp:lat,lonComp:lon});

        // Se è nella pagina iniziale, ha già cercato l'indirizzo quindi può tranquillamente finire qui.
        if (self.props.home) {
          return true;
        }

        self.apartmentsDatabaseSearch(lat,lon,numberOfRooms,bedrooms,radius,services);
      },
      error:function(request, state, error){
        console.log(request);
        console.log(state);
        console.log(error);
      }
    });
  }

  apartmentsDatabaseSearch(lat,lon,rooms,bedrooms,radius,services){
    let self=this;
    $.ajax({
      url:"/search",
      method:"GET",
      data:{
        lat:lat,
        lon:lon,
        number_of_rooms: rooms,
        bedrooms: bedrooms,
        radius: radius,
        services:services,
        advancedSearch:true,
      },
      success:function(inData,state){
        let resultsArray = JSON.parse(inData);
        store.dispatch(updateQueryResults(resultsArray));
      },
      error:function(request, state, error){
        console.log(request);
        console.log(state);
        console.log(error);
      }
    });
  }

  render() {
    return null;
  }
}
