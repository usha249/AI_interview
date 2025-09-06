<?php include '../includes/header.php';
if (empty($_SESSION['interview']) || $_SESSION['role'] !== 'candidate') { echo '<div class="alert alert-warning">No interview found.</div>'; include '../includes/footer.php'; exit; }
$iv = $_SESSION['interview']; $iid = $iv['id'];
// fetch interview and answers
$stmt = $conn->prepare('SELECT * FROM interviews WHERE id = ?'); $stmt->bind_param('i',$iid); $stmt->execute(); $interview = $stmt->get_result()->fetch_assoc(); $stmt->close();
$ans = $conn->prepare('SELECT a.*, q.question_text FROM answers a JOIN questions q ON a.question_id=q.id WHERE a.interview_id=?');
$ans->bind_param('i',$iid); $ans->execute(); $res = $ans->get_result();
?>
<h3>Interview Results</h3>
<p><strong>Total score:</strong> <?= intval($interview['score']) ?></p>
<div class="list-group">
<?php while ($r = $res->fetch_assoc()): ?>
  <div class="list-group-item">
    <div><strong>Q:</strong> <?= nl2br(htmlspecialchars($r['question_text'])) ?></div>
    <div><strong>Your answer:</strong> <?= nl2br(htmlspecialchars($r['answer_text'])) ?></div>
    <div><strong>Score:</strong> <?= intval($r['score']) ?></div>
  </div>
<?php endwhile; ?>
</div>
<?php
// clear interview session
unset($_SESSION['interview']);
include '../includes/footer.php'; ?>