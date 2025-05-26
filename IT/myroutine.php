<?php
session_start();

// Only 4 activities, as in the uploaded image
$routine = [
    "9:00 AM" => "Learning Games",
    "10:00 AM" => "Snack Time",
    "10:30 AM" => "Daily Life Skills",
    "11:00 AM" => "Rewards Check"
];

// Handle task submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $completed_tasks = $_POST['completed_tasks'] ?? [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Routine Schedule</title>
  <style>
    body {
      margin: 0;
      font-family: 'Comic Sans MS', cursive;
      background: linear-gradient(to bottom right, #7b2ff7, #f107a3);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
    }
    h1 {
      color:rgb(54, 12, 45);
      font-size: 2.2rem;
      margin-bottom: 30px;
    }
    .routine-list {
      display: flex;
      flex-direction: column;
      gap: 15px;
      width: 100%;
      max-width: 400px;
    }
    .routine-item {
      background-color: #ffe0e5;
      padding: 15px 20px;
      border-radius: 12px;
      font-size: 1.2rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      text-align: left;
    }
    .completed-message {
      margin-top: 30px;
      background-color: #e0ffe3;
      padding: 15px;
      border-radius: 10px;
      font-size: 1.1rem;
      color: #33691e;
    }
  </style>
</head>
<body>

<h1>Your Routine Schedule</h1>

<div class="routine-list">
  <?php foreach ($routine as $time => $activity): ?>
    <div class="routine-item"><?= "$time - $activity" ?></div>
  <?php endforeach; ?>
</div>

<?php if (!empty($completed_tasks)): ?>
  <div class="completed-message">
    <strong>Great job!</strong><br>
    You completed:
    <ul>
      <?php foreach ($completed_tasks as $task): ?>
        <li><?= $routine[$task] ?> at <?= $task ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

</body>
</html>
