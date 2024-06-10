<?php
    
    require_once('database.php');

// Get the student form data
$courseID = filter_input(INPUT_POST, 'courseID');
$firstName= filter_input(INPUT_POST, 'first_name');
$lastName= filter_input(INPUT_POST, 'last_name');
$email= filter_input(INPUT_POST, 'email');



// Validate inputs
if($courseID == null || $firstName == null || $lastName == null || $email == null){
    $error = "Missing required field.";    
    include('error.php');
} else{
// Add the student to the database
$query = 'INSERT INTO sk_students (courseID, firstName, lastName, email) VALUES (:courseID, :firstName, :lastName, :email)';
$statement = $db->prepare($query);
$statement ->bindValue(':courseID', $courseID);
$statement ->bindValue(':firstName', $firstName);
$statement ->bindValue(':lastName', $lastName);
$statement ->bindValue(':email', $email);
$statement ->execute();
$statement -> closeCursor();

}

  



    // Display the Student List page
    include('index.php');

?>