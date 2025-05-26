<?php
session_start();

// Redirect to login if not logged in
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
  <title>Fruit and Vegetable Sorter</title>
  <link rel="stylesheet" href="devmate.css">
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    .notification {
      position: fixed;
      top: -100px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #28a745;
      color: white;
      padding: 15px 30px;
      border-radius: 8px;
      font-size: 16px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      transition: top 0.5s ease-in-out;
      z-index: 1000;
    }

    .notification.error {
      background-color: #dc3545;
    }

    .notification.show {
      top: 20px;
    }

    .instructions {
      border: 3px solid #7b7bff;
      background: #eef;
      padding: 20px;
      margin: 20px auto;
      width: 80%;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(123, 123, 255, 0.2);
      font-size: 18px;
      line-height: 1.6;
    }

    #items {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
      margin: 20px;
    }

    .item {
      width: 90px;
      height: 90px;
      object-fit: cover;
      border-radius: 12px;
      box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.1);
      cursor: grab;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .item:hover {
      transform: scale(1.1);
      box-shadow: 4px 6px 12px rgba(0, 0, 0, 0.2);
    }

    .baskets {
      display: flex;
      justify-content: center;
      gap: 80px;
      margin-top: 40px;
      padding-bottom: 40px;
    }

    .basket {
      width: 150px;
      height: 150px;
      border: 3px dashed #aaa;
      border-radius: 16px;
      padding: 8px;
      transition: all 0.3s ease;
      background-color: #fff;
      position: relative;
    }

    .basket:hover {
      box-shadow: 0 0 15px rgba(0, 128, 0, 0.3);
    }

    .basket img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      border-radius: 10px;
    }

    .highlight {
      border-color: #28a745;
      background-color: #d4edda;
      box-shadow: 0 0 15px rgba(40, 167, 69, 0.4);
    }

    .back-button {
      display: inline-block;
      margin: 10px;
      font-size: 18px;
      text-decoration: none;
      background-color: #ffcc00;
      padding: 10px 20px;
      border-radius: 10px;
      color: black;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <a href="learning_games.php" style="display: inline-block; margin: 20px auto; font-size: 18px; text-decoration: none; background-color:rgb(251, 252, 253); padding: 10px 20px; border-radius: 10px; color: black; font-weight: bold;">⬅ Back to Games</a>
  <div class="notification" id="notificationBar"></div>

  <div class="instructions">
    <strong>Instructions:</strong><br>
    Look at the pictures of the fruits and vegetables.<br>
    Place the fruits inside the <span style="color:blue">blue basket</span> and the vegetables inside the <span style="color:red">red basket</span>.<br>
    Take your time and ask for help if you need it!
  </div>

  <div id="items">
    <img src="straw.jpeg" class="item" draggable="true" id="strawberry" data-type="fruit">
    <img src="orange.jpeg" class="item" draggable="true" id="orange" data-type="fruit">
    <img src="grapes.jpeg" class="item" draggable="true" id="grapes" data-type="fruit">
    <img src="carrots.jpeg" class="item" draggable="true" id="carrots" data-type="vegetable">
    <img src="oker.jpeg" class="item" draggable="true" id="oker" data-type="vegetable">
    <img src="bok choy.jpeg" class="item" draggable="true" id="bokchoy" data-type="vegetable">
    <img src="squash.jpeg" class="item" draggable="true" id="squash" data-type="vegetable">
    <img src="cabbage.jpeg" class="item" draggable="true" id="cabbage" data-type="vegetable">
    <img src="melon.jpeg" class="item" draggable="true" id="watermelon" data-type="fruit">
    <img src="red1.jpeg" class="item" draggable="true" id="apple" data-type="fruit">
  </div>

  <div class="baskets">
    <div id="fruitBasket" class="basket" ondragover="allowDrop(event)" ondragleave="removeHighlight(event)" ondrop="drop(event, 'fruit')">
      <img src="blue basket.jpeg" alt="Blue Basket">
    </div>
    <div id="vegetableBasket" class="basket" ondragover="allowDrop(event)" ondragleave="removeHighlight(event)" ondrop="drop(event, 'vegetable')">
      <img src="red basket.jpeg" alt="Red Basket">
    </div>
  </div>

  <script>
    const items = document.querySelectorAll('.item');

    items.forEach(item => {
      item.addEventListener('dragstart', drag);
    });

    function drag(event) {
      event.dataTransfer.setData("text", event.target.id);
    }

    function allowDrop(event) {
      event.preventDefault();
      event.currentTarget.classList.add('highlight');
    }

    function removeHighlight(event) {
      event.currentTarget.classList.remove('highlight');
    }

    function showNotification(message, isError = false) {
      const bar = document.getElementById('notificationBar');
      bar.textContent = message;
      bar.className = 'notification show' + (isError ? ' error' : '');
      setTimeout(() => {
        bar.classList.remove('show');
      }, 2000);
    }

    function drop(event, acceptedType) {
      event.preventDefault();
      const data = event.dataTransfer.getData("text");
      const draggedItem = document.getElementById(data);
      const itemType = draggedItem.dataset.type;

      if (itemType === acceptedType) {
        draggedItem.remove();
        showNotification("✅ Great job! You sorted it correctly.");
      } else {
        showNotification("❌ Oops! That doesn't belong in this basket.", true);
      }

      event.currentTarget.classList.remove('highlight');
    }
  </script>
</body>
</html>
