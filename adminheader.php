<?php
session_start();
require_once 'config.php';

// Optional admin protection
// if (!isset($_SESSION['admin']) || $_SESSION['admin']['Email'] !== 'admin@gmail.com') {
//     header("Location: login.php");
//     exit;
// }

$user = null;
$name = '';
$email = '';
$role = '';
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $name = htmlspecialchars($user['Name']);
    $email = htmlspecialchars($user['Email']);
    $role = 'User';
} elseif (isset($_SESSION['empolyee'])) {
    $user = $_SESSION['empolyee'];
    $name = htmlspecialchars($user['Name']);
    $email = htmlspecialchars($user['Email']);
    $role = 'Employer';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard - JobNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 220px;
      background-color: #003366;
      color: white;
      padding-top: 30px;
      z-index: 1000;
    }

    .sidebar h4 {
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 15px 20px;
      text-decoration: none;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #0059b3;
    }

    .content {
      margin-left: 220px;
      padding: 30px;
    }

    header {
      background: linear-gradient(90deg, #004080, #007acc);
      color: white;
      padding: 20px 0;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-left: 220px;
      position: sticky;
      top: 0;
      z-index: 999;
    }

    header .container {
      max-width: 1200px;
      margin: auto;
      padding: 0 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .logo {
      font-size: 28px;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .user-menu {
      position: relative;
    }

    .user-name {
      background: transparent;
      border: none;
      color: white;
      font-weight: 700;
      cursor: pointer;
      font-size: 18px;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .dropdown {
      display: none;
      position: absolute;
      background-color: white;
      color: #333;
      min-width: 220px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      padding: 12px 16px;
      border-radius: 6px;
      top: 35px;
      right: 0;
      z-index: 100;
    }

    .dropdown p {
      margin: 6px 0;
      font-size: 14px;
    }

    .dropdown a {
      display: block;
      margin-top: 10px;
      text-decoration: none;
      color: #004080;
      font-weight: bold;
      border: 1px solid #004080;
      padding: 8px 12px;
      border-radius: 5px;
      text-align: center;
    }

    .dropdown a:hover {
      background-color: #004080;
      color: white;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h4><i class="fas fa-user-shield"></i> Admin Panel</h4>
  <a href="admin.php" class="active"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
  <a href="users.php"><i class="fas fa-users me-2"></i> Users</a>
  <a href="employers.php"><i class="fas fa-building me-2"></i> Employers</a>
  <a href="job.php"><i class="fas fa-briefcase me-2"></i> Jobs</a>
  <a href="applicants.php"><i class="fas fa-file-alt me-2"></i> Applicants</a>
  <a href="feedbacks.php"><i class="fas fa-comments me-2"></i> Feedback</a>

  <a href="logout.php" class="text-danger mt-3"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
  
</div>

<header>
  <div class="container">
    <div class="logo"><i class="fas fa-briefcase"></i> JobNest</div>
    <div class="user-menu" id="user-menu">
      <?php if (!empty($user)): ?>
        <button class="user-name" id="user-name-btn">
          <?= $name ?>
          <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown" id="user-dropdown">
          <p><strong>Email:</strong> <?= $email ?></p>
          <p><strong>Role:</strong> <?= $role ?></p>
          <a href="index.php?logout=1">Logout</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header>

<div class="content">