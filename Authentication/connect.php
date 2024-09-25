<?php

// Database connection details
$host = "localhost";
$user = "root";
$pass = "";
$db = "Assignment02";

// Create a connection to the MySQL server
$conn = new mysqli($host, $user, $pass);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't already exist
$sql = "CREATE DATABASE IF NOT EXISTS $db";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database to use
$conn->select_db($db);

// Create the 'users' table if it doesn't already exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    firstName VARCHAR(50) NOT NULL, 
    lastName VARCHAR(50) NOT NULL, 
    email VARCHAR(100) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL 
)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    die("Error creating table: " . $conn->error);
}

?>