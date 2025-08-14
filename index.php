<?php
session_start();
require_once 'config.php';

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$user = null;
$name = '';
$email = '';
$role = '';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $name = $user['Name'];
    $email = $user['Email'];
    $role = 'User';
} elseif (isset($_SESSION['empolyee'])) { // Note: kept the typo as used in login.php
    $user = $_SESSION['empolyee'];
    $name = $user['Name'];
    $email = $user['Email'];
    $role = 'Employer';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Job Nest</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    .hero {
      background: linear-gradient(rgba(0, 64, 128, 0.6), rgba(0, 64, 128, 0.6)),
        url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?fit=crop&w=1600') no-repeat center center/cover;
      color: white;
      text-align: center;
      min-height: 90vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0 20px;
      position: relative;
    }

    .hero-content {
      max-width: 700px;
      animation: fadeInUp 1.2s ease;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .hero-content h2 {
      font-size: 48px;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .hero-content p {
      font-size: 20px;
      margin-bottom: 30px;
    }

    .hero-btn {
      background: #fff;
      color: #004080;
      padding: 14px 30px;
      border-radius: 30px;
      font-weight: bold;
      text-decoration: none;
      transition: 0.3s;
    }

    .hero-btn:hover {
      background-color: #cce6ff;
    }

    .jobboard {
      text-align: center;
      padding: 70px 20px;
      background-color: #fff;
    }

    .jobboard h2 {
      font-size: 28px;
      margin-bottom: 20px;
    }

    .jobboard span {
      color: #007acc;
      font-weight: bold;
    }

    .search-box {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 30px;
    }

    .search-box input,
    .search-box select {
      padding: 12px;
      width: 220px;
      border: 1px solid #ccc;
      border-radius: 5px;
      transition: 0.3s;
    }

    .search-box input:focus,
    .search-box select:focus {
      border-color: #007acc;
      outline: none;
      box-shadow: 0 0 5px rgba(0,122,204,0.3);
    }

    .search-box .btn {
      background-color: #007acc;
      color: white;
      padding: 12px 25px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .search-box .btn:hover {
      background-color: #005f99;
    }

    @media (max-width: 768px) {
      .hero-content h2 {
        font-size: 32px;
      }

      .search-box input,
      .search-box select {
        width: 100%;
      }

      .container {
        flex-direction: column;
        gap: 15px;
        text-align: center;
      }

      .auth-buttons {
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

<?php include 'header.php';?>

  <section class="jobboard">
  <h2>Search Between More Than <span>50,000</span> Open Jobs.</h2>
  <form method="GET" action="jobs.php" class="search-box">
    <input type="text" name="title" placeholder="Job Title, Keywords, or Phrase" />
    <select name="location">
      <option value="">Select City</option>
      <option>Karachi</option>
      <option>Lahore</option>
      <option>Islamabad</option>
    </select>
    <select name="sector">
      <option value="">Select Sector</option>
      <option>Manufacturing</option>
      <option>Legal</option>
      <option>Engineering</option>
      <option>Finance</option>
    </select>
    <button type="submit" class="btn"><i class="fas fa-search"></i> Find Job</button>
  </form>
</section>

  <section class="hero">
    <div class="hero-content">
      <h2>Connecting Talent With Opportunity</h2>
      <p>Your journey to a better career starts here.</p>
      <a href="jobs.php" class="hero-btn"><i class="fas fa-rocket"></i> Browse Jobs</a>
    </div>
  </section>

  <?php include 'footer.php';?>

</body>
</html>