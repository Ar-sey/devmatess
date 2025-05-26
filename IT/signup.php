<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up - DevMate</title>
  <link rel="stylesheet" href="devmate.css">

  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
  <style>
    /* ... your existing CSS ... */
  </style>
</head>
<body>
  <img class="logo" src="Devmate.jpeg" alt="DevMate Logo" width="350">
  <div class="container">
    <h2>Create Your DevMate Account</h2>
    <?php
      if (isset($_GET['error'])) echo '<div class="error">' . htmlspecialchars($_GET['error']) . '</div>';
      if (isset($_GET['success'])) echo '<div class="success">' . htmlspecialchars($_GET['success']) . '</div>';
    ?>
    <form action="signup_process.php" method="POST">
      <input type="text" name="username" placeholder="Enter a username" required><br>
      <input type="password" name="password" placeholder="Enter a password" required><br>
      <button type="submit" class="btn">Sign Up</button>
    </form>
    <div class="link">Already have an account? <a href="login.php">Login</a></div>
  </div>
</body>
</html>
