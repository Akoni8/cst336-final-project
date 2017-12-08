<?php
function showStudents() {
    global $dbConn;
    // echo "<div>";
            $sql = "SELECT * FROM m_students";
             if (!empty($_POST['typedtext'])) {
                  $sql = $sql. " WHERE firstName LIKE '%".$_POST['typedtext']."%'". " OR lastName LIKE '%".$_POST['typedtext']."%' ";
                }
            
            if ($_POST['sort'] == "students" && $_POST['sortorder'] == "ascending")
                    $sql = $sql . " ORDER BY lastName ASC";
            else if ($_POST['sort'] == "students" && $_POST['sortorder'] == "descending")
                    $sql = $sql . " ORDER BY lastName DESC";
            $stmt = $dbConn->query($sql);	
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
            if (!empty($_POST['typedtext'])) {
                  $sql = $sql. " WHERE courseName LIKE '%".$_POST['typedtext']."%' ";
                }
                
             if ($_POST['sort'] == "courses" && $_POST['sortorder'] == "ascending") # Name
                    $sql = $sql . " ORDER BY courseName ASC";
            else if ($_POST['sort'] == "courses" && $_POST['sortorder'] == "descending")
                    $sql = $sql . " ORDER BY courseName DESC";    
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
            if (!empty($_POST['typedtext'])) {
                  $sql = $sql. " WHERE instructorFirst LIKE '%".$_POST['typedtext']."%' OR instructorLast LIKE '%".$_POST['typedtext']."%' ";
                }
                
             if ($_POST['sort'] == "instructors" && $_POST['sortorder'] == "ascending") # Name
                    $sql = $sql . " ORDER BY instructorLast ASC";
            else if ($_POST['sort'] == "instructors" && $_POST['sortorder'] == "descending")
                    $sql = $sql . " ORDER BY instructorLast DESC";   
            
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