<?php

session_start();   //starts or resumes a session
include 'includes/dbConn.php';
$dbConn = getDatabaseConnection("heroku_ec49987c2231ba0");
function loginProcess() {
    global $dbConn;
    
    if (isset($_POST['loginForm'])) {  //checks if form has been submitted
            $username = $_POST['username'];
            $password = sha1($_POST['password']);
            
            $sql = "SELECT *
                    FROM Admin
                    WHERE username = :username 
                    AND   password = :password ";
            
            $namedParameters = array();
            $namedParameters[':username'] = $username;
            $namedParameters[':password'] = $password;

            $stmt = $dbConn->prepare($sql);
            $stmt->execute($namedParameters);
            $record = $stmt->fetch();
            
            if (empty($record)) {
                echo "<p class ='wrong'>Wrong Username or Password </p>";
            } 
            else {
               $_SESSION['username'] = $record['username'];
               $_SESSION['adminName'] = $record['firstName'] . "  " . $record['lastName'];
               header("Location: admin.php"); //redirecting to admin.php
            }
    }
}
function showStudents() {
    global $dbConn;
    
     echo "List of all students.<br />";
            $sql2 = "SELECT * FROM m_students ORDER BY lastName ASC";
            $stmt = $dbConn->query($sql2);	
            $results = $stmt->fetchAll();
            foreach ($results as $record) {
    	        echo $record['firstName']." ".$record['lastName'] ."<br />";
             }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Administrator Login  </title>
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
            <h1> Administrator Login </h1>
            <form method="post">
                Username: <input type="text" name="username"/> <br />
                Password: <input type="password" name="password" /> <br />
                <input class="btn btn-primary" type="submit" name="loginForm" value="Login!"/>
            </form>
        </div>
            <br />
            <?=loginProcess()?>
    </body>
</html>