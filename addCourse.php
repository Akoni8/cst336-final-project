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
        		</div>
        		<div class="collapse navbar-collapse" id="bs-nav-demo">
        			<ul class="nav navbar-nav navbar-right">
        				<li><a href="login.php">Login</a></li>
        			</ul>
        		</div>
        	</div>
        </nav>

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
                <input class="btn btn-primary" class="btn btn-success" type="submit" value="Add Course" name="addCourse">
            </form>
        </div>
        
    </body>
</html>