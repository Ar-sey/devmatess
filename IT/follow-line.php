<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: login.php?error=Please log in first.");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Follow the Line Shape</title>
  <link rel="stylesheet" href="devmate.css">
  <style>
    body {
      text-align: center;
      background: linear-gradient(to right, #7b2ff7, #00c3ff);
      font-family: 'Fredoka', sans-serif;
      padding: 20px;
      color: white;
    }

    .back-button {
      display: inline-block;
      background-color: #ffffffcc;
      color: #000;
      padding: 8px 15px;
      margin: 10px;
      text-decoration: none;
      border-radius: 10px;
      font-weight: bold;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    h2 {
      font-size: 24px;
      margin-bottom: 20px;
      text-shadow: 1px 1px 3px #00000080;
    }

    .canvas-container {
      margin: 0 auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.3);
      width: fit-content;
      padding: 20px;
    }

    #feedback {
      font-size: 18px;
      margin-top: 15px;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <a href="learning_games.php" class="back-button">⬅ Back to Learning Games</a>
  <h2>Carefully trace the outline of the shape being asked.<br>Take your time and follow the lines carefully.</h2>

  <div class="canvas-container">
    <canvas id="shapeCanvas" width="400" height="400"></canvas>
  </div>

  <p id="feedback" class="feedback"></p>

  <?php
    // Define shapes for tracing
    $shapes = ['star', 'triangle', 'diamond', 'rectangle', 'square'];
    $shapes_json = json_encode($shapes);
  ?>

  <script>
  const shapeList = <?php echo json_encode(['star', 'triangle', 'diamond', 'rectangle', 'square']); ?>;
</script>


  <script src="trace-script.js"></script>
</body>
</html>
