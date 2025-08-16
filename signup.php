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
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Sign Up - JobNest</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<style>
  /* Reset & base */
  *, *::before, *::after {
    box-sizing: border-box;
  }
  body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    background: #f4f6f8;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  /* Header */
  header {
    background: linear-gradient(90deg, #004080, #007acc);
    padding: 20px;
    color: white;
    text-align: center;
    font-size: 1.5rem;
    font-weight: 700;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }
  header .btn {
    display: inline-block;
    margin-top: 10px;
    background: white;
    color: #004080;
    padding: 8px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s ease;
  }
  header .btn:hover {
    background: #e6e6e6;
  }

  /* Main form container */
  main {
    flex-grow: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 15px;
  }
  .signup-box {
    background: white;
    padding: 35px 30px;
    max-width: 400px;
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 98, 255, 0.15);
  }
  .signup-box h2 {
    text-align: center;
    color: #004080;
    margin-bottom: 25px;
    font-size: 1.8rem;
  }

  /* Form elements */
  label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #333;
  }
  input[type="text"],
  input[type="email"],
  input[type="password"],
  select {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 20px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
  }
  input[type="text"]:focus,
  input[type="email"]:focus,
  input[type="password"]:focus,
  select:focus {
    outline: none;
    border-color: #007acc;
  }

  input[type="submit"] {
    width: 100%;
    padding: 14px;
    background: linear-gradient(to right, #004080, #007acc);
    border: none;
    border-radius: 6px;
    color: white;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background 0.3s ease;
  }
  input[type="submit"]:hover {
    background: linear-gradient(to right, #003366, #005fa3);
  }

  /* Messages */
  .error, .success {
    text-align: center;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.9rem;
  }
  .error {
    background-color: #f8d7da;
    color: #b00020;
    border: 1px solid #f5c2c7;
  }
  .success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }

  /* Responsive */
  @media (max-width: 480px) {
    .signup-box {
      padding: 25px 20px;
      max-width: 90%;
    }
    input[type="submit"] {
      font-size: 1rem;
      padding: 12px;
    }
    header {
      font-size: 1.25rem;
    }
    header .btn {
      padding: 7px 15px;
      font-size: 0.9rem;
    }
  }
</style>
</head>
<body>

<header>
  <div> <i class="fas fa-briefcase"></i> JobNest </div>
  <a href="index.php" class="btn">Back to Home</a>
</header>

<main>
  <div class="signup-box">
    <h2>Create Account</h2>

    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
      <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" action="signup.php" novalidate>
      <label for="name">Full Name</label>
      <input id="name" type="text" name="Name" required />

      <label for="email">Email</label>
      <input id="email" type="email" name="Email" required />

      <label for="password">Password</label>
      <input id="password" type="password" name="Password" required />

      <label for="role">Role</label>
      <select id="role" name="Role" required>
        <option value="user">User (Freelancer)</option>
        <option value="empolyee">Employer</option>
      </select>

      <input type="submit" value="Register" />
    </form>
  </div>
</main>

<?php include 'footer.php';?>

</body>
</html>