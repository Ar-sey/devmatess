<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: login.php?error=Please log in first.");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Learning Games - DevMate</title>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Fredoka', sans-serif;
  background: linear-gradient(to bottom right, #7b2ff7, #f107a3);
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
      color: #fff;
    }

    .back-button {
      align-self: flex-start;
      margin: 10px;
      background-color: #ffffffcc;
      color: #000;
      padding: 8px 15px;
      text-decoration: none;
      border-radius: 10px;
      font-weight: bold;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    h1 {
      font-size: 36px;
      margin: 20px 0;
      text-shadow: 1px 1px 3px #00000080;
    }

    .game-section {
      width: 100%;
      max-width: 800px;
    }

    .main-card {
      background-color: #ffffff;
      color: #333;
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
      margin-bottom: 20px;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .main-card:hover {
      transform: scale(1.02);
    }

    .main-title {
      font-size: 24px;
      font-weight: bold;
    }

    .sub-options {
      display: none;
      margin-top: 15px;
    }

    .sub-options a {
      display: block;
      background-color: #e0dfff;
      color: #333;
      margin: 8px 0;
      padding: 10px;
      border-radius: 12px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s;
    }

    .sub-options a:hover {
      background-color: #c7bfff;
    }
  </style>

  <script>
    function toggleOptions(id) {
      const section = document.getElementById(id);
      section.style.display = section.style.display === "block" ? "none" : "block";
    }
  </script>
</head>
<body>

  <a href="dashboard.php" class="back-button">⬅ Back to Dashboard</a>
  <h1>Learning Games</h1>

  <div class="game-section">

    <!-- Mind Explorer Card -->
    <div class="main-card" onclick="toggleOptions('explorer-options')">
      <div class="main-title">🧠 Mind Explorer</div>
      <div class="sub-options" id="explorer-options">
        <a href="follow-line.php">Follow the Line Shape</a>
        <a href="shape-tracing.php">Shape Tracing time</a>
        <a href="find-color.php">Find the Color</a>
        <a href="fruit-veggie-sort.php">Fruit or Veggie? Let's Sort It Together</a>
      </div>
    </div>

    <!-- Daily Life Skills Card -->
    <div class="main-card" onclick="toggleOptions('life-options')">
      <div class="main-title">🧼 Daily Life Skills</div>
      <div class="sub-options" id="life-options">
        <a href="hygiene-check.php">Hygiene or Not?</a>
        <a href="whats-in-bag.php">What's in My Bag?</a>
        <a href="daily-routine.php">Daily Routine: What Comes First</a>
      </div>
    </div>

  </div>

</body>
</html>
