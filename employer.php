<?php
session_start();
require_once 'header.php';
require_once 'config.php';

// Ensure employer is logged in
if (!isset($_SESSION['empolyee'])) {
    header("Location: login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

$emp = $_SESSION['empolyee'];
$empEmail = $emp['Email'];

$error = '';
$success = '';

// Handle job submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $company = $_POST['company'] ?? '';
    $location = $_POST['location'] ?? '';
    $sector = $_POST['sector'] ?? '';
    $description = $_POST['description'] ?? '';

    if (!$title || !$company || !$location || !$description) {
        $error = "Please fill in all required fields.";
    } else {
        $stmt = $conn->prepare("
            INSERT INTO jobs (title, company, location, sector, description, employer_email)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        if ($stmt->execute([$title, $company, $location, $sector, $description, $empEmail])) {
            $success = "Job posted successfully!";
        } else {
            $error = "Failed to post job.";
        }
    }
}

// Fetch jobs posted by this employer (by email)
$stmt = $conn->prepare("SELECT * FROM jobs WHERE employer_email = ? ORDER BY id DESC");
$stmt->execute([$empEmail]);
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Step 1: Fetch job IDs
$jobIds = array_column($jobs, 'id');

// Step 2: Fetch applications grouped by job_id
$applications = [];
$appsByJob = [];

if (!empty($jobIds)) {
    $placeholders = implode(',', array_fill(0, count($jobIds), '?'));
    $appStmt = $conn->prepare("SELECT * FROM applicants WHERE id IN ($placeholders)");
    $appStmt->execute($jobIds);
    $applications = $appStmt->fetchAll(PDO::FETCH_ASSOC);

    // Group applications by job_id
    foreach ($applications as $app) {
        $appsByJob[$app['job_id']][] = $app;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employer Dashboard</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        h2 {
            color: #004080;
        }
        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        form button {
            background: #004080;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }
        form button:hover {
            background: #005fa3;
        }
        .job-listing {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }
        .job-listing h3 {
            margin: 0;
            color: #004080;
        }
        .job-listing small {
            color: gray;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
        .job-listing ul {
            padding-left: 20px;
        }
        .job-listing ul li {
            margin-bottom: 10px;
            background: #f9f9f9;
            padding: 10px;
            border-left: 3px solid #004080;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Post a New Job</h2>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="title" placeholder="Job Title" required>
        <input type="text" name="company" placeholder="Company Name" required>
        <input type="text" name="location" placeholder="Location" required>
        <input type="text" name="sector" placeholder="Sector (Optional)">
        <textarea name="description" placeholder="Job Description" required></textarea>
        <button type="submit">Post Job</button>
    </form>

    <hr>

    <h2>Your Posted Jobs</h2>
    <?php if ($jobs): ?>
        <?php foreach ($jobs as $job): ?>
            <div class="job-listing">
                <h3><?= htmlspecialchars($job['title']) ?></h3>
                <p><strong>Company:</strong> <?= htmlspecialchars($job['company']) ?></p>
                <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?> |
                   <strong>Sector:</strong> <?= htmlspecialchars($job['sector']) ?></p>
                <p><?= nl2br(htmlspecialchars(substr($job['description'], 0, 200))) ?>...</p>

                <?php if (!empty($appsByJob[$job['id']])): ?>
                    <h4>Applicants:</h4>
                    <ul>
                        <?php foreach ($appsByJob[$job['id']] as $app): ?>
                            <li>
                                <strong><?= htmlspecialchars($app['name']) ?></strong>
                                (<?= htmlspecialchars($app['email']) ?>) <br>
                                <em>Applied on <?= date('M d, Y', strtotime($app['applied_at'] ?? 'now')) ?></em><br>
                                <?= nl2br(htmlspecialchars(substr($app['cover_letter'], 0, 150))) ?>...
                                <?php if (!empty($app['resume_path'])): ?>
                                    <br><a href="<?= htmlspecialchars($app['resume_path']) ?>" target="_blank">View Resume</a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p><em>No applicants yet for this job.</em></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You haven’t posted any jobs yet.</p>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
