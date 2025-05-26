<?php
// Start a session if you plan to use any session data
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Color Activity with Images</title>
  <link rel="stylesheet" href="devmate.css">
  <a href="learning_games.php" class="back-button">⬅ Back to Learning Games</a>
  <style>
    body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(to bottom right, #7b2ff7, #f107a3);
  padding: 20px;
  text-align: center;
  color: #333;
}

.back-button {
  position: absolute;
  top: 20px;
  left: 20px;
  padding: 10px 18px;
  background-color: #ff69b4;
  color: #fff;
  text-decoration: none;
  border-radius: 10px;
  font-weight: bold;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  transition: background-color 0.3s ease;
}

.back-button:hover {
  background-color: #e0559f;
}

h2 {
  color: #581845;
  font-size: 2.2em;
  margin-top: 60px;
  margin-bottom: 10px;
}

p {
  font-size: 1.1em;
}

.question {
  display: none;
  background: white;
  border-radius: 20px;
  padding: 30px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
  max-width: 600px;
  margin: 40px auto;
}

.question.active {
  display: block;
}

.color-box {
  width: 70px;
  height: 70px;
  border-radius: 15px;
  border: 3px solid #444;
  cursor: pointer;
  display: inline-block;
  margin: 15px;
  transition: transform 0.3s, box-shadow 0.3s;
}

.color-box:hover {
  transform: scale(1.1);
  box-shadow: 0 0 12px rgba(0,0,0,0.3);
}

.color-box.disabled {
  cursor: not-allowed;
  opacity: 0.5;
}

img {
  display: block;
  margin: 20px auto;
  max-width: 100%;
  max-height: 300px;
  border-radius: 12px;
  box-shadow: 0 3px 15px rgba(0,0,0,0.2);
  object-fit: cover;
}

/* Color Styles */
.green { background-color: green; }
.black { background-color: black; }
.blue { background-color: blue; }
.purple { background-color: purple; }
.pink { background-color: hotpink; }
.orange { background-color: orange; }
.yellow { background-color: yellow; }
.red { background-color: red; }
.teal { background-color: teal; }
.brown { background-color: brown; }
.gray { background-color: gray; }

.end {
  font-size: 1.6em;
  color: #388e3c;
  font-weight: bold;
}

.score {
  font-size: 1.3em;
  color: #00796b;
  margin-top: 10px;
}

.notification {
  position: fixed;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  background-color: #444;
  color: white;
  padding: 12px 24px;
  border-radius: 10px;
  display: none;
  font-size: 1.2em;
  z-index: 1000;
  box-shadow: 0 3px 10px rgba(0,0,0,0.3);
}

.notification.correct {
  background-color: #43a047;
}

.notification.wrong {
  background-color: #e53935;
}

  </style>
</head>
<body>

  <h2>🎨 Color Activity</h2>
  <p><strong>Instructions:</strong> Look at the picture and select the color.</p>

  <!-- Question 1 -->
  <div class="question active" id="q1">
    <p>🌱 What color is the grass?</p>
    <img src="1.jpeg" alt="Grass Image">
    <div class="color-box green" onclick="nextQuestion('q1', 'q2', true)"></div>
    <div class="color-box black" onclick="nextQuestion('q1', 'q2', false)"></div>
    <div class="color-box blue" onclick="nextQuestion('q1', 'q2', false)"></div>
  </div>

  <!-- Question 2 -->
  <div class="question" id="q2">
    <p>☁️ What color is the sky?</p>
    <img src="2.jpeg" alt="Sky Image">
    <div class="color-box purple" onclick="nextQuestion('q2', 'q3', false)"></div>
    <div class="color-box blue" onclick="nextQuestion('q2', 'q3', true)"></div>
    <div class="color-box pink" onclick="nextQuestion('q2', 'q3', false)"></div>
  </div>

  <!-- Question 3 -->
  <div class="question" id="q3">
    <p>🐱 What color is the cat?</p>
    <img src="memeng.jpeg" alt="Orange Cat">
    <div class="color-box orange" onclick="nextQuestion('q3', 'q4', true)"></div>
    <div class="color-box yellow" onclick="nextQuestion('q3', 'q4', false)"></div>
    <div class="color-box pink" onclick="nextQuestion('q3', 'q4', false)"></div>
  </div>

  <!-- Question 4 -->
  <div class="question" id="q4">
    <p>🥭 What color is the mango?</p>
    <img src="mangga.jpeg" alt="Yellow Mango">
    <div class="color-box black" onclick="nextQuestion('q4', 'q5', false)"></div>
    <div class="color-box red" onclick="nextQuestion('q4', 'q5', false)"></div>
    <div class="color-box yellow" onclick="nextQuestion('q4', 'q5', true)"></div>
  </div>

  <!-- Question 5 -->
  <div class="question" id="q5">
    <p>👕 What color is the shirt?</p>
    <img src="wow nina.jpeg" alt="Black Shirt">
    <div class="color-box teal" onclick="nextQuestion('q5', 'end', false)"></div>
    <div class="color-box brown" onclick="nextQuestion('q5', 'end', false)"></div>
    <div class="color-box gray" onclick="nextQuestion('q5', 'end', false)"></div>
    <div class="color-box black" onclick="nextQuestion('q5', 'end', true)"></div>
  </div>

  <!-- End -->
  <div class="question" id="end">
    <h3 class="end">🎉 Congratulations!</h3>
    <p>You finished all the color questions! Great job!</p>
    <p class="score">Your Score: <span id="score">0</span>/5</p>
  </div>

  <!-- Notification div -->
  <div id="notification" class="notification"></div>

  <script>
    let score = 0;  // Initialize score

    function nextQuestion(current, next, correct) {
      // Disable all color boxes for the current question
      const colorBoxes = document.querySelectorAll(`#${current} .color-box`);
      colorBoxes.forEach(box => {
        box.classList.add("disabled");
        box.setAttribute("onclick", ""); // Disable clicking
      });

      // Show notification based on correctness
      const notification = document.getElementById('notification');
      if (correct) {
        score++;
        notification.textContent = "✅ Correct Answer!";
        notification.className = "notification correct";
      } else {
        notification.textContent = "❌ Wrong Answer. Try again next time!";
        notification.className = "notification wrong";
      }

      // Show the notification
      notification.style.display = "block";

      // Hide notification after 2 seconds
      setTimeout(() => {
        notification.style.display = "none";

        // Move to the next question
        document.getElementById(current).classList.remove("active");
        document.getElementById(next).classList.add("active");

        // Update the score display
        updateScore();
      }, 2000);
    }

    function updateScore() {
      // Display the current score at the end
      document.getElementById('score').innerText = score;
    }
  </script>

</body>
</html>
