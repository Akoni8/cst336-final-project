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


if (isset($_GET['addStudent'])) {  //the add form has been submitted

    $sql = "INSERT INTO m_students
             (firstName, lastName, gender,deptId) 
             VALUES
             (:fName, :lName, :gender, :deptId)";
    $np = array();
    
    $np[':fName'] = $_GET['firstName'];
    $np[':lName'] = $_GET['lastName'];
    $np[':gender'] = $_GET['gender'];
    $np[':deptId'] = $_GET['deptId'];
    
    $stmt=$dbConn->prepare($sql);
    $stmt->execute($np);
    
    echo "<span class='update'd>Student was added!</span>";
    
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin: Add new student</title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>

        <div id="container">
            <h1> Adding New Student </h1>
            <form method="GET">
                First Name:<input type="text" name="firstName" />
                <br />
                Last Name:<input type="text" name="lastName"/>
                <br/>
                Gender(single letter): <input type= "text" name ="gender"/>
                <br />
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
                <input class="btn btn-primary" type="submit" value="Add Student" name="addStudent">
            </form>
            <a class="link" href="admin.php ">Back to Admin Page</a>
        </div>
        
    </body>
</html>