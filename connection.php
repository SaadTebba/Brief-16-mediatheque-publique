<?php
  
try {
    $servername = "localhost";
    $dbname = "brief-16";
    $username = "root";
    $password = "";
 
    $conn = new PDO("mysql:host=$servername; dbname=brief-16", $username, $password);
     
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
} catch(PDOException $e) {
    echo "Connection failed: "
        . $e->getMessage();
}