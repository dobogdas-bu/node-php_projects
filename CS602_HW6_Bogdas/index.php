<?php
require_once('database.php');

// Get all courses
$courseQuery = 'SELECT * FROM sk_courses';
$statement = $db->prepare($courseQuery);
$statement->execute();
$courses = $statement->fetchAll();
$statement->closeCursor();

// Get selected course
$courseID = filter_input(INPUT_GET, 'courseID');

if($courseID == NULL || $courseID== FALSE){
    $courseID='CS601';
}

// Get students for selected course
$studentQuery = 'SELECT * FROM sk_students WHERE courseID = :courseID';
$student_statement = $db->prepare($studentQuery);
$student_statement->bindValue(':courseID', $courseID);
$student_statement->execute();
$students = $student_statement->fetchAll();
$student_statement->closeCursor();



?>

<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Course Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Course Manager</h1></header>
<main>
    <center><h1>Student List</h1></center>

    <aside>
        <!-- display a list of categories -->
        <h2>Courses</h2>
        <nav>
        <ul>
            <!-- loop through and build list with hrefs -->        
            <?php foreach($courses as $course) : ?>
                <li><a href=".?courseID=<?php echo $course['courseID'];?>">
                <?php echo $course['courseID'];?> 
            </a>
            </li>
                <?php endforeach; ?>
            
            
        
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of Students -->
        
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>&nbsp;</th>
            </tr>
            <?php
                foreach($students as $student){
                    echo '<tr>';
                    echo '<td>'.$student['firstName'].'</td>';
                    echo '<td>'.$student['lastName'].'</td>';
                    echo '<td>'.$student['email'].'</td>';
                    echo '<td>
                    <form action="delete_student.php" method="POST">
                        <input type="hidden" name="studentID" value="'.$student['studentID'].'">
                        <input type="submit" value="Delete">
                    </form>
                    </td>';
                    echo '</tr>';
                }
            ?>

            
        </table>

        <p><a href="add_student_form.php">Add Student</a></p>

        <p><a href="course_list.php">List Courses</a></p>    

    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Suresh Kalathur</p>
</footer>
</body>
</html>
