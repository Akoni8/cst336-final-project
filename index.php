<?php 
session_start();   //starts or resumes a session
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
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
            function myAjax () {
                $.ajax( { type : 'POST',
                data : { },
                url  : 'includes/functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                success: function ( data ) {
                alert( data );               // <=== VALUE RETURNED FROM FUNCTION.
                showStudents();
                },
                error: function ( xhr ) {
                alert( "error" );
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
        		</div>
        		<div class="collapse navbar-collapse" id="bs-nav-demo">
        			<ul class="nav navbar-nav navbar-right">
        				<li><a href="login.php">Login</a></li>
        			</ul>
        		</div>
        	</div>
        </nav>

        <div class="container">
            <!-- <button class="btn btn-primary" onclick="myAjax()">Click here</button>-->
            <strong>Search:</strong>  <input type="text" name="typedtext" placeholder="Search" value="<?=$_GET['typedtext']?>"/>
            <span class="Filter"><strong>Sort - </strong></span>
            <select name = "sorttype">
                <option value="students">Students</option>
                <option value="courses">Courses</option>
                <option value="instructors">Instructors</option>
            </select>
            <select name = "sortorder">
                <option value="ascending">Ascending</option>
                <option value="descending">Descending</option>
            </select>
            <br/>
            <?=showStudents()?>
            <?=showCourses()?>
            <?=showInstructors()?>
        </div>
        
        
        
        
    <script src="http://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>