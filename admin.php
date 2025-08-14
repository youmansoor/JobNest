<?php
session_start();
require_once 'config.php';

// Optional: Admin-only access check
// if (!isset($_SESSION['admin']) || $_SESSION['admin']['Email'] !== 'admin@gmail.com') {
//     header("Location: login.php");
//     exit;
// }

// Fetch stats
$usersCount = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
$employersCount = $conn->query("SELECT COUNT(*) FROM empolyee")->fetchColumn();
$jobsCount = $conn->query("SELECT COUNT(*) FROM jobs")->fetchColumn();
$applicantsCount = $conn->query("SELECT COUNT(*) FROM applications")->fetchColumn();
$overallProgress = round(($usersCount + $employersCount + $jobsCount + $applicantsCount) / 200 * 100);

// Session display variables
$user = $_SESSION['user'] ?? $_SESSION['empolyee'] ?? null;
$name = htmlspecialchars($user['Name'] ?? 'Admin');
$email = htmlspecialchars($user['Email'] ?? 'admin@gmail.com');
$role = 'Admin';
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
      background-color: #f4f6f8;
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
      padding: 20px 30px;
      margin-left: 220px;
      position: sticky;
      top: 0;
      z-index: 999;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
    }

    .auth-buttons {
      display: flex;
      align-items: center;
    }

    .user-menu {
      position: relative;
    }

    .user-name {
      background: transparent;
      border: none;
      color: white;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .dropdown {
      display: none;
      position: absolute;
      background: white;
      color: black;
      right: 0;
      top: 35px;
      border-radius: 6px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      min-width: 220px;
      padding: 15px;
      z-index: 100;
    }

    .dropdown p {
      margin: 5px 0;
      font-size: 14px;
    }

    .dropdown a {
      display: block;
      text-align: center;
      margin-top: 10px;
      text-decoration: none;
      padding: 8px 10px;
      border: 1px solid #004080;
      border-radius: 5px;
      font-weight: bold;
      color: #004080;
    }

    .dropdown a:hover {
      background: #004080;
      color: white;
    }

    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .progress {
      height: 25px;
      border-radius: 20px;
    }

    .progress-bar {
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }

      .content,
      header {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4><i class="fas fa-user-shield"></i> Admin Panel</h4>
  <a href="admin.php" class="active"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
  <a href="users.php"><i class="fas fa-users me-2"></i> Users</a>
  <a href="employers.php"><i class="fas fa-building me-2"></i> Employers</a>
  <a href="job.php"><i class="fas fa-briefcase me-2"></i> Jobs</a>
  <a href="applicants.php"><i class="fas fa-file-alt me-2"></i> Applicants</a>
  <a href="feedback.php"><i class="fas fa-comments me-2"></i> Feedback</a>

  <a href="logout.php" class="text-danger mt-3"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
  
</div>

<!-- Header -->
<header>
  <div class="logo"><i class="fas fa-briefcase"></i> JobNest Admin</div>
  <div class="auth-buttons">
    <?php if (!empty($user)): ?>
      <div class="user-menu" id="user-menu">
        <button class="user-name" id="user-name-btn">
          <?= $name ?> <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown" id="user-dropdown">
          <p><strong>Email:</strong> <?= $email ?></p>
          <p><strong>Role:</strong> <?= $role ?></p>
          <a href="logout.php" id="logout-btn">Logout</a>
        </div>
      </div>
    <?php endif; ?>
  </div>
</header>

<!-- Main Content -->
<div class="content">
  <h2 class="mb-4">Dashboard Overview</h2>

  <div class="row g-4 mb-5">
    <div class="col-md-3">
      <div class="card bg-primary text-white p-4">
        <h6>Total Users</h6>
        <h3><?= $usersCount ?></h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-success text-white p-4">
        <h6>Total Employers</h6>
        <h3><?= $employersCount ?></h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-info text-white p-4">
        <h6>Available Jobs</h6>
        <h3><?= $jobsCount ?></h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-warning text-white p-4">
        <h6>Applicants</h6>
        <h3><?= $applicantsCount ?></h3>
      </div>
    </div>
  </div>

  <h5 class="mb-3">Overall Site Progress</h5>
  <div class="progress">
    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $overallProgress ?>%;" aria-valuenow="<?= $overallProgress ?>" aria-valuemin="0" aria-valuemax="100">
      <?= $overallProgress ?>%
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const userNameBtn = document.getElementById('user-name-btn');
    const dropdown = document.getElementById('user-dropdown');

    if (userNameBtn) {
      userNameBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      });

      document.addEventListener('click', function () {
        dropdown.style.display = 'none';
      });
    }
  });
</script>
</body>
</html>