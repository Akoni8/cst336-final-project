<?php
function showStudents() {
    global $dbConn;
    // echo "<div>";
            $sql2 = "SELECT * FROM m_students";
            $stmt = $dbConn->query($sql2);	
            $results = $stmt->fetchAll();
            
             echo "<table align='center' id=\"t1\">
                <tr>
                <thead>
                <th>First </th>
     	        <th>Last </th>
             	</thead>
                </tr>";
            foreach ($results as $record) {
                echo "<tr>";
    	        echo "<td>".$record['firstName']." </td><td>".$record['lastName'] ."<td />";
             }
             echo "</table>";
    // echo "</div>";
}

function showCourses() {
global $dbConn;
    // echo "<div>";
            $sql = "SELECT * FROM courses";
            $stmt = $dbConn->query($sql);	
            $results = $stmt->fetchAll();
            
             echo "<table align='center' id=\"t2\">
                <tr>
                <thead>
     	        <th>Course </th>
             	</thead>
                </tr>";
            foreach ($results as $record) {
                echo "<tr>";
    	        echo "<td> ".$record['courseName'] ."</td>";
             }
             echo "</table>";
    // echo "</div>";
}

function showInstructors() {
    global $dbConn;
    // echo "<div>";
            $sql = "SELECT * FROM instructors";
            $stmt = $dbConn->query($sql);	
            $results = $stmt->fetchAll();
              echo "<table align='center' id=\"t3\">
                <tr>
                <thead>
                <th>Instructor   </th>
             	</thead>
                </tr>";
            foreach ($results as $record) {
                echo "<tr>";
    	        echo "<td>".$record['instructorFirst']." ".$record['instructorLast'] ."</td>";
             }
             echo "</table>";
    // echo "</div>";
}

?>