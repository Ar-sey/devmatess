    <?php
    session_start();
    // Optional: Check if the user is logged in
    // if (!isset($_SESSION['user_id'])) {
    //   header("Location: login.php");
    //   exit();
    // }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>My Daily Routine: What Comes First?</title>
    <link rel="stylesheet" href="devmate.css">
    <style>
        body {
        margin: 0;
    padding: 0;
    font-family: 'Comic Sans MS', cursive, sans-serif;
    background: linear-gradient(to bottom right, #7b2ff7, #f107a3);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
        }

        h1 {
        text-align: center;
        color: #2c3e50;
        font-size: 36px;
        margin-bottom: 10px;
        text-shadow: 1px 1px 3px #fff;
        }

        .instructions {
        max-width: 800px;
        margin: 0 auto 30px auto;
        background: #fff8e1;
        padding: 20px;
        border: 2px dashed #f39c12;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        font-size: 18px;
        }

        .grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        }

        .item {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        width: 180px;
        transition: transform 0.3s ease;
        }

        .item:hover {
        transform: translateY(-5px);
        }

        .item img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-bottom: 2px solid #f8b500;
        }

        .item input {
        width: 60px;
        margin: 15px auto 20px auto;
        font-size: 18px;
        text-align: center;
        display: block;
        padding: 6px;
        border: 2px solid #f8b500;
        border-radius: 8px;
        background: #fffef5;
        transition: 0.3s;
        }

        .item input:focus {
        outline: none;
        border-color: #e67e22;
        background-color: #fff3d1;
        }
    </style>
    </head>
    <body>

    <h1>My Daily Routine: What Comes First?</h1>
    <a href="learning_games.php" style="display: inline-block; margin: 10px; font-size: 18px; text-decoration: none; background-color:rgb(247, 246, 244); padding: 10px 20px; border-radius: 10px; color: black; font-weight: bold;">⬅ Back</a>

    <div class="instructions">
        <p>Look at each picture that shows part of your day. Think about what you do first, next, and last. Write a number (1, 2, 3...) to show the correct order of your daily routine. Take your time and ask for help if you need it!</p>
    </div>

    <div class="grid">
        <?php
        $activities = [
        ["packing.jpeg", "Packing backpack"],
        ["up.jpg", "Waking up"],
        ["brush.jpeg", "Brushing teeth"],
        ["dress.jpeg", "Getting dressed"],
        ["making.jpeg", "Making bed"],
        ["school.jpeg", "Going to school"],
        ["classroom.jpeg", "In classroom"],
        ["breakfast.jpeg", "Eating breakfast"],
        ["bath.jpeg", "Taking a bath"],
        ];

        foreach ($activities as $activity) {
        echo '<div class="item">';
        echo '<img src="' . $activity[0] . '" alt="' . $activity[1] . '">';
        echo '<input type="text" placeholder="#">';
        echo '</div>';
        }
        ?>
    </div>

    </body>
    </html>
