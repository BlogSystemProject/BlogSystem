<?php
// Include the file that connects to the database
include 'blogConnect.php';

// Check if the form was submitted via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the blog ID from the submitted form data and convert it to an integer
    $id = intval($_POST['id']);

    // Check if the ID is valid (greater than 0)
    if ($id > 0) {
        // SQL query to delete the blog post with the specified ID
        $deleteQuery = "DELETE FROM blogs WHERE Id = $id";

        // Execute the delete query and check if it was successful
        if ($conn->query($deleteQuery)) {
            // If successful, redirect the user back to the home page
            header("Location: home.php");
            exit();
        } else {
            // If there was an error deleting the record, display an error message
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        // If the ID is invalid, display an error message
        echo "Invalid blog ID.";
    }
}

// Close the database connection
$conn->close();
?>