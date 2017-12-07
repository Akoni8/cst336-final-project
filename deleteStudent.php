<?php

include 'includes/dbConn.php';
$dbConn = getDatabaseConnection("heroku_ec49987c2231ba0");

    $sql = "DELETE FROM m_students
            WHERE studentId = " .$_GET['studentId'];
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
  
  header("Location: admin.php");
    
?>