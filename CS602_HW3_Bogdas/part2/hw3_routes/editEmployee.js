const employeeDB = require('../employeeDB.js');
const Employee = employeeDB.getModel();

module.exports = async (req , res , next) => {
    // get employee with given ID then pass to view
    let id = req.params.id
    let employee = await Employee.findById(id)

    if(employee){

        res.render('editEmployeeView', { data: {id: employee._id,
        firstName: employee.firstName,
        lastName: employee.lastName
    }})
    } else{
        res.render('404')
    }
    // Fill in the code
    
    
};

