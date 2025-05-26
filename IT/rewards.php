<?php
session_start();

// Define 4 routine activities
$routine = [
    "9:00 AM" => "Learning Games",
    "10:00 AM" => "Snack Time",
    "10:30 AM" => "Daily Life Skills",
    "11:00 AM" => "Rewards Check"
];

// Handle task submission
$completed_tasks = [];
$earned_reward = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $completed_tasks = $_POST['completed_tasks'] ?? [];

    if (count($completed_tasks) === count($routine)) {
        $earned_reward = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Routine Tracker</title>
  <style>
    body {
      font-family: 'Comic Sans MS', cursive;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: #333;
      padding: 20px;
    }

    h1 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 30px;
      color: #4a148c;
    }

    .routine-container {
      background: #ffe4ec;
      border-radius: 16px;
      padding: 30px;
      max-width: 500px;
      margin: auto;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    .routine-form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    label {
      background: #fddde6;
      padding: 12px 20px;
      border-radius: 12px;
      font-size: 1.1rem;
      display: flex;
      align-items: center;
      transition: background-color 0.3s ease;
    }

    label:hover {
      background-color: #fbc1d2;
    }

    input[type="checkbox"] {
      margin-right: 10px;
      transform: scale(1.2);
    }

    input[type="submit"] {
      background-color: #6a1b9a;
      color: white;
      padding: 12px;
      font-size: 1.1rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 15px;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #4a148c;
    }

    .completed-message {
      background-color: #e3f2fd;
      border-left: 6px solid #42a5f5;
      margin-top: 30px;
      padding: 15px 20px;
      border-radius: 8px;
      font-size: 1rem;
    }

    .popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0);
      background-color: rgba(255, 255, 255, 0.95);
      border: 5px solid gold;
      border-radius: 20px;
      padding: 40px;
      text-align: center;
      font-size: 2rem;
      z-index: 9999;
      box-shadow: 0 0 30px rgba(0,0,0,0.5);
      transition: transform 0.4s ease;
    }

    .popup.show {
      transform: translate(-50%, -50%) scale(1);
    }

    .popup img {
      width: 100px;
      margin-top: 20px;
    }

    .back-btn {
      display: inline-block;
      background-color: #b2dfdb;
      color: #004d40;
      padding: 10px 20px;
      margin: 10px 0 20px 0;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>

<h1>Your Routine Schedule</h1>

<div class="routine-container">
  <a href="dashboard.php" class="back-btn">⬅ Back to Games</a>

  <form class="routine-form" method="POST" id="routineForm">
    <?php foreach ($routine as $time => $task): ?>
      <label>
        <input type="checkbox" name="completed_tasks[]" value="<?= $time ?>"
          <?php if (in_array($time, $completed_tasks)) echo 'checked'; ?>
          onchange="showStar(this)">
        <?= "$time - $task" ?>
      </label>
    <?php endforeach; ?>

    <input type="submit" value="Submit Completed Tasks">
  </form>

  <?php if (!empty($completed_tasks)): ?>
    <div class="completed-message">
      <strong>Great job!</strong>
      <p>You completed:</p>
      <ul>
        <?php foreach ($completed_tasks as $task): ?>
          <li><?= $routine[$task] ?> at <?= $task ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
</div>

<?php if ($earned_reward): ?>
  <div class="popup show" id="trophyPopup">
    🏆 You did it!<br>
    All activities completed!<br>
    <img src="trophy.jpg" alt="Gold Trophy">
  </div>
<?php endif; ?>

<!-- Star Popup -->
<div class="popup" id="starPopup">
  ⭐ Great job!
</div>

<script>
function showStar(checkbox) {
  if (checkbox.checked) {
    const star = document.getElementById("starPopup");
    star.classList.add("show");
    setTimeout(() => {
      star.classList.remove("show");
    }, 1500);
  }
}

// Optional: show trophy popup with animation on load if all done
window.onload = function () {
  const trophy = document.getElementById("trophyPopup");
  if (trophy) {
    setTimeout(() => {
      trophy.classList.remove("show");
    }, 3000);
  }
}
</script>

</body>
</html>
