<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shape Activity</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    /* General styling for the page */
body {
  font-family: 'Comic Sans MS', cursive, sans-serif;
  background: linear-gradient(to right, #6a11cb, #2575fc);
  text-align: center;
  margin: 0;
  padding: 40px 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.container {
  background-color: #fffefb;
  border: 8px double #f4a261;
  border-radius: 30px;
  padding: 40px 30px;
  width: 100%;
  max-width: 600px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
  text-align: center;
}

h1 {
  font-size: 32px;
  color: #e76f51;
}

h2 {
  font-size: 22px;
  color: #2a9d8f;
}

.shape-container {
  margin-top: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}

.shape {
  display: inline-block;
  width: 100px;
  height: 100px;
  margin: 15px;
  background-color: #f4a261;
  cursor: pointer;
  transition: transform 0.3s, background-color 0.3s;
}

.shape:hover {
  transform: scale(1.1);
  background-color: #e76f51;
}

.shape-img {
  width: 100%;
  height: 100%;
  object-fit: contain; /* Ensure the image maintains its aspect ratio */
}

/* Custom shapes if you're using pure CSS shapes (optional) */
.star {
  clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
}

.rectangle {
  width: 150px;
  height: 100px;
}

.diamond {
  transform: rotate(45deg);
}

.triangle {
  clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
}

.circle {
  border-radius: 50%;
}

.square {
  /* Already styled */
}

.result {
  margin-top: 20px;
  font-size: 22px;
  font-weight: bold;
  color: #2a9d8f;
}

.score {
  font-size: 18px;
  color: #333;
  margin-bottom: 10px;
}

.button-group {
  margin-top: 30px;
  display: none;
}

.back-button, #finalLink {
  display: inline-block;
  background-color: #fcbf49;
  color: #000;
  font-weight: bold;
  text-decoration: none;
  padding: 12px 24px;
  border-radius: 12px;
  margin: 10px 10px 0;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

.back-button:hover, #finalLink:hover {
  background-color: #f77f00;
  color: white;
}

  </style>
</head>
<body>

  <div class="container">
     <a href="learning_games.php" class="back-button">⬅ Back to learning games</a>
    <h1>Shape Activity</h1>
    <h2 id="questionText">Can you find the Triangle?</h2>

    <!-- Shape selection container -->
    <div class="shape-container" id="shapeContainer"></div>

    <!-- Feedback message -->
    <div class="result" id="resultText"></div>

    <!-- Score display -->
    <div class="score" id="scoreText">Score: 0</div>

    <!-- Buttons shown only after all questions -->
    <div class="button-group" id="endButtons">
  
    </div>
  </div>

  <script src="canvas.js"></script>
  <script src="lineFollow.js"></script>
  <script src="questions.js"></script>

</body>
</html>
