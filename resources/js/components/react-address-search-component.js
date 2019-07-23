import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import store from '../reducers/store';
import { addressChanged, addressSelected } from '../actions/actions';

export default class AddressSearchComponent extends Component {
  constructor(props) {
    super(props);

    let address="";

    if (this.props.address!=null) {
      address=this.props.address;
    }

    if (address=="") {
      address="Roma - RM";
    }

    this.state = {
      realTimeAddress: address,
      addressResults:[],
      addressesSelected:false,
      latComp:'',
      lonComp:'',
      showClose:false
    }

    this.addressFocus=this.addressFocus.bind(this);
    this.closeButtonClicked=this.closeButtonClicked.bind(this);
    this.addressSelected=this.addressSelected.bind(this);
    this.handleOutsideClick=this.handleOutsideClick.bind(this);
    this.addressChanged=this.addressChanged.bind(this);

    store.subscribe(() => {
      this.updateAddressResults();
    });
  }

  componentDidMount(){
    store.dispatch(addressSelected(this.state.realTimeAddress,[]));
    document.addEventListener('click', this.handleOutsideClick);
  }

  updateAddressResults(){
    this.setState({addressResults:store.getState().addressResults},function(){this.forceUpdate()});
  }

  handleOutsideClick(e){
    e.stopPropagation();
    //FIXME La classe esclusa è troppo scriptata.
    if (e.target.className!=="address-search-spa" && e.target.className!=="fas fa-times" && e.target.className!=="query-selector-spa") {
      this.setState({addressResults:[],showClose:false});
      store.dispatch(addressSelected(this.state.realTimeAddress,[]));
    }
  }

  closeButtonClicked(){
    this.setState({realTimeAddress: "",showClose:false});
  }

  addressSelected(e){
    e.persist();
    let selectedAddress=$(e.target).text();
    this.setState({realTimeAddress:selectedAddress,results:[],addressesSelected:true,showClose:false},function(){
      store.dispatch(addressSelected(selectedAddress,[]));
    });
  }

  addressFocus(e){
    e.persist();

    this.setState({addressesSelected:false,showClose:true},function () {
      store.dispatch(addressChanged(e.target.value));
    });
  }

  addressChanged(e){
    var queryIsEmpty;

    if (e.target.value!="") {
      queryIsEmpty=true;
    } else {
      queryIsEmpty=false;
    }

    store.dispatch(addressChanged(e.target.value));

    this.setState({realTimeAddress:e.target.value,addressesSelected:false,showClose:queryIsEmpty});
  }

  render() {
    return (
      <div className="form-group address-search-wrapper search-bar">
        <input type="hidden" name="lat" value={this.state.latComp}/>
        <input type="hidden" name="lon" value={this.state.lonComp}/>
        <div className="close-results-wrapper">
          <input onFocus={this.addressFocus} name="address" onChange={this.addressChanged} value={this.state.realTimeAddress} className="address-search-spa" type="text" placeholder="Insert address..."/><i className={this.state.showClose ? 'fas fa-times' : ''} onClick={this.closeButtonClicked}></i>
        </div>
        <div className="query-results">
          {this.state.addressResults.map((value, index) => {
            return <div className="query-selector-spa" onClick={this.addressSelected} key={index}>{value}</div>
          })}
        </div>
      </div>
    );
  }
}

if (document.getElementById('address-search-component-wrapper')) {
  const addressSearchComponent = document.getElementById('address-search-component-wrapper');
  const props = Object.assign({},addressSearchComponent.dataset);
  ReactDOM.render(<AddressSearchComponent {...props}/>, document.getElementById('address-search-component-wrapper'));
}
