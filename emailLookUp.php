<?php
include 'includes/dbConn.php';
$dbConn = getDatabaseConnection("heroku_ec49987c2231ba0");

function getStudentsEmail() {
    global $dbConn;
    $email = $_GET['email']; 
   
    $sql = "SELECT * from m_students WHERE email='$email'"; 
     
    $statement = $dbConn->prepare($sql); 
    $statement->execute(); 
    $records = $statement->fetchAll(); 
        
    echo json_encode($records); 
}
   
     
     
if ($_GET['action'] == 'validate-email' ) {
    getStudentsEmail(); 
}

?>