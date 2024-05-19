<?php
// Database configuration
$servername = "localhost";
$username = "root";    // Default XAMPP MySQL username
$password = "";        // Default XAMPP MySQL password is empty
$dbname = "db_inventory";

// Create connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch (PDOException $e) {
     echo $sql . "<br>" . $e->getMessage();
 }
?>