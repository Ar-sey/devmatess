<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$conn = new mysqli("localhost", "root", "", "devmate_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Fetch all progress records for this user
$stmt = $conn->prepare("SELECT game, status FROM progress WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$progressData = [];
while ($row = $result->fetch_assoc()) {
    $progressData[$row['game']] = $row['status'];
}

$stmt->close();
$conn->close();

// Game list to track
$games = [
    'find_the_color' => "Find the Color",
    'whats_in_bag' => "What's in My School Bag",
    'fruit_sorter' => "Fruit and Vegetable Sorter",
    'mind_quiz' => "Mind Quiz",
    'shape_tracer' => "Shape Tracer",
    'letter_tracer' => "Letter Tracer",
    'number_tracer' => "Number Tracer",
    'daily_routine' => "Daily Routine",
    'color_match' => "Color Matching Game"
];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Game Progress</title>
    <link rel="stylesheet" href="devmate1.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #7b2ff7, #f107a3);
            font-family: 'Comic Sans MS', cursive;
            padding: 20px;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
}
        
        h1 {
            text-align: center;
        }
        .progress-table {
            max-width: 600px;
            margin: auto;
            border-collapse: collapse;
            width: 100%;
        }
        .progress-table th, .progress-table td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: left;
        }
        .progress-table th {
            background-color: #fbc02d;
        }
        .completed {
            color: green;
            font-weight: bold;
        }
        .not-completed {
            color: red;
            font-style: italic;
        }
        .back-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #ffcc00;
            color: black;
            font-weight: bold;
            border-radius: 10px;
            text-decoration: none;
        }
        .back-btn:hover {
            background-color: #ffc107;
        }
    </style>
</head>
<body>

<h1>🎮 My Game Progress</h1>

<table class="progress-table">
    <tr>
        <th>Game</th>
        <th>Status</th>
    </tr>
    <?php foreach ($games as $key => $label): ?>
    <tr>
        <td><?= htmlspecialchars($label) ?></td>
        <td>
            <?php if (isset($progressData[$key]) && $progressData[$key] === 'completed'): ?>
                <span class="completed">✅ Completed</span>
            <?php else: ?>
                <span class="not-completed">❌ Not Completed</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div style="text-align:center;">
    <a class="back-btn" href="dashboard.php">⬅ Back to Dashboard</a>
</div>

</body>
</html>
