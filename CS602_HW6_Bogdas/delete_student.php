<?php
require_once('database.php');

// Delete the student from the database
$studentID = filter_input(INPUT_POST, 'studentID');
$query = 'DELETE FROM sk_students WHERE studentID = :studentID';
$statement = $db->prepare($query);
$statement->bindValue(':studentID', $studentID);
$statement->execute();
$statement->closeCursor();

// Display the Home page
include('index.php');