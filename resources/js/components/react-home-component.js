import React, { Component } from 'react';
import FunctionalComponent from '../components/react-functional-component';
import AddressSearchComponent from './react-address-search-component';
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
        <FunctionalComponent home={true} />
        <AddressSearchComponent advancedSearch={true} address={this.props.address}/>
      </Provider>
    )
  }
}

if (document.getElementById('home')) {
  const el = document.getElementById('home')
  const props = Object.assign({}, el.dataset)
  ReactDOM.render(<App {...props}/>, document.getElementById('home'));
}
