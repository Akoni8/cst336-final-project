<?php 
include 'includes/dbConn.php';
include 'includes/functions.php';
$dbConn = getDatabaseConnection("heroku_ec49987c2231ba0");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Final Project</title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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

        <div class="container">
            <h1>Reports</h1>
            <span class="reports"><?=countStudents()?></span>
            <br/>
            <span class="reports"><?=countCourses()?></span>
            <br/>
            <span class="reports"><?=countInstructors()?></span>  
            <br/>
            <span class="reports"><?=coursesInDepartment()?></span>  
        </div>
        
    </body>
</html>