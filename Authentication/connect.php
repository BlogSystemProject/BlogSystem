<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
// $host = "localhost";
// $user = "root";
// $pass = "";
// $db = "Assignment02";

// InfinityFree connection settings
$host = "sql103.infinityfree.com"; // Use localhost for InfinityFree
$user = "if0_38984493";
$pass = "Limestone570";
$db = "if0_38984493_user";

// Connect directly to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the 'users' table if it doesn't already exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    firstName VARCHAR(50) NOT NULL, 
    lastName VARCHAR(50) NOT NULL, 
    email VARCHAR(100) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL 
)";
if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}
?>