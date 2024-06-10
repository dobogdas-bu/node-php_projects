<?php
require_once('database.php');



//handle request for courses action
if($_GET['action'] === 'courses'){
    //parse request params
    $format = $_GET['format'];
    // get the data
    $query = 'SELECT * FROM sk_courses';
    $statement = $db->prepare($query);
    $statement ->execute();
    $courses = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement -> closeCursor();

    // build response based on provided format
    if($format === 'json'){
        header("Content-type: application/json");
        echo json_encode($courses);
    }
     else if ($format === 'xml'){
        header('Content-Type: application/xml');        
        $doc = new DOMDocument('1.0');
		$doc->preserveWhiteSpace = false;		
		$doc->formatOutput = true;
        $root = $doc->createElement('courses');
        $doc->appendChild($root);
        // for each course build an element of its properties, then append each course with its properties to the root
        foreach($courses as $course){
            $courseElement = $doc->createElement('course');
            foreach($course as $key => $value){
                $i= $doc->createElement($key, $value);
                $courseElement->appendChild($i);
            }
            $root->appendChild($courseElement);
        }
        // returns doc as string
        echo $doc->saveXML();       
    }

    else {
        echo 'Format supported.';
    }
    
    
}

// handle request for students
if($_GET['action']==='students') {
    //parse request params
    $format = $_GET['format'];
    $id = $_GET['course'];
    // get the data
    $query = 'SELECT * FROM sk_students WHERE courseID = :id';
    $statement = $db->prepare($query);
    $statement ->bindValue(':id',$id);
    $statement->execute();
    $students = $statement->fetchAll(PDO::FETCH_ASSOC);

    //build response based on format
    if($format === 'json'){
        echo json_encode($students);
    } else if ($format === 'xml'){
        header('Content-Type: application/xml');
        $node = 'student';
        $doc = new DOMDocument('1.0');
		$doc->preserveWhiteSpace = false;		
		$doc->formatOutput = true;
        $root = $doc->createElement('students');
        $doc->appendChild($root);
        
        // for each student build an element of its properties, then append each student with its properties to the root
        foreach($students as $student){
            $studentElement = $doc->createElement('student');
            foreach($student as $key => $value){
                $i= $doc->createElement($key, $value);
                $studentElement->appendChild($i);
            }
            $root->appendChild($studentElement);
        }
        // returns doc as string
        echo $doc->saveXML();       

    } else {
        echo 'Format supported.';
    }
    
}

?>

