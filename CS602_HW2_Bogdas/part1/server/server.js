const net = require('net');

const colors = require('colors');

const cities = require('./zipCodeModule_v2');

const server = net.createServer((socket) => {

	console.log("Client connection...".red);

	socket.on('end', () => {
		console.log("Client disconnected...".red);
	});

	// HW Code - Write the following code to process data from client
	
	socket.on('data', (data) => {

		let input = data.toString();
		console.log(colors.blue('...Received %s'), input);

		// Fill in the rest
		let response
		let cmd = input.split(' ').join('').split(','); // handles spaces in input string, then re-separates into command and arguments based on commas
	
		// execute function based on passed in cmd; accessed by the first item of the cmd array
		switch (cmd[0]) {
			case 'lookupByZipCode':
					response =cities.lookupByZipCode(cmd[1])
			break;
			case 'lookupByCityState':
				response =cities.lookupByCityState(cmd[1],cmd[2])
			break;
			case 'getPopulationByState':
				response =cities.getPopulationByState(cmd[1])
			break;

			default:
				response =`Invalid request.`

		}
		response = JSON.stringify(response)

		socket.write(response)

		
	});

});

// listen for client connections
server.listen(3000, () => {
	console.log("Listening for connections on port 3000");
});
