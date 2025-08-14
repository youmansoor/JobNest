<?php
session_start();
include 'config.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['Name'] ?? '';
    $email = $_POST['Email'] ?? '';
    $password = $_POST['Password'] ?? '';
    $role = $_POST['Role'] ?? 'user';

    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        $checkUser = $conn->prepare("SELECT id FROM users WHERE Email = ?");
        $checkUser->execute([$email]);
        $checkEmp = $conn->prepare("SELECT id FROM empolyee WHERE Email = ?");
        $checkEmp->execute([$email]);

        if ($checkUser->rowCount() > 0 || $checkEmp->rowCount() > 0) {
            $error = "Email is already registered.";
        } else {
            if ($role === 'user') {
                $stmt = $conn->prepare("INSERT INTO users (Name, Email, Password) VALUES (?, ?, ?)");
            } else {
                $stmt = $conn->prepare("INSERT INTO empolyee (Name, Email, Password) VALUES (?, ?, ?)");
            }

            $success = $stmt->execute([$name, $email, $password]);

            if ($success) {
                $success = "Registration successful. You can now <a href='login.php'>login</a>.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - JobNest</title>
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

        .signup-box {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 10px;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 0 15px rgba(0, 98, 255, 0.1);
            animation: fadeIn 0.5s ease forwards;
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

        .signup-box h2 {
            text-align: center;
            color: #004080;
            margin-bottom: 25px;
        }

        .signup-box input,
        .signup-box select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .signup-box input:focus,
        .signup-box select:focus {
            outline: none;
            border-color: #007acc;
            box-shadow: 0 0 8px rgba(0, 122, 204, 0.2);
        }

        .signup-box input[type="submit"] {
            background: linear-gradient(to right, #004080, #007acc);
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        .signup-box input[type="submit"]:hover {
            background: linear-gradient(to right, #003366, #005fa3);
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }

        footer {
            background-color: #004080;
            text-align: center;
            padding: 15px;
            color: #fff;
            font-size: 14px;
        }

        @media (max-width: 480px) {
            .container {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .signup-box {
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
    <div class="signup-box">
        <h2>Sign Up</h2>

        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php elseif ($success): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>

        <form method="POST" action="signup.php">
            <label>Full Name:</label>
            <input type="text" name="Name" required>

            <label>Email:</label>
            <input type="email" name="Email" required>

            <label>Password:</label>
            <input type="password" name="Password" required>

            <label>Role:</label>
            <select name="Role" required>
                <option value="user">User (Freelancer)</option>
                <option value="empolyee">Employer</option>
            </select>

            <input type="submit" value="Register">
        </form>
    </div>
</main>

<footer>
    &copy; <?= date('Y') ?> JobNest. All rights reserved.
</footer>

</body>
</html>