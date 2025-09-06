<?php include '../includes/header.php';
if (empty($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') { echo '<div class="alert alert-warning">Admin only.</div>'; include '../includes/footer.php'; exit; }
?>
<h3>Admin Dashboard</h3>
<ul>
  <li><a href="manage_users.php">Manage Users</a></li>
  <li><a href="manage_questions.php">Manage Questions</a></li>
</ul>
<?php include '../includes/footer.php'; ?>