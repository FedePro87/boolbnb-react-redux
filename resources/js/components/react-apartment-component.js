import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import store from '../reducers/store';

export default class Apartments extends Component {
  constructor(props) {
    super(props);

    this.state = {
      sponsoredApartments:[],
      queryApartments:[]
    }

    store.subscribe(() => {
      this.updateQueryResults();
    });

    this.updateQueryResults=this.updateQueryResults.bind(this);
  }

  updateQueryResults(){
    this.setState({queryApartments:store.getState().queryResults});
  }

  componentDidMount(){
    if (this.props.sponsoreds==="all") {
      this.getSponsoreds(false);
    } else if (this.props.sponsoreds===true) {
      this.getSponsoreds(true);
    } else {
      this.getInitResults();
    }
  }

  getSponsoreds(limitSponsoreds){
    axios.get(`/sponsoreds` , {
      params: {
        limit:limitSponsoreds
      }
    })
    .then(res => {
      this.setState({sponsoredApartments:res.data})
    })
    .catch((error) => {
      console.log(error);
    });
  }

  getInitResults(){
    axios.get(`/search`, {
      params: {
        lat:this.props.lat,
        lon:this.props.lon,
        advancedSearch:this.props.advancedSearch
      }
    })
    .then(res => {
      this.setState({queryApartments:res.data})
    })
    .catch((error) => {
    });
  }

  render() {
    let apartmentArr=-1;
    let emptyContent='';

    if (this.props.updateResults) {
      apartmentArr=this.props.results;
    } else if (this.props.sponsoreds===true || this.props.sponsoreds==="all") {
      apartmentArr=this.state.sponsoredApartments;
    } else {
      apartmentArr=this.state.queryApartments;
    }

    if (apartmentArr.length==0 && this.props.sponsoreds===true || this.props.sponsoreds==="all") {
      emptyContent= (<h1>Non ci sono appartamenti sponsorizzati!</h1>)
    } else if (apartmentArr.length==0) {
      emptyContent= (<h1>Non ci sono risultati!</h1>)
    }

    return (
      <div className="d-flex flex-wrap">
        {apartmentArr.map((value, index) => {
          return <div  key={index} className="apartment col-lg-4 p-5">
            <div className="apartment-wrapper">
              <a href={"/show/" + value.id}>
                <img src={value.image} className="img-fluid"/>
                <div className="content-apartment">
                  <p className="description">{value.description}</p>
                  <p className="address">{value.address}</p>
                  <p>{value.visuals.length} {value.visuals.length==1 ? "visualizzazione" : "visualizzazioni"} </p>
                </div>
              </a>
            </div>
          </div>
        })}
        {emptyContent}
      </div>
    );
  }
}

// if (document.getElementById('sponsoreds-wrapper')) {
//   const apartmentComponent = document.getElementById('sponsoreds-wrapper');
//   const props = Object.assign({},apartmentComponent.dataset);
//   ReactDOM.render(<ApartmentComponent {...props}/>, document.getElementById('sponsoreds-wrapper'));
// }
//
if (document.getElementById('apartments-component-wrapper')) {
  const apartmentComponent = document.getElementById('apartments-component-wrapper');
  const props = Object.assign({},apartmentComponent.dataset);
  ReactDOM.render(<Apartments {...props}/>, document.getElementById('apartments-component-wrapper'));
}
