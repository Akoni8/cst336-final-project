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

    return $records;
}

function courseList() {
    global $dbConn;
  
    $sql = "SELECT courseName, name FROM courses c JOIN departments d ON c.deptId = d.id";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $records;
}

function instructorList() {
    global $dbConn;
  
    $sql = "SELECT instructorFirst, instructorLast, instructorId, college, name FROM instructors i JOIN departments d ON i.deptId = d.id";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
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
        <nav class="navbar navbar-default">
        	<div class="container">
        		<div class="navbar-header">
        			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-nav-demo" aria-expanded="false">
        		        <span class="sr-only">Toggle navigation</span>
        		        <span class="icon-bar"></span>
        		        <span class="icon-bar"></span>
        		        <span class="icon-bar"></span>
        		     </button>
        			<a href="index.php" class="navbar-brand">Home</a>
        			<a href="admin.php" class="navbar-brand">Admin</a>
        			<a href="addStudent.php" class="navbar-brand">Add Student</a>
        			<a href="addCourse.php" class="navbar-brand">Add Course</a>
        			<a href="addInstructor.php" class="navbar-brand">Add Instructor</a>
        		</div>
        		<div class="collapse navbar-collapse" id="bs-nav-demo">
        			<ul class="nav navbar-nav navbar-right">
        				<li><a href="logout.php">Logout</a></li>
        			</ul>
        		</div>
        	</div>
        </nav>
        <div id="container">
            <h1> Administration </h1>
            <h2> Welcome <?=$_SESSION['adminName']?>!</h2>

            <form action="reports.php">
                <input type="submit" name="insert" class="btn btn-info" value="Generate Reports"/>
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
     	        <th>Department</th>
             	</thead>
                </tr>";
                foreach($courses as $course) {
                    echo "<tr>";
                    echo "<td>".$course['courseName'] ."</td><td>".$course['name']."</td>";
                    echo "<td>[<a class='link' onclick='return confirmDelete()' href='deleteCourse.php?courseId=".$course['courseId']."'> Delete </a>] </td>";
                }
                echo "</table>";
                 
                $instructors = instructorList();
                echo "<table align='center' id=\"t6\">
                <tr>
                <thead>
                <th>ID</th>
     	        <th>Instructor </th>
     	        <th>Department</th>
     	        <th>College</th>
             	</thead>
                </tr>";
                foreach($instructors as $instructor) {
                    echo "<tr>";
                    echo "<td>".$instructor['instructorId']."</td><td>".$instructor['instructorFirst']." ".$instructor['instructorLast'] ."</td><td>".$instructor['name']."</td><td>".$instructor['college']."</td>";
                    echo "<td>[<a class='link' onclick='return confirmDelete()' href='deleteInstructor.php?instructorId=".$instructor['instructorId']."'> Delete </a>] </td>";
                }
                echo "</table>";
            ?>
        </div>
    </body>
</html>