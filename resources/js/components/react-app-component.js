import React, { Component } from 'react';
import AdvancedSearch from '../components/react-advanced-search-component';
import Apartments from '../components/react-apartment-component';
import FunctionalComponent from '../components/react-functional-component';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import store from '../reducers/store';

export default class App extends Component {
  constructor(props) {
    super(props);

    this.state={
      searchedAddress:"",
      results:[],
      updateResults:false
    }

    this.updateResults=this.updateResults.bind(this);
  }

  updateResults(resultsArray){
    this.setState({results:resultsArray,updateResults:true});
  }

  render() {
    return (
      <Provider store={store}>
        <FunctionalComponent />
        <AdvancedSearch address={this.props.address} updateAddress={this.updateSearchedAddress} updateResults={this.updateResults}/>
        <h1>Risultati ricerca:</h1>
        <Apartments results={this.state.results} updateResults={this.state.updateResults} sponsoreds={false} lat={this.props.lat} lon={this.props.lon} advancedSearch={true}/>
      </Provider>
    )
  }
}

if (document.getElementById('app')) {
  const el = document.getElementById('app')
  const props = Object.assign({}, el.dataset)
  ReactDOM.render(<App {...props}/>, document.getElementById('app'));
}
