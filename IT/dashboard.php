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
  <meta charset="UTF-8">
  <title>DevMate Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Fredoka', sans-serif;
     background: linear-gradient(to bottom right, #7b2ff7, #f107a3);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      text-align: center;
    }

    h2 {
      color: #000;
      font-size: 24px;
      margin-bottom: 10px;
    }

    .logout-btn {
      background-color: #ffcc00;
      color: #000;
      border: none;
      padding: 10px 20px;
      border-radius: 12px;
      font-size: 16px;
      cursor: pointer;
      margin-bottom: 20px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #e6b800;
    }

    .welcome {
      font-size: 24px;
      color: #000;
      margin-bottom: 30px;
      font-weight: bold;
    }

    .dashboard {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .dashboard a {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-decoration: none;
      color: #333;
    }

    .dashboard img {
      width: 150px;
      height: 150px;
      border-radius: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .dashboard img:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }

    .label {
      margin-top: 10px;
      font-size: 18px;
      font-weight: bold;
      color: white;
      text-shadow: 1px 1px 2px #00000080;
    }
  </style>
</head>
<body>

  <button class="logout-btn" onclick="location.href='logout.php'">Logout</button>
  <div class="welcome">Hello, <?php echo htmlspecialchars($username); ?>!</div>

  <div class="dashboard">
    <a href="learning_games.php">
      <img src="learninggames.jpeg" alt="Learning Games">
      <div class="label"></div>
    </a>
    <a href="progress.php">
      <img src="myprogress.jpeg" alt="My Progress">
      <div class="label"></div>
    </a>
    <a href="rewards.php">
      <img src="myrewards.jpeg" alt="My Rewards">
      <div class="label"></div>
    </a>
    <a href="myroutine.php">
      <img src="myroutine.jpeg" alt="My Routine">
      <div class="label"></div>
    </a>
  </div>

</body>
</html>
