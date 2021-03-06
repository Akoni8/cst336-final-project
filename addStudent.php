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
             (firstName, lastName, gender, email,deptId) 
             VALUES
             (:fName, :lName, :gender,:email, :deptId)";
    $np = array();
    
    $np[':fName'] = $_GET['firstName'];
    $np[':lName'] = $_GET['lastName'];
    $np[':gender'] = $_GET['gender'];
    $np[':email'] = $_GET['email'];
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
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
            function validateEmail() {
            $.ajax({
                type: "GET",
                url: "emailLookUp.php",
                dataType: "json",
                data: {
                    'email': $('#email').val(),
                    'action': 'validate-email'
                },
                success: function(data,status) {
                    debugger;
                    if (data.length>0) {
                        $('#email-valid').html("Email is not available");
                        $('#email-valid').css("color", "red");
                    } else {
                        $('#email-valid').html("Email is available"); 
                        $('#email-valid').css("color", "green");
                    }
                  },
                complete: function(data,status) { 
                    //optional, used for debugging purposes
                    //alert(status);
                }
            });
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
        		</div>
        		<div class="collapse navbar-collapse" id="bs-nav-demo">
        			<ul class="nav navbar-nav navbar-right">
        				<li><a href="login.php">Login</a></li>
        			</ul>
        		</div>
        	</div>
        </nav>

        <div id="container">
            <h1> Adding New Student </h1>
            <form method="GET">
                First Name:<input type="text" name="firstName" />
                <br />
                Last Name:<input type="text" name="lastName"/>
                <br/>
                Gender(single letter): <input type= "text" name ="gender"/>
                <br />
                Email: <input type= "email" id="email" onchange="validateEmail();" name ="email"/><br/><span id="email-valid"></span>
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
        </div>
        
    </body>
</html>