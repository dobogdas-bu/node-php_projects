const employeeDB = require('../employeeDB.js');
const Employee = employeeDB.getModel();

module.exports = async (req , res , next) => {

    // Fill in the code
let data = req.body

let employee = await Employee.findById(data.id)
  // if valid data
  if (employee) {
    employee.firstName = data.fname
    employee.lastName = data.lname
    
    await employee.save()

    res.redirect('/employees');
  } else {
    //bad request
    res.render('404')
  }
    
    
 };
