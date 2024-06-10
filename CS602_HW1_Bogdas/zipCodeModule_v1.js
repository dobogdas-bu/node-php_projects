const data = require('./zips.json');

module.exports.lookupByZipCode =  (zip) => {
		// get data where zip matches object in zips.json
        for(let i = 0; i < data.length; i++){
            let loc = data[i]      

            if(parseInt(zip) === parseInt(loc._id)){

                return loc
            }            

        }
        return undefined
};

module.exports.lookupByCityState = (city, state) => {
    let zips = []
    for(let i = 0; i < data.length; i++){
        let loc = data[i]    
        
        if(city === loc.city && state === loc.state){            
            zips.push({"zip": loc._id, "pop": loc.pop})
        }            

    }
    return { "city": city,  "state": state, "data":zips}
};

module.exports.getPopulationByState = (state) => {
    let population = 0
    for(let i = 0; i < data.length; i++){
        let loc = data[i]    
        
        if(state === loc.state){            
            population += loc.pop    
        }
    }

    return { "state":state, "pop": population}
};

