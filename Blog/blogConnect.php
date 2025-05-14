<?php
// Database connection details
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "Assignment02";
$servername = "sql103.infinityfree.com";
$username = "if0_38984493";
$password = "Limestone570";
$dbname = "if0_38984493_blogs";
// Create a connection to the MySQL server
$conn = new mysqli($servername, $username, $password);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't already exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // If the database was created successfully, select it for use
    $conn->select_db($dbname);
} else {
    // If there was an error creating the database, display an error message
    die("Error creating database: " . $conn->error);
}

// SQL query to create the 'blogs' table if it doesn't already exist
$sql = "CREATE TABLE IF NOT EXISTS blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL, 
    author VARCHAR(100) NOT NULL, 
    content TEXT NOT NULL,
    category VARCHAR(100) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
)";

// Check if the table creation was successful
if ($conn->query($sql) !== TRUE) {
    // If there was an error creating the table, display an error message
    die("Error creating table: " . $conn->error);
}
?>