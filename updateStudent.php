<?php

include 'includes/dbConn.php';
$dbConn = getDatabaseConnection("heroku_ec49987c2231ba0");
  
function getStudentInfo() {
    global $dbConn;
    
    $sql = "SELECT * FROM m_students WHERE studentId = " . $_GET['studentId']; 
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    return $record;
}


 if (isset($_GET['updateStudent'])) { //checks whether admin has submitted form.
     
     //echo "Form has been submitted!";
     
     $sql = "UPDATE m_students 
                SET firstName = :fName,
                lastName  = :lName,
                gender = :gender,
                email = :email,
                deptId = :deptId
                WHERE studentId = :id";
     $np = array();
     
     $np[':id'] = $_GET['studentId'];
     $np[':fName'] = $_GET['firstName'];
     $np[':lName'] = $_GET['lastName'];
     $np[':gender'] = $_GET['gender'];
     $np[':email'] = $_GET['email'];
     $np[':deptId'] = $_GET['deptId'];
     
     $stmt = $dbConn->prepare($sql);
     $stmt->execute($np);
     
     echo "<span class='update'>Record has been updated!</span>";
 }
 if (isset($_GET['studentId'])) {
    $studentInfo = getstudentInfo(); 
 }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Update student </title>
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
            <h1> Updating Student's Info </h1>
            <form method="GET">
                <input type="hidden" name="studentId" value="<?=$studentInfo['studentId']?>" />
                First Name:<input type="text" name="firstName" value="<?=$studentInfo['firstName']?>" />
                <br />
                Last Name:<input type="text" name="lastName" value="<?=$studentInfo['lastName']?>"/>
                <br/>
                Gender: <input type= "text" name ="gender" value="<?=$studentInfo['gender']?>"/>
                <br/>
                Email: <input type= "email" name ="email" id="email" onchange="validateEmail();" value="<?=$studentInfo['email']?>"/><br/><span id="email-valid"></span>
                <br>
                Department: 
                <select name="deptId">
                    <option value="" > - Select One - </option>
                    <option value="Computer Science"  <?=($studentInfo['deptId']=='1')?" selected":"" ?>  > Computer Science</option>
                    <option value="Statistics"  <?=($studentInfo['deptId']=='2')?" selected":"" ?>  >Statistics</option>
                    <option value="Design"  <?=($studentInfo['deptId']=='3')?" selected":"" ?>  >Design</option>
                    <option value="Economics"  <?=($studentInfo['deptId']=='4')?" selected":"" ?>  >Economics</option>
                    <option value="Drama"  <?=($studentInfo['deptId']=='5')?" selected":"" ?>  >Drama</option>
                    <option value="Biology"  <?=($studentInfo['deptId']=='6')?" selected":"" ?>  >Biology</option>
                </select>
                    <br />
                    <input type="submit" value="Update Student" name="updateStudent">
            </form>
        </div>
    </body>
</html>