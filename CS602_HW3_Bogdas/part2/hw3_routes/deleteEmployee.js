const employeeDB = require('../employeeDB.js');
const Employee = employeeDB.getModel();

module.exports = async (req , res , next) => {
  let id = req.params.id

  // get employee object from DB
  let employee = await Employee.findById(id)

  // if found
  if(employee){

      res.render('deleteEmployeeView', { data: {id: employee._id,
      firstName: employee.firstName,
      lastName: employee.lastName
  }})
  } else{
      res.render('404')
  }

  };

  