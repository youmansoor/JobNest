<?php
require_once 'adminheader.php';

$stmtJobs = $conn->query("SELECT * FROM jobs");
$jobs = $stmtJobs->fetchAll();
?>

<div class="main-content" style="margin-left:10; padding: 10px;">
  <h2 class="mb-4"><i class="fas fa-briefcase me-2"></i> Job Listings</h2>

  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th><th>Employer Email</th><th>Title</th><th>Company</th><th>Location</th><th>Sector</th><th>Description</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($jobs as $job): ?>
        <tr>
          <td><?= htmlspecialchars($job['id']) ?></td>
          <td><?= htmlspecialchars($job['employer_email']) ?></td>
          <td><?= htmlspecialchars($job['title']) ?></td>
          <td><?= htmlspecialchars($job['company']) ?></td>
          <td><?= htmlspecialchars($job['location']) ?></td>
          <td><?= htmlspecialchars($job['sector']) ?></td>
          <td><?= nl2br(htmlspecialchars($job['description'])) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'adminfooter.php';?>