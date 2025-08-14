<?php
include 'config.php';
require_once 'adminheader.php';

$stmtApps = $conn->query("SELECT * FROM applications");
$applicants = $stmtApps->fetchAll();
?>

<div class="main-content" style="margin-left:10; padding: 10px;">
  <h2 class="mb-4"><i class="fas fa-file-alt me-2"></i> Applicants</h2>

  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th><th>Name</th><th>Email</th><th>Cover Letter</th><th>Resume</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($applicants as $app): ?>
        <tr>
          <td><?= htmlspecialchars($app['id']) ?></td>
          <td><?= htmlspecialchars($app['name']) ?></td>
          <td><?= htmlspecialchars($app['email']) ?></td>
          <td><?= nl2br(htmlspecialchars($app['cover_letter'])) ?></td>
          <td>
            <?php if (!empty($app['resume_path']) && file_exists($app['resume_path'])): ?>
              <a href="<?= htmlspecialchars($app['resume_path']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">View Resume</a>
            <?php else: ?>
              <span class="text-muted">No Resume</span>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'adminfooter.php';?>