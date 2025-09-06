<?php include '../includes/header.php';
if (empty($_SESSION['user_id']) || $_SESSION['role'] !== 'recruiter') { echo '<div class="alert alert-warning">Recruiter access only.</div>'; include '../includes/footer.php'; exit; }
// list candidates and latest interview score
$q = 'SELECT u.id as uid, u.username, u.email, i.id as iid, i.score, i.finished_at FROM users u LEFT JOIN interviews i ON i.user_id = u.id GROUP BY u.id ORDER BY i.finished_at DESC';
$res = $conn->query($q);
?>
<h3>Recruiter Dashboard</h3>
<table class="table"><tr><th>Candidate</th><th>Email</th><th>Last Interview Score</th><th>View</th></tr>
<?php while ($r = $res->fetch_assoc()): ?>
<tr>
  <td><?= htmlspecialchars($r['username']) ?></td>
  <td><?= htmlspecialchars($r['email']) ?></td>
  <td><?= intval($r['score']) ?></td>
  <td><?php if ($r['iid']): ?><a class="btn btn-sm btn-primary" href="/php/recruiters/view_candidate.php?id=<?= intval($r['uid']) ?>">View</a><?php endif; ?></td>
</tr>
<?php endwhile; ?>
</table>
<?php include '../includes/footer.php'; ?>