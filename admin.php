<?php
session_start();
include 'includes/dbConn.php';
$dbConn = getDatabaseConnection("heroku_ec49987c2231ba0");
if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
    header("Location: index.php");
}

function studentList(){
global $dbConn;
  
  $sql = "SELECT *
          FROM m_students";
  $stmt = $dbConn->prepare($sql);
  $stmt->execute();
  $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
  //print_r($records);
  return $records;
    
}

function courseList() {
global $dbConn;
  
  $sql = "SELECT *
          FROM courses";
  $stmt = $dbConn->prepare($sql);
  $stmt->execute();
  $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
  //print_r($records);
  return $records;
    
}

function instructorList() {
global $dbConn;
  
  $sql = "SELECT *
          FROM instructors";
  $stmt = $dbConn->prepare($sql);
  $stmt->execute();
  $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
  //print_r($records);
  return $records;
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administration </title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this item?");
            }
        </script>
    </head>
    <body>
        <div id="container">
            <h1> Administration </h1>
            <h2> Welcome <?=$_SESSION['adminName']?>!</h2>
            
            
            <form action="addStudent.php">
                <input class="btn btn-success" type="submit" value="Add new student" />
            </form>
            <form action="addCourse.php">
                <input class="btn btn-success" type="submit" value="Add new course" />
            </form>
            <form action="addInstructor.php">
                <input class="btn btn-success" type="submit" value="Add new instructor" />
            </form>
            <br />
            <form action="logout.php">
                <input class="btn btn-warning" type="submit" value="Logout!" />
            </form>
            
            <?php
                 $students = studentList();
                  echo "<table align='center' id=\"t4\">
                <tr>
                <thead>
                <th>First Name   </th>
     	        <th>Last Name </th>
             	</thead>
                </tr>";
                 foreach($students as $student) {
                     echo "<tr>";
                     echo "<td>".$student['firstName'] . "</td><td> " . $student['lastName'] . "</td>";
                     echo "<td>[<a class='link' href='updateStudent.php?studentId=".$student['studentId']."'> Update </a>] </td>";
                     echo "<td>[<a class='link' onclick='return confirmDelete()' href='deleteStudent.php?studentId=".$student['studentId']."'> Delete </a>] </td>";
                 }
                 echo "</table>";
                 
                 
                $courses = courseList();
                  echo "<table align='center' id=\"t5\">
                <tr>
                <thead>
     	        <th>Course </th>
             	</thead>
                </tr>";
                 foreach($courses as $course) {
                     echo "<tr>";
                     echo "<td>".$course['courseName'] . "</td>";
                     echo "<td>[<a class='link' onclick='return confirmDelete()' href='deleteCourse.php?courseId=".$course['courseId']."'> Delete </a>] </td>";
                 }
                 echo "</table>";
                 
                 
                 $instructors = instructorList();
                  echo "<table align='center' id=\"t6\">
                <tr>
                <thead>
                <th>ID</th>
     	        <th>Instructor </th>
             	</thead>
                </tr>";
                 foreach($instructors as $instructor) {
                     echo "<tr>";
                     echo "<td>".$instructor['instructorId']."</td><td>".$instructor['instructorFirst']." ".$instructor['instructorLast'] ."</td>";
                     echo "<td>[<a class='link' onclick='return confirmDelete()' href='deleteInstructor.php?instructorId=".$instructor['instructorId']."'> Delete </a>] </td>";
                 }
                 echo "</table>";
                 
                 
                 
                 
             ?>
        </div>
    </body>
</html>