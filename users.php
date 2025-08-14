<?php
require_once 'adminheader.php';

// Fetch users data
$stmtUsers = $conn->query("SELECT * FROM users");
$users = $stmtUsers->fetchAll();
?>

<!-- Main Content Area -->
<div class="main-content" style="margin-left:10; padding: 10px;">
  <h2 class="mb-4"><i class="fas fa-users me-2"></i> Users</h2>

  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
          <td><?= htmlspecialchars($user['id']) ?></td>
          <td><?= htmlspecialchars($user['Name']) ?></td>
          <td><?= htmlspecialchars($user['Email']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'adminfooter.php';?>