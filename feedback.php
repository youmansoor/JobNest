<?php
require_once 'config.php'; // Include DB connection

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $feedback = trim($_POST["message"]);

    if ($name && $email && $feedback) {
        try {
            $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$feedback')");
            $stmt->execute();
            $message = '<p class="message success">Thank you for your feedback!</p>';
        } catch (PDOException $e) {
            $message = '<p class="message error">Error saving feedback: ' . $e->getMessage() . '</p>';
        }
    } else {
        $message = '<p class="message error">Please fill in all fields.</p>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Feedback - JobNest</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f4f6f8;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(90deg, #004080, #007acc);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
        }

        .btn {
            background: white;
            color: #004080;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn:hover {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .feedback-box {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 0 15px rgba(0, 98, 255, 0.1);
            animation: fadeIn 0.5s ease forwards;
        }

        .feedback-box h2 {
            text-align: center;
            color: #004080;
            margin-bottom: 25px;
        }

        .feedback-box input,
        .feedback-box textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .feedback-box textarea {
            resize: vertical;
            min-height: 100px;
        }

        .feedback-box input:focus,
        .feedback-box textarea:focus {
            outline: none;
            border-color: #007acc;
            box-shadow: 0 0 8px rgba(0, 122, 204, 0.2);
        }

        .feedback-box button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #004080, #007acc);
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        .feedback-box button:hover {
            background: linear-gradient(to right, #003366, #005fa3);
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }

        footer {
            background-color: #004080;
            text-align: center;
            padding: 15px;
            color: #fff;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .container {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .feedback-box {
                margin: 0 10px;
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <div class="logo"><i class="fas fa-briefcase"></i> JobNest</div>
        <a href="index.php" class="btn">Back to Home</a>
    </div>
</header>

<main>
    <div class="feedback-box">
        <h2>Send Us Feedback</h2>

        <?= $message ?>

        <form method="POST" action="feedback.php">
            <label for="name">Your Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Your Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="feedback">Your Feedback:</label>
            <textarea name="message" id="feedback" required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</main>

<footer>
    &copy; <?= date('Y') ?> JobNest. All rights reserved.
</footer>

</body>
</html>