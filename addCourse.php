<?php

include 'includes/dbConn.php';
$dbConn = getDatabaseConnection("heroku_ec49987c2231ba0");

    function departmentList(){
      
        global $dbConn;
        
        $sql = "SELECT * FROM Departments ORDER BY name";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }


if (isset($_GET['addCourse'])) {  //the add form has been submitted

    $sql = "INSERT INTO courses
             (courseName, instructorId, deptId) 
             VALUES
             (:cName, :instId, :deptId)";
    $np = array();
    
    $np[':cName'] = $_GET['courseName'];
    $np[':instId'] = $_GET['instructorId'];
    $np[':deptId'] = $_GET['deptId'];
    
    $stmt=$dbConn->prepare($sql);
    $stmt->execute($np);
    
    echo "<span class='update'd>Course was added!</span>";
    
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin: Add new course</title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>

        <div id="container">
            <h1> Adding New Course </h1>
            <form method="GET">
                Course Name:<input type="text" name="courseName" />
                <br />
                Instructor ID:<input type="text" name="instructorId"/>
                <br/>
                Department: 
                <select name="deptId">
                    <option value="" > Select One </option>
                    <?php
                        $departments = departmentList();
                        
                        foreach($departments as $department) {
                           echo "<option value='".$department['id']."'> " . $department['name']  . "</option>";  
                        }
                    ?>
                </select>
                <br />
                <input class="btn btn-primary" type="submit" value="Add Course" name="addCourse">
            </form>
            <a class="link" href="admin.php ">Back to Admin Page</a>
        </div>
        
    </body>
</html>