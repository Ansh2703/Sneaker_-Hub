<?php
// php/signup_process.php

// Database connection (replace with your actual database credentials)
$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "your_db_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize user inputs
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Hash the password
$hashed_password = md5($password); // Replace with a stronger hash function like password_hash()

// Check if email already exists
$check_sql = "SELECT id FROM users WHERE email='$email'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    // Email already exists, redirect back with error
    header("Location: ../login.html?error=email_exists");
} else {
    // Insert new user into database
    $insert_sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
    if ($conn->query($insert_sql) === TRUE) {
        // Registration successful, redirect to login page
        header("Location: ../login.html?success=registration_successful");
    } else {
        // Error during registration, redirect back with error
        header("Location: ../login.html?error=registration_failed");
    }
}

$conn->close();
?>
