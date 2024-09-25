<?php

// Include the file that connects to the database
include 'blogConnect.php';

// Check if the form was submitted via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the blog post details from the submitted form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    // SQL query to insert the new blog post into the 'blogs' table
    $insertQuery = "INSERT INTO blogs (title, author, content, category) VALUES ('$title', '$author', '$content', '$category')";

    // Execute the insert query and check if it was successful
    if ($conn->query($insertQuery) === TRUE) {
        // If the insert is successful, redirect the user to the home page
        header("Location: home.php");
        exit();
    } else {
        // If there was an error inserting the record, display an error message
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>