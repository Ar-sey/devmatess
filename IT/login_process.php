<?php
session_start();

// DB connection
$conn = new mysqli("localhost", "root", "", "devmate_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Check if user exists
$sql = "SELECT * FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: login.php?error=Incorrect password.");
        exit();
    }
} else {
    header("Location: login.php?error=Username not found.");
    exit();
}
?>
