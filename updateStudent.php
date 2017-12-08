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
                deptId = :deptId
                WHERE studentId = :id";
     $np = array();
     
     $np[':id'] = $_GET['studentId'];
     $np[':fName'] = $_GET['firstName'];
     $np[':lName'] = $_GET['lastName'];
     $np[':gender'] = $_GET['gender'];
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
    </head>
    <body>
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
            <a class="link" href="admin.php ">Back to Admin Page</a>
        </div>
    </body>
</html>