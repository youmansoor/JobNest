<?php
require_once 'adminheader.php';  // Load sidebar & header

// Retrieve feedback entries
$stmt = $conn->query("SELECT * FROM feedback");
$feedbacks = $stmt->fetchAll();
?>

<div class="main-content" style="margin-left:10; padding: 10px;">
  <h2 class="mb-4"><i class="fas fa-comments me-2"></i> Feedback List</h2>

  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($feedbacks as $fb): ?>
        <tr>
          <td><?= htmlspecialchars($fb['id']) ?></td>
          <td><?= htmlspecialchars($fb['name']) ?></td>
          <td><?= htmlspecialchars($fb['email']) ?></td>
          <td><?= nl2br(htmlspecialchars(substr($fb['message'], 0, 100))) ?>…</td>
          <td><?= htmlspecialchars(date('Y-m-d H:i')) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'adminfooter.php';?>