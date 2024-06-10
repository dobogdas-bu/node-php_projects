const employeeDB = require('../employeeDB.js');
const Employee = employeeDB.getModel();

module.exports =  async (req , res , next) => {
    
  let data = req.body

  let employee = await Employee.findById(data.id)
    // if valid data
    if (employee) {
      await employee.remove() 
      res.redirect('/employees');
    } else {
      //bad request
      res.render('404')
    }
    
        
  };

  