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
  <title>What's in My School Bag?</title>
  <style>
    body {
      font-family: 'Comic Sans MS', cursive, sans-serif;
      margin: 0;
      padding: 30px;
      color: #333;
    }

    h1 {
      color: #333;
    }

    .instructions {
      font-size: 18px;
      margin-bottom: 20px;
      background: #fff3cd;
      padding: 10px;
      border-radius: 10px;
      max-width: 700px;
      margin: 0 auto 20px;
      border: 1px solid #ffeeba;
    }

    .items {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-bottom: 30px;
    }

    .item {
      width: 100px;
      height: 100px;
      border: 2px dashed #442828;
      padding: 5px;
      border-radius: 10px;
      background-color: #2f2222;
    }

    .item img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      cursor: grab;
    }

    #bag {
      width: 200px;
      height: 200px;
      margin: 0 auto;
      border: 4px dashed #4caf50;
      border-radius: 20px;
      background-color: #e0f7fa;
      position: relative;
      overflow: hidden;
    }

    #bag img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0.6;
      z-index: 0;
      pointer-events: none;
    }

    .dropped {
      position: absolute;
      width: 50px;
      height: 50px;
      z-index: 1;
    }

    .success {
      margin-top: 20px;
      color: rgb(4, 16, 4);
      font-weight: bold;
      display: none;
    }
  </style>
</head>
<body>

  <h1>What's in My School Bag?</h1>
  <div class="instructions">
    Look at the pictures. Choose the items that belong in a school bag.<br>
    Drag and drop them inside the school bag image. Leave out the items that don’t belong.
  </div>

  <div class="items">
    <div class="item" draggable="true" id="pencil" data-correct="true">
      <img src="pencil.png" alt="Pencil">
    </div>
    <div class="item" draggable="true" id="crayons" data-correct="true">
      <img src="crayons.jpeg" alt="Crayons">
    </div>
    <div class="item" draggable="true" id="notebook" data-correct="true">
      <img src="paper.jpeg" alt="Notebook">
    </div>
    <div class="item" draggable="true" id="remote" data-correct="false">
      <img src="remote.jpeg" alt="Remote">
    </div>
    <div class="item" draggable="true" id="candy" data-correct="false">
      <img src="toys.jpeg" alt="Toys">
    </div>
  </div>

  <div id="bag">
    <img src="BAAG.jpeg" alt="School Bag Background">
  </div>

  <div class="success" id="successMessage">🎒 Great! You packed the school bag correctly!</div>

  <a href="learning_games.php" style="display: inline-block; margin: 10px; font-size: 18px; text-decoration: none; background-color: #ffcc00; padding: 10px 20px; border-radius: 10px; color: black; font-weight: bold;">⬅ Back</a>

  <script>
    let correctCount = 0;
    const totalCorrectItems = 3;

    function allowDrop(ev) {
      ev.preventDefault();
    }

    function dropItem(ev) {
      ev.preventDefault();
      const itemId = ev.dataTransfer.getData("text");
      const item = document.getElementById(itemId);

      if (!item || item.classList.contains("dropped")) return;

      if (isItemCorrect(item)) {
        placeItemInBag(item);
        correctCount++;

        if (correctCount === totalCorrectItems) {
          showSuccessMessage();
        }
      } else {
        alert("❌ That doesn't belong in a school bag!");
      }
    }

    function isItemCorrect(item) {
      return item.dataset.correct === "true";
    }

    function placeItemInBag(item) {
      const bag = document.getElementById("bag");
      item.classList.add("dropped");
      item.style.display = "block";
      item.style.position = "absolute";
      item.style.width = "50px";
      item.style.height = "50px";
      item.style.top = `${Math.random() * 140}px`;
      item.style.left = `${Math.random() * 140}px`;
      item.style.zIndex = "1";
      bag.appendChild(item);
    }

    function showSuccessMessage() {
      document.getElementById("successMessage").style.display = "block";
    }

    document.querySelectorAll('.item').forEach(item => {
      item.addEventListener("dragstart", ev => {
        ev.dataTransfer.setData("text", item.id);
      });
    });

    document.getElementById("bag").addEventListener("drop", dropItem);
    document.getElementById("bag").addEventListener("dragover", allowDrop);
  </script>

</body>
</html>
