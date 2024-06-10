const express = require('express');
const app = express();

const bodyParser = require("body-parser");
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// setup handlebars view engine
const handlebars = require('express-handlebars');

app.engine('handlebars',
	handlebars({ defaultLayout: 'main' }));

app.set('view engine', 'handlebars');

// static resources
app.use(express.static(__dirname + '/public'));

// Use the zipCode module
const cities = require('./zipCodeModule_v2');

// GET request to the homepage

app.get('/', (req, res) => {
	res.render('homeView');
});

app.get('/zip', (req, res) => {
	const id = req.query.id
	//if 'id' query param is present, execute lookup function
	if (id) {
		res.render('lookupByZipView', { data: cities.lookupByZipCode(id) })

	} else { res.render('lookupByZipForm') }
});

	// gets 'id' from req.body and executes lookup function. If data is returned, render the View page. Else render 404
app.post('/zip', (req, res) => {
	const id = req.body.id
	const data = cities.lookupByZipCode(id)
	if (data) {
		res.render('lookupByZipView', { data: data })

	} else { res.render('404') }

});

// Implement the JSON, XML, & HTML formats

app.get('/zip/:id', (req, res) => {
	const id = req.params.id
	// use lookup function to get data for responses
	let data = cities.lookupByZipCode(id)
	res.format({
		'application/json': () => {
			res.json(data)
		},

		'application/xml': () => {
			// build xml string to be sent in response
			let xml = `<? xml version = "1.0" ?>
			<zipCode id="`+ data._id + `">
				<city>`+ data.city + `</city>
				<state>`+ data.state + `</state>
				<pop>`+ data.pop + `</pop>
			</zipCode>`
			res.type('application/xml')
			res.send(xml)

		},

		'text/html': () => {

			res.type('text/html')
			res.render('lookupByZipView', { data: data })
		}
	})


});



app.get('/city', (req, res) => {
	const city = req.query.city
	const state = req.query.state
	// check if city and state req query strings are present then displays view accordingly
	if (city && state) {
		const data = cities.lookupByCityState(city, state)

		res.render('lookupByCityStateView', { "city": city, "state": state, "data": data })
	} else {
		res.render('lookupByCityStateForm')
	}

});

app.post('/city', (req, res) => {
	const city = req.body.city
	const state = req.body.state

	const data = cities.lookupByCityState(city, state)
	if (data) {
		res.render('lookupByCityStateView', { "city": city, "state": state, "data": data })
	}
});

// Implement the JSON, XML, & HTML formats

app.get('/city/:city/state/:state', (req, res) => {
	const city = req.params.city
	const state = req.params.state
	const data = cities.lookupByCityState(city, state)
	let entries = ''
	// the data object also includes a data property, which includes all of the zip codes and their populations
	// concatenate data into 'entries' using loop
	for (const i of data.data) {
		entries += `<entry zip="${i._id}" pop="${i.pop} />`

	}
	res.format({
		'application/json': () => {
			res.json(data)
		},

		'application/xml': () => {
			let xml = `<?xml version="1.0"?>
			<city-state city="`+ city + `" state="` + state + `">` +
				entries
				+ `</city-state>`

			res.type('application/xml')
			res.send(xml)

		},

		'text/html': () => {

			res.type('text/html')
			res.render('lookupByCityStateView', { "city": city, "state": state, "data": data })
		}
	})



});



app.get('/pop', (req, res) => {
	const state = req.query.state

	if (state) {
		const population = cities.getPopulationByState(state)
		res.render('populationView', { "state": state, "pop": population })
	} else {
		res.render('populationForm')
	}

});

// Implement the JSON, XML, & HTML formats

app.get('/pop/:state', (req, res) => {
	const state = req.params.state
	const pop = cities.getPopulationByState(state)
	// the 'pop' object returned by the lookup function contains another 'pop' property that includes the state and the population
	if (pop) {

		res.format({
			'application/json': () => {
				// could also do "state": pop.state 
				res.json({ "state": state, "pop": pop.pop })
			},

			'application/xml': () => {
				let xml = `<?xml version="1.0"?>
				<state-pop state="${pop.state}">
				<pop>${pop.pop}</pop>
				</state-pop>`
				res.type('application/xml')
				res.send(xml)
			},

			'text/html': () => {

				res.type('text/html')
				res.render('populationView', { "state": state, "pop": pop.pop })
			}
		})
	}
});


app.use((req, res) => {
	res.status(404);
	res.render('404');
});

app.listen(3000, () => {
	console.log('http://localhost:3000');
});




