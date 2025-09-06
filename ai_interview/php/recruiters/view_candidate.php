<?php include '../includes/header.php';
if (empty($_SESSION['user_id']) || $_SESSION['role'] !== 'recruiter') { echo '<div class="alert alert-warning">Recruiter access only.</div>'; include '../includes/footer.php'; exit; }
$uid = intval($_GET['id'] ?? 0);
$stmt = $conn->prepare('SELECT u.username, u.email, i.* FROM users u LEFT JOIN interviews i ON i.user_id = u.id WHERE u.id = ? ORDER BY i.finished_at DESC LIMIT 1');
$stmt->bind_param('i',$uid); $stmt->execute(); $data = $stmt->get_result()->fetch_assoc(); $stmt->close();
if (!$data) { echo '<div class="alert alert-warning">Candidate not found.</div>'; include '../includes/footer.php'; exit; }
$ans = $conn->prepare('SELECT a.*, q.question_text FROM answers a JOIN questions q ON q.id=a.question_id WHERE a.interview_id = ?');
$ans->bind_param('i', $data['id']); $ans->execute(); $answers = $ans->get_result();
?>
<h3>Candidate: <?= htmlspecialchars($data['username']) ?></h3>
<p>Email: <?= htmlspecialchars($data['email']) ?></p>
<p>Last interview score: <?= intval($data['score']) ?></p>
<div class="list-group">
<?php while ($r = $answers->fetch_assoc()): ?>
  <div class="list-group-item">
    <div><strong>Q:</strong> <?= nl2br(htmlspecialchars($r['question_text'])) ?></div>
    <div><strong>A:</strong> <?= nl2br(htmlspecialchars($r['answer_text'])) ?></div>
    <div><strong>Score:</strong> <?= intval($r['score']) ?></div>
  </div>
<?php endwhile; ?>
</div>
<?php include '../includes/footer.php'; ?>