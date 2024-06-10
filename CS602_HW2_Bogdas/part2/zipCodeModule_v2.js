// Copy your solution from Assignment1

const data = require('./zips.json');
// returns object for given zipcode 
module.exports.lookupByZipCode = (zip) => {
    return data.find((loc) => loc._id === zip)

};

module.exports.lookupByCityState = (city, state) => {
    return { "city": city, "state": state, "data": data.filter((loc) => city === loc.city && state === loc.state) }
};


// returns object with "sate" and accumulated "pop" properties
module.exports.getPopulationByState = (state) => {
    return {
        "state": state, "pop": data.reduce((total, loc) => {
            if (loc.state === state) {
               total += parseInt(loc.pop)
            }
            return total
        },0
        )
    }
}
    



