const mongoose = require('mongoose');

const credentials = require("./credentials.js");

const dbUrl = 'mongodb+srv://' + credentials.username +
	':' + credentials.password + '@' + credentials.host + '/' + credentials.database;

let connection = null;
let model = null;

let Schema = mongoose.Schema;

// Step 1. Fill in the schema definition

// Step 2. For collection, replace lastName below with your lastName 
// defines schema and adds to collection 'employees_Bogdas'
let employeeSchema = new Schema({
	firstName: 'string',
	lastName: 'string'
	

}, {
	collection: 'employees_Bogdas'
});

module.exports = {	
	getModel: () => {
		if (connection == null) { // ensures single connection to DB
			console.log("Creating connection and model...");
			connection = mongoose.createConnection(dbUrl, { useNewUrlParser: true, useUnifiedTopology: true });
			model = connection.model("EmployeeModel", 
							employeeSchema);
		};
		return model;
	}
};
























