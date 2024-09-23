<?php
// php/login_process.php

session_start();

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
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Hash the password (assuming passwords are stored hashed)
$hashed_password = md5($password); // Replace with a stronger hash function like password_hash()

// Query to check if user exists
$sql = "SELECT id, name FROM users WHERE email='$email' AND password='$hashed_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, set session variables
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['name'];

    // Redirect to the main page or dashboard
    header("Location: ../index.html");
} else {
    // Invalid credentials, redirect back with error
    header("Location: ../login.html?error=invalid_credentials");
}

$conn->close();
?>
