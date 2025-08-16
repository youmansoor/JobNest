<?php
session_start();
require_once 'header.php';  // Includes session start, user info, and header HTML
require_once 'config.php';  // Your database connection

$jobs = [];

$searchTitle = $_GET['title'] ?? '';
$searchLocation = $_GET['location'] ?? '';
$searchSector = $_GET['sector'] ?? '';

// Build the query dynamically based on filters
$query = "SELECT * FROM jobs WHERE 1=1";
$params = [];

if (!empty($searchTitle)) {
    $query .= " AND title LIKE ?";
    $params[] = '%' . $searchTitle . '%';
}

if (!empty($searchLocation)) {
    $query .= " AND location = ?";
    $params[] = $searchLocation;
}

if (!empty($searchSector)) {
    $query .= " AND sector = ?";
    $params[] = $searchSector;
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Find Jobs - Job Nest</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        /* Your existing CSS styling here */
        /* I’m including your original CSS from your code for completeness */

        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: 'Poppins', sans-serif;
        }

        body {
          background-color: #f4f6f8;
          color: #333;
        }

        .jobboard {
          text-align: center;
          padding: 60px 20px;
          background-color: #ffffff;
        }

        .jobboard h2 {
          font-size: 26px;
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
          margin-top: 20px;
        }

        .search-box input,
        .search-box select {
          padding: 10px;
          width: 200px;
          border: 1px solid #ccc;
          border-radius: 5px;
        }

        .search-box .btn {
          background-color: #007acc;
          color: white;
          padding: 10px 20px;
          border-radius: 5px;
          border: none;
          cursor: pointer;
          font-weight: bold;
        }

        .search-box .btn:hover {
          background-color: #005f99;
        }

        .job-listings {
          max-width: 1100px;
          margin: 40px auto;
          padding: 0 20px;
        }

        .job-listings h2 {
          text-align: center;
          margin-bottom: 30px;
          font-size: 28px;
        }

        .job-grid {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(720px, 1fr));
          gap: 25px;
        }

        .job-card {
          /* width: 80%; */
          background-color: #ffffff;
          border-radius: 8px;
          box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
          padding: 25px;
          transition: transform 0.3s ease;
        }

        .job-card:hover {
          transform: translateY(-5px);
        }

        .job-card h3 {
          font-size: 20px;
          color: #004080;
          margin-bottom: 10px;
        }

        .job-card p {
          font-size: 14px;
          margin: 4px 0;
          color: #555;
        }

        .btn-apply {
          display: inline-block;
          margin-top: 15px;
          background: #004080;
          color: #fff;
          padding: 10px 18px;
          border-radius: 4px;
          text-decoration: none;
          font-weight: bold;
          transition: 0.3s;
        }

        .btn-apply:hover {
          background: #007acc;
        }

        @media (max-width: 768px) {
          .jobboard h2 {
            font-size: 22px;
          }

          .search-box input,
          .search-box select {
            width: 100%;
          }
        }
    </style>
</head>
<body>

<section class="jobboard">
    <h2>Search Between Thousands of Jobs <span>Just for You</span></h2>
    <form method="GET" class="search-box">
        <input type="text" name="title" placeholder="Job Title or Keyword" value="<?php echo $searchTitle; ?>">
        <select name="location">
            <option value="">All Cities</option>
            <option <?= $searchLocation == "Karachi" ? 'selected' : '' ?>>Karachi</option>
            <option <?= $searchLocation == "Lahore" ? 'selected' : '' ?>>Lahore</option>
            <option <?= $searchLocation == "Islamabad" ? 'selected' : '' ?>>Islamabad</option>
        </select>
        <select name="sector">
            <option value="">All Sectors</option>
            <option <?= $searchSector == "Engineering" ? 'selected' : '' ?>>Engineering</option>
            <option <?= $searchSector == "Finance" ? 'selected' : '' ?>>Finance</option>
            <option <?= $searchSector == "Legal" ? 'selected' : '' ?>>Legal</option>
            <option <?= $searchSector == "Manufacturing" ? 'selected' : '' ?>>Manufacturing</option>
        </select>
        <button type="submit" class="btn">Search</button>
    </form>
</section>

<section class="job-listings">
    <h2>Available Jobs</h2>
    <div class="job-grid">
        <?php if (count($jobs) > 0): ?>
            <?php foreach ($jobs as $job): ?>
                <div class="job-card">
                    <h3><?php echo $job['title'];?></h3>
                    <p><strong>Company:</strong> <?php echo $job['company']; ?></p>
                    <p><strong>Location:</strong> <?php echo $job['location']; ?></p>
                    <p><strong>Sector:</strong> <?php echo $job['sector']; ?></p>
                    <p><?php echo $job['description'];?></p>
                    <?php
// For each job card:
$applyUrl = isset($_SESSION['user']) || isset($_SESSION['empolyee']) ? "apply.php?job_id=" . $job['id'] : "login.php";
?>
<a href="<?= $applyUrl ?>" class="btn-apply">Apply Now</a>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center;">No jobs found. Try different filters.</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php';?>

</body>
</html>