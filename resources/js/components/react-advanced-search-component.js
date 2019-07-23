import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import AddressSearchComponent from './react-address-search-component';
import store from '../reducers/store';
import { optionChanged, checkboxSelected } from '../actions/actions';

export default class AdvancedSearch extends Component {
  constructor(props) {
    super(props);

    this.state = {
      services:[],
      queryServices:[],
      number_of_rooms:0,
      bedrooms:0,
      radius:200,
      updateNow:false
    };

    this.buildServices=this.buildServices.bind(this);
    this.optionSelected=this.optionSelected.bind(this);
    this.checkboxSelected=this.checkboxSelected.bind(this);

    this.buildServices();
  }

  buildOptions(){
    let arr = [];

    for (let i = 0; i <= 10; i=i+1) {
      if (i==0) {
        arr.push(<option key={i} value={i}>*</option>)
      } else {
        arr.push(<option key={i} value={i}>{i}</option>)
      }
    }

    return arr;
  }

  buildRadius(){
    let arr = [];

    for (let i = 1; i <= 5; i=i+1) {
      arr.push(<option key={i} value={i*200}>{i*200}</option>)
    }

    return arr;
  }

  buildServices() {
    let services=-1;

    axios.get(`/services`)
    .then(res => {
      this.setState({services:res.data});
    })
    .catch((error) => {
      console.log(error);
    });

  }

  optionSelected(e) {
    switch (e.target.name) {
      case 'number_of_rooms':
      this.setState({number_of_rooms:e.target.value,updateNow:true},function(){this.updateOptions();});
      break;
      case 'bedrooms':
      this.setState({bedrooms:e.target.value,updateNow:true},function(){this.updateOptions();});
      break;
      case 'radius':
      this.setState({radius:e.target.value,updateNow:true},function(){this.updateOptions();});
      break;
    }
  }

  updateOptions(){
    store.dispatch(optionChanged(this.state.number_of_rooms,this.state.bedrooms,this.state.radius));
  }

  checkboxSelected(e){
    let tempArray=this.state.queryServices;

    if (e.target.checked) {
      tempArray.push(e.target.defaultValue);
    } else {
      for( let i = 0; i < tempArray.length; i=i+1){
        if (tempArray[i]===e.target.defaultValue) {
          tempArray.splice(i, 1);
        }
      }
    }

    store.dispatch(checkboxSelected(tempArray));
  }

  render() {
    return (
      <div className="search-wrapper">
        <AddressSearchComponent home={false} number_of_rooms={this.state.number_of_rooms} bedrooms={this.state.bedrooms} radius={this.state.radius} queryServices={this.state.queryServices} advancedSearch={true} address={this.props.address}/>

        <div className="address-search-wrapper search-bar row">
          <div className="col-lg-2 p-3 m-4">
            <label htmlFor="number_of_rooms"><h2>Rooms</h2></label>
            <select onChange={this.optionSelected} name="number_of_rooms">
              {this.buildOptions()}
            </select><br/>
          </div>

          <div className="col-lg-2 p-3 m-4">
            <label htmlFor="bedrooms"><h2>Bedrooms</h2></label>
            <select onChange={this.optionSelected} name="bedrooms">
              {this.buildOptions()}
            </select><br/>
          </div>

          <div className="col-lg-2 p-3 m-4">
            <label htmlFor="radius"><h2>Distanza</h2></label>
            <select onChange={this.optionSelected} name="radius">
              {this.buildRadius()}
            </select><br/>
          </div>
        </div>

        <div className="col-lg-6 service-wrapper">
          <label className="title" htmlFor="service">Services</label><br/>
          <div className="d-flex justify-content-around service-box">
            {this.state.services.map((value, index) => {
              return <label key={index}><input className="text-center" onChange={this.checkboxSelected} type="checkbox" name="services[]" value={value.id}/>
                {value.name}</label>
            })}
          </div>
        </div>
      </div>
    );
  }
}
