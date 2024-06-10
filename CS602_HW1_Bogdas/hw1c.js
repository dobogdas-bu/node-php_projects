const colors = require('colors');
const log = console.log
const ZipCodeEmitter = require('./zipCodeEmitter').ZipCodeEmitter;

const cities = new ZipCodeEmitter();

cities.on('lookupByZipCode',(result)=>{
    log('Event LookupByZipCode raised.')
    log(result)
})

cities.on('getPopulationByState',(result)=>{
    log('Event getPopulationByState raised.')
    log(result)
})

cities.on('lookupByCityState',(result, city, state)=>{
    log('Event lookupByCityState raised (Handler 1).')
    log({"city": city, "state": state, "data": result})
})

cities.on('lookupByCityState',(result, city, state)=>{
    log('Event lookupByCityState raised (Handler 2).')
    log(`City: ${city}, State: ${state}`)
    log(result)
})

cities.lookupByZipCode('44145')
cities.lookupByCityState('BOSTON','MA')
cities.getPopulationByState('MA')

