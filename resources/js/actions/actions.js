export const ADDRESS_CHANGED = 'ADDRESS_CHANGED';
export const UPDATE_ADDRESS_RESULTS = 'UPDATE_ADDRESS_RESULTS';
export const ADDRESS_SELECTED = 'ADDRESS_SELECTED';
export const UPDATE_QUERY_RESULTS = 'UPDATE_QUERY_RESULTS';
export const OPTION_CHANGED = 'OPTION_CHANGED';
export const CHECKBOX_SELECTED = 'CHECKBOX_SELECTED';

export function addressChanged(newAddress){
  return{ type: ADDRESS_CHANGED, address: newAddress};
}

export function updateAddressResults(newAddressResults){
  return{ type: UPDATE_ADDRESS_RESULTS, addressResults: newAddressResults};
}

export function addressSelected(newAddress, newAddressResults){
  return{ type: ADDRESS_SELECTED, address: newAddress, addressResults: newAddressResults};
}

export function updateQueryResults(newQueryResults){
  return{ type: UPDATE_QUERY_RESULTS, queryResults: newQueryResults};
}

export function optionChanged(updatedRooms, updatedBedrooms, updatedRadius){
  return{ type: OPTION_CHANGED, rooms: updatedRooms, bedrooms: updatedBedrooms, radius: updatedRadius};
}

export function checkboxSelected(queryServicesArray){
  return{ type: CHECKBOX_SELECTED, services: queryServicesArray};
}
