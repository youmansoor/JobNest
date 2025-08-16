<?php
session_start();
require_once 'header.php';
require_once 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['user']) && !isset($_SESSION['empolyee'])) {
    header("Location: login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

$user = $_SESSION['user'] ?? $_SESSION['empolyee'];
$name = $user['Name'];
$email = $user['Email'];

$jobId = $_GET['job_id'] ?? null;

if (!$jobId) {
    echo "Invalid job ID.";
    exit;
}

// Fetch job
$stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ?");
$stmt->execute([$jobId]);
$job = $stmt->fetch();

if (!$job) {
    echo "Job not found.";
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['cover_letter'] ?? '';
    $resumePath = '';

    // Handle resume upload
    if (isset($_FILES['resume_path']) && $_FILES['resume_path']['error'] === UPLOAD_ERR_OK) {
        $allowedExtensions = ['pdf', 'doc', 'docx'];
        $ext = pathinfo($_FILES['resume_path']['name'], PATHINFO_EXTENSION);

        if (in_array(strtolower($ext), $allowedExtensions)) {
            // Create directory if not exists
            if (!is_dir('resumes')) {
                mkdir('resumes', 0777, true);
            }

            $resumeName = 'resume_' . time() . '_' . basename($_FILES['resume_path']['name']);
            $resumePath = 'resumes/' . $resumeName;

            if (!move_uploaded_file($_FILES['resume_path']['tmp_name'], $resumePath)) {
                $error = "Failed to upload resume.";
            }
        } else {
            $error = "Only PDF, DOC, and DOCX files are allowed.";
        }
    } else {
        $error = "Please upload a resume.";
    }

    // Save application if no errors
    if (empty($error)) {
        $applyStmt = $conn->prepare("
            INSERT INTO applicants (name, email, cover_letter, resume_path)
            VALUES ('$name', '$email', '$message', '$resumePath')
        ");
        if ($applyStmt->execute()) {
            $success = "Application submitted successfully!";
        } else {
            $error = "Failed to submit application.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply for <?php echo $job['title'] ;?></title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        h2, h3 {
            color: #004080;
        }
        .job-details p {
            margin-bottom: 15px;
            color: #555;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 20px;
        }
        textarea, input[type="file"] {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 8px;
        }
        .btn {
            background: #004080;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .btn:hover {
            background: #005fa3;
        }
        .error, .success {
            font-size: 15px;
            margin-top: 15px;
        }
        .error { color: #cc0000; }
        .success { color: #007a3d; }
    </style>
</head>
<body>

<div class="container">
    <h2>Apply for Job</h2>
    <div class="job-details">
        <h3><?php echo $job['title']; ?></h3>
        <p><strong>Company:</strong> <?php echo $job['company']; ?></p>
        <p><strong>Location:</strong> <?php echo $job['location']; ?></p>
        <p><strong>Sector:</strong> <?php echo $job['sector']; ?></p>
        <p><?php echo $job['description'];?></p>
    </div>

    <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
    <?php elseif ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
    <label for="message">Why are you a good fit?</label>
    <textarea name="cover_letter" id="message" required></textarea>

    <label for="resume">Upload Resume (PDF, DOC, DOCX):</label>
    <input type="file" name="resume_path" id="resume" accept=".pdf,.doc,.docx" required>

    <button type="submit" class="btn">Submit Application</button>
</form>

</div>

<?php include 'footer.php';?>
</body>
</html>