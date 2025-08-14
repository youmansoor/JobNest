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
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You haven’t posted any jobs yet.</p>
    <?php endif; ?>
</div>
<?php include 'footer.php';?>
</body>
</html>