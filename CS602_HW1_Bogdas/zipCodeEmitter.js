const EventEmitter = require('events').EventEmitter;
const data = require('./zips.json');
const log = console.log

// Custom class 
class ZipCodeEmitter  extends EventEmitter {
	
	// member functions

	lookupByZipCode(zip)  {
		log(`Look up by zipcode (${zip})`)
		const lookupByZipCode = (zip)=> data.find((loc) => loc._id === zip)
		const result = lookupByZipCode(zip)
	this.emit('lookupByZipCode',result)
	}

	lookupByCityState(city, state)  {
		log(`Lookup by city (${city}, ${state})`)
		const lookupByCityState = (city, state)=> data.filter((loc) => city === loc.city && state === loc.state)
		const result = lookupByCityState(city,state)
		this.emit('lookupByCityState', result, city, state)
	}

	getPopulationByState(state) {
		log(`Get Population by State (${state})`)
		const getPopulationByState = (state)=> data.reduce((total, loc) => {
            if (loc.state === state) {
               total += parseInt(loc.pop)
            }
            return total
        },0)
		const result = {"state": state,"pop":getPopulationByState(state)}
	this.emit('getPopulationByState', result)
	}

}

module.exports.ZipCodeEmitter = ZipCodeEmitter;

