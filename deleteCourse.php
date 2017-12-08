<?php

include 'includes/dbConn.php';
$dbConn = getDatabaseConnection("heroku_ec49987c2231ba0");

    $sql = "DELETE FROM courses
            WHERE courseId = " .$_GET['courseId'];
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
  
  header("Location: admin.php");
    
?>