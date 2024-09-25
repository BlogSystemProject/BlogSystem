<?php

// Include the database connection file
include 'connect.php';

// Check if the user clicked the register button
if (isset($_POST['register'])) {
    // Get user input from the registration form
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashedPassword = md5($password);

    // Check if the email is already registered
    $checkEmail = "SELECT * FROM users WHERE email ='$email'";
    $result = $conn->query($checkEmail);

    // If the email is already in use, alert the user and redirect back to the registration page
    if ($result->num_rows > 0) {
        echo
            "<script>
        alert('Email Address Already Exists!');
        window.location.href = 'register.php';
      </script>";
    } else {
        // If the email is not in use, insert the new user's data into the database
        $insertQuery = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";

        // If the insertion is successful, redirect to the home page; otherwise, show an error
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: ../index.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Check if the user clicked the login button
if (isset($_POST['login'])) {
    // Get user input from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for verification
    $hashedPassword = md5($password);

    // Query the database to check if the credentials match a user
    $sql = "SELECT * FROM users WHERE email ='$email' AND password = '$hashedPassword'";
    $result = $conn->query($sql);

    // If the credentials are correct, start a session and log the user in
    if ($result->num_rows > 0) {
        session_start();
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
}
?>