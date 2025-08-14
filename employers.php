<?php
require_once 'adminheader.php';

$stmtEmps = $conn->query("SELECT * FROM empolyee");
$employers = $stmtEmps->fetchAll();
?>

<div class="main-content" style="margin-left:10; padding: 10px;">
  <h2 class="mb-4"><i class="fas fa-building me-2"></i> Employers</h2>

  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr><th>ID</th><th>Name</th><th>Email</th></tr>
      </thead>
      <tbody>
        <?php foreach ($employers as $emp): ?>
        <tr>
          <td><?= htmlspecialchars($emp['id']) ?></td>
          <td><?= htmlspecialchars($emp['Name']) ?></td>
          <td><?= htmlspecialchars($emp['Email']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'adminfooter.php';?>