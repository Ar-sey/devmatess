<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="devmate1.css">
  <title>Hygiene or Not?</title>
  <style>
    body {
      font-family: 'Comic Sans MS', cursive, sans-serif;
      margin: 0;
      padding: 0;
      text-align: center;
    }

    header {
      background-color: #00acc1;
      color: white;
      padding: 20px;
      font-size: 28px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .instructions {
      background: #fff3cd;
      padding: 15px;
      margin: 20px auto;
      max-width: 600px;
      border-radius: 10px;
      border: 2px solid #ffeeba;
    }

    .card-container {
      margin: 30px auto;
      max-width: 300px;
      background: white;
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      padding: 20px;
      display: none;
      flex-direction: column;
      align-items: center;
    }

    .card-container.active {
      display: flex;
    }

    .card-container img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 10px;
    }

    .buttons {
      margin-top: 15px;
      display: flex;
      justify-content: space-around;
      width: 100%;
    }

    .btn {
      font-size: 24px;
      padding: 10px 15px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      transition: transform 0.2s;
    }

    .btn:hover {
      transform: scale(1.1);
    }

    .btn.correct {
      background-color: #4caf50;
      color: white;
    }

    .btn.wrong {
      background-color: #f44336;
      color: white;
    }

    .notification {
      position: fixed;
      top: -80px;
      left: 50%;
      transform: translateX(-50%);
      background: #4caf50;
      color: white;
      padding: 12px 30px;
      border-radius: 10px;
      font-size: 18px;
      transition: top 0.4s ease;
      z-index: 999;
    }

    .notification.error {
      background: #e53935;
    }

    .notification.show {
      top: 20px;
    }

    .scoreboard {
      font-size: 22px;
      font-weight: bold;
      margin-top: 30px;
      color: #2e7d32;
    }
  </style>
</head>
<body>

  <header>🧼 Hygiene or Not? 🚿</header>
  
  <div class="instructions">
    Look at each picture. If it shows good hygiene, click ✅. If it doesn't, click ❌.
  </div>

  <div class="notification" id="notificationBar"></div>

  <!-- Card 1 -->
  <div class="card-container active" data-correct="true">
    <img src="nail.jpeg" alt="Nail Clipping">
    <div class="buttons">
      <button class="btn correct" onclick="checkAnswer(true)">✅</button>
      <button class="btn wrong" onclick="checkAnswer(false)">❌</button>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="card-container" data-correct="false">
    <img src="ice.jpeg" alt="Eating Ice Cream">
    <div class="buttons">
      <button class="btn correct" onclick="checkAnswer(true)">✅</button>
      <button class="btn wrong" onclick="checkAnswer(false)">❌</button>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="card-container" data-correct="true">
    <img src="wash.jpeg" alt="Hand Washing">
    <div class="buttons">
      <button class="btn correct" onclick="checkAnswer(true)">✅</button>
      <button class="btn wrong" onclick="checkAnswer(false)">❌</button>
    </div>
  </div>

  <!-- Card 4 -->
  <div class="card-container" data-correct="true">
    <img src="brush.jpeg" alt="Brushing Teeth">
    <div class="buttons">
      <button class="btn correct" onclick="checkAnswer(true)">✅</button>
      <button class="btn wrong" onclick="checkAnswer(false)">❌</button>
    </div>
  </div>

  <!-- Card 5 -->
  <div class="card-container" data-correct="false">
    <img src="playing.jpeg" alt="Playing in Mud">
    <div class="buttons">
      <button class="btn correct" onclick="checkAnswer(true)">✅</button>
      <button class="btn wrong" onclick="checkAnswer(false)">❌</button>
    </div>
  </div>

  <!-- Scoreboard -->
  <div id="scoreboard" class="scoreboard"></div>

  <a href="learning_games.php" style="display: inline-block; margin: 20px auto; font-size: 18px; text-decoration: none; background-color:rgb(239, 245, 244); padding: 10px 20px; border-radius: 10px; color: black; font-weight: bold;">⬅ Back to Games</a>

  <script>
  let current = 0;
  let score = 0;
  const cards = document.querySelectorAll(".card-container");
  const scoreboard = document.getElementById("scoreboard");

  function showCard(index) {
    cards.forEach((card, i) => {
      card.classList.toggle("active", i === index);
    });
  }

  function showNotification(message, isError = false) {
    const bar = document.getElementById("notificationBar");
    bar.textContent = message;
    bar.className = "notification show" + (isError ? " error" : "");
    setTimeout(() => {
      bar.classList.remove("show");
    }, 1500);
  }

  function checkAnswer(userAnswer) {
    const actual = cards[current].dataset.correct === "true";
    const isCorrect = userAnswer === actual;

    if (isCorrect) {
      score++;
      showNotification("✅ Correct!");
    } else {
      showNotification("❌ Incorrect.");
    }

    setTimeout(() => {
      current++;
      if (current < cards.length) {
        showCard(current);
      } else {
        showFinalScore();
      }
    }, 1500);
  }

  function showFinalScore() {
    cards.forEach(card => card.classList.remove("active"));
    scoreboard.textContent = `🎯 Score: ${score} out of ${cards.length}`;
    scoreboard.style.display = "block";
    sendScoreToServer(score); // ✅ Send score to the server
    showNotification("🎉 You finished the game!");
  }

  // ✅ This sends the score to record_score.php
  function sendScoreToServer(score) {
    fetch('record_score.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'game=hygiene&score=' + score
    })
    .then(response => response.text())
    .then(data => {
      console.log("Server response:", data);
      // Optionally, show a message if needed
    })
    .catch(error => {
      console.error('Error recording score:', error);
    });
  }
</script>

</body>
</html>
