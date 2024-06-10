<?php
    require_once('database.php');

// Get the course form data
$courseID = filter_input(INPUT_POST, 'course_id');
$courseName = filter_input(INPUT_POST, 'course_name');

//validate inputs
if($courseID == null || $courseName == null){
    $error = "Missing required field.";    
    include('error.php');
} else{

 // Add the course to the database  
$query = 'INSERT INTO sk_courses (courseID, courseName) VALUES (:courseID, :courseName);';
$statement = $db->prepare($query);
$statement->bindValue(':courseID', $courseID);
$statement->bindValue(':courseName', $courseName);
$statement->execute();
$statement -> closeCursor();  
   
   
    // Display the Course List page
    include('course_list.php');
}

?>