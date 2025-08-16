<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';

$user = null;
$name = '';
$email = '';
$role = 'User'; // Default role

// Promote admin if logged in as user
if (isset($_SESSION['user']) && $_SESSION['user']['Email'] === 'admin@gmail.com') {
    $_SESSION['admin'] = $_SESSION['user'];
}

if (isset($_SESSION['admin'])) {
    $user = $_SESSION['admin'];
    $name = htmlspecialchars($user['Name']);
    $email = htmlspecialchars($user['Email']);
    $role = 'admin';
} elseif (isset($_SESSION['empolyee'])) { // keep typo if consistent
    $user = $_SESSION['empolyee'];
    $name = htmlspecialchars($user['Name']);
    $email = htmlspecialchars($user['Email']);
    $role = 'employer';
} elseif (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $name = htmlspecialchars($user['Name']);
    $email = htmlspecialchars($user['Email']);
    $role = 'user';
}

// Current page
$currentPage = basename($_SERVER['PHP_SELF']);

// Conditional buttons
$showBackToEmployer = ($role === 'employer' && $currentPage === 'index.php');
$showBackToAdmin = ($role === 'admin' && $currentPage === 'index.php');
?>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
  * {
    margin: 0; padding: 0; box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }

  header {
    background: linear-gradient(90deg, #004080, #007acc);
    color: white;
    padding: 20px 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: relative;
    z-index: 10;
  }

  #container {
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

  .logo i {
    font-size: 32px;
  }

  nav ul {
    list-style: none;
    display: flex;
    gap: 25px;
  }

  nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    transition: color 0.3s ease;
  }

  nav ul li a:hover,
  nav ul li a:focus {
    color: #cce4ff;
  }

  nav ul li a.employer-back {
    font-weight: bold;
    color: #cce4ff;
  }

  .auth-buttons {
    display: flex;
    align-items: center;
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
    margin-left: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .btn:hover,
  .btn:focus {
    background: transparent;
    color: white;
    border: 2px solid white;
  }

  .user-menu {
    position: relative;
    display: inline-block;
  }

  .user-name {
    background: transparent;
    border: none;
    color: white;
    font-weight: 700;
    cursor: pointer;
    font-size: 18px;
    padding: 0;
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
    font-size: 14px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .dropdown a:hover,
  .dropdown a:focus {
    background-color: #004080;
    color: white;
  }

  .menu-toggle {
    display: none;
    font-size: 24px;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
  }
  @media (max-width: 768px) {
    .menu-toggle {
      display: block;
    }

    nav {
      width: 100%;
      flex-direction: column;
      display: none;
    }

    nav.active {
      display: flex;
    }

    nav ul {
      flex-direction: column;
      width: 100%;
      gap: 10px;
      padding-top: 10px;
    }

    nav ul li {
      width: 100%;
    }

    nav ul li a {
      display: block;
      width: 100%;
      padding: 10px;
      font-size: 16px;
    }

    .auth-buttons {
      flex-direction: column;
      width: 100%;
      align-items: flex-start;
      gap: 10px;
      margin-top: 10px;
    }
    .dropdown {
    transform: none;
    left: 0;
    right: auto;
    width: max-content;
  }
  }
</style>

<header>
  <div id="container">
    <div class="logo"><i class="fas fa-briefcase"></i> JobNest</div>
    <button class="menu-toggle" id="menu-toggle" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <nav id="nav-menu">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="feedback.php">Feedback</a></li>

        <?php if ($showBackToEmployer): ?>
          <li><a href="employer.php" class="employer-back">Employer Dashboard</a></li>
        <?php endif; ?>

        <?php if ($showBackToAdmin): ?>
          <li><a href="admin.php" class="employer-back">Admin Dashboard</a></li>
        <?php endif; ?>
      </ul>
    </nav>

    <div class="auth-buttons">
      <?php if (!empty($user)): ?>
        <div class="user-menu" id="user-menu">
          <button class="user-name" id="user-name-btn" aria-haspopup="true" aria-expanded="false" aria-controls="user-dropdown">
            <?= $name ?>
            <i class="fas fa-caret-down" aria-hidden="true"></i>
          </button>
          <div class="dropdown" id="user-dropdown" role="menu" aria-hidden="true">
            <p><strong>Email:</strong> <?= $email ?></p>
            <p><strong>Role:</strong> <?= $role ?></p>
            <a href="index.php?logout=1" id="logout-btn" role="menuitem">Logout</a>
          </div>
        </div>
      <?php else: ?>
        <a href="login.php" class="btn"><i class="fas fa-sign-in-alt"></i> Login</a>
        <a href="signup.php" class="btn"><i class="fas fa-user-plus"></i> Signup</a>
      <?php endif; ?>
    </div>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const userNameBtn = document.getElementById('user-name-btn');
    const dropdown = document.getElementById('user-dropdown');
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.getElementById('nav-menu');

    // Toggle user dropdown
    if (userNameBtn && dropdown) {
      userNameBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        const isVisible = dropdown.style.display === 'block';
        dropdown.style.display = isVisible ? 'none' : 'block';
        userNameBtn.setAttribute('aria-expanded', !isVisible);
        dropdown.setAttribute('aria-hidden', isVisible);
      });

      document.addEventListener('click', function () {
        dropdown.style.display = 'none';
        if (userNameBtn) {
          userNameBtn.setAttribute('aria-expanded', 'false');
        }
        if (dropdown) {
          dropdown.setAttribute('aria-hidden', 'true');
        }
      });
    }

    // Toggle navigation on mobile
    if (menuToggle && navMenu) {
      menuToggle.addEventListener('click', function () {
        navMenu.classList.toggle('active');
      });
    }
  });
</script>