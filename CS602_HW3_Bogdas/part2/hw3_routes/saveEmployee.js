const employeeDB = require('../employeeDB.js');
const Employee = employeeDB.getModel();

module.exports = async (req, res, next) => {

  // Fill in the code
  let data = req.body

  // if valid data
  if (data) {
    let employee = new Employee({
      firstName: data.fname,
      lastName: data.lname
    })
    
    await employee.save()

    res.redirect('/employees');
  } else {
    //bad request
    res.render('404')
  }

};
