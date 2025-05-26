<?php
session_start();

// DB connection
$conn = new mysqli("localhost", "root", "", "devmate_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Check if username already exists
$sql = "SELECT id FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    header("Location: signup.php?error=Username already taken.");
    exit();
}

// Insert new user
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$insert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$insert->bind_param("ss", $username, $hashedPassword);

if ($insert->execute()) {
    header("Location: login.php?success=Account created! Please log in.");
    exit();
} else {
    header("Location: signup.php?error=Signup failed.");
    exit();
}
?>
