<?php include '../includes/header.php';
if (empty($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') { echo '<div class="alert alert-warning">Admin only.</div>'; include '../includes/footer.php'; exit; }
$res = $conn->query('SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC');
?>
<h3>Users</h3>
<table class="table"><tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Created</th></tr>
<?php while ($r = $res->fetch_assoc()): ?>
<tr><td><?= intval($r['id']) ?></td><td><?= htmlspecialchars($r['username']) ?></td><td><?= htmlspecialchars($r['email']) ?></td><td><?= htmlspecialchars($r['role']) ?></td><td><?= htmlspecialchars($r['created_at']) ?></td></tr>
<?php endwhile; ?>
</table>
<?php include '../includes/footer.php'; ?>