<?php include '../includes/header.php';
if (empty($_SESSION['interview']) || $_SESSION['role'] !== 'candidate') { echo '<div class="alert alert-warning">No interview in progress.</div>'; include '../includes/footer.php'; exit; }
$iv = &$_SESSION['interview'];
$pos = $iv['pos']; $q_ids = $iv['q_ids'];
if ($pos >= count($q_ids)) { header('Location: /php/candidates/results.php'); exit; }
$quid = intval($q_ids[$pos]);
$stmt = $conn->prepare('SELECT * FROM questions WHERE id = ?'); $stmt->bind_param('i',$quid); $stmt->execute(); $question = $stmt->get_result()->fetch_assoc(); $stmt->close();
?>
<h3>Question <?= $pos+1 ?> of <?= count($q_ids) ?></h3>
<div class="card mb-3"><div class="card-body"><?= nl2br(htmlspecialchars($question['question_text'])) ?></div></div>
<form method="post" action="submit_answer.php">
  <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
  <div class="mb-2"><textarea class="form-control" name="answer" rows="6" required></textarea></div>
  <button class="btn btn-primary">Submit Answer</button>
</form>
<?php include '../includes/footer.php'; ?>