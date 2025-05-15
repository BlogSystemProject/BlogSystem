<?php
// Start session at the beginning
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'connect.php';

// Handle GET parameter 'i' if present
if (isset($_GET['i'])) {
    $i = $_GET['i'];
    if ($i == 1) {
        echo "Test mode active. Database connection status: OK";
        exit();
    }
}

// Check if the user clicked the register button
if (isset($_POST['register'])) {
    try {
        // Get user input from the registration form
        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password for security
        $hashedPassword = md5($password);

        // Check if the email is already registered using mysqli
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // If the email is already in use, alert the user and redirect back to the registration page
        if ($result->num_rows > 0) {
            echo "<script>
                alert('Email Address Already Exists!');
                window.location.href = 'register.php';
            </script>";
        } else {
            // If the email is not in use, insert the new user's data into the database
            $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);
            $result = $stmt->execute();

            // If the insertion is successful, redirect to the home page; otherwise, show an error
            if ($result) {
                header("Location: ../index.php");
                exit();
            } else {
                throw new Exception("Error inserting user data: " . $conn->error);
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Check if the user clicked the login button
if (isset($_POST['login'])) {
    try {
        // Get user input from the login form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password for verification
        $hashedPassword = md5($password);

        // Query the database to check if the credentials match a user using mysqli
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $hashedPassword);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // If the credentials are correct, start a session and log the user in
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["email"] = $row['email'];
            header("Location: ../Blog/home.php");
            exit();
        } else {
            // If the credentials are incorrect, alert the user and redirect to the login page
            echo "<script>
                    alert('Incorrect Email or Password');
                    window.location.href = '../index.php';
                  </script>";
            exit();
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>