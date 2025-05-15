<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "Assignment02";

// InfinityFree connection settings
$servername = "localhost"; // Use localhost for InfinityFree
$username = "if0_38984493";
$password = "Limestone570";
$dbname = "if0_38984493_blogs";

// Connect directly to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if needed
$sql = "CREATE TABLE IF NOT EXISTS blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL, 
    author VARCHAR(100) NOT NULL, 
    content TEXT NOT NULL,
    category VARCHAR(100) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
)";
if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}
?>