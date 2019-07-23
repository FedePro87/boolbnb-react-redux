import { createStore, applyMiddleware } from 'redux';

let initialState = {
  addressSearched:'',
  addressResults:[],
  queryResults:[],
  bedrooms:0,
  rooms:0,
  radius:200,
  services:[],
  updateNow:false
}

// un reducer è una funzione che ha come attributi stato e azione. Descrive come viene modificato uno stato. Lo stato può essere di qualsiasi tipo.
function address(state = initialState, action) {
  switch (action.type) {
    case 'ADDRESS_CHANGED':
    return Object.assign({}, state, {
      addressSearched: action.address,
      addressSelected:false,
      updateNow:true
    });
    case 'UPDATE_ADDRESS_RESULTS':
    return Object.assign({}, state, {
      addressResults: action.addressResults,
      updateNow:false
    });
    case 'ADDRESS_SELECTED':
    return Object.assign({}, state, {
      addressSearched: action.address,
      addressResults: action.addressResults,
      addressSelected:true,
      updateNow:true
    });
    case 'UPDATE_QUERY_RESULTS':
    return Object.assign({}, state, {
      queryResults: action.queryResults,
      updateNow:false
    });
    case 'OPTION_CHANGED':
    return Object.assign({}, state, {
      rooms: action.rooms,
      bedrooms:action.bedrooms,
      radius:action.radius,
    });
    case 'CHECKBOX_SELECTED':
    return Object.assign({}, state, {
      services: action.services,
    });
    default:
    return state
  }
}

const apartmentsQueryMiddleware = store => next => action => {
  console.log('dispatching', action);

  let result = next(action);
  console.log('next state', store.getState());
  return result;
}

// Questo raccoglie in se tutti gli stati. Come funzioni ha subscribe, dispatch e getState
//let store = createStore(address,applyMiddleware(apartmentsQueryMiddleware));
let store = createStore(address);

export default store;
