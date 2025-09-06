<?php include '../includes/header.php';
if (empty($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') { echo '<div class="alert alert-warning">Admin only.</div>'; include '../includes/footer.php'; exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['question_text'])) {
    $qt = $conn->real_escape_string($_POST['question_text']);
    $conn->query("INSERT INTO questions (question_text) VALUES ('".$qt."')");
    echo '<div class="alert alert-success">Question added.</div>';
}
$res = $conn->query('SELECT * FROM questions ORDER BY created_at DESC');
?>
<h3>Questions</h3>
<form method="post" class="mb-3"><textarea class="form-control mb-2" name="question_text" rows="3" placeholder="Enter question"></textarea><button class="btn btn-primary">Add Question</button></form>
<table class="table"><tr><th>ID</th><th>Question</th><th>Created</th></tr>
<?php while ($r = $res->fetch_assoc()): ?>
<tr><td><?= intval($r['id']) ?></td><td><?= nl2br(htmlspecialchars($r['question_text'])) ?></td><td><?= htmlspecialchars($r['created_at']) ?></td></tr>
<?php endwhile; ?>
</table>
<?php include '../includes/footer.php'; ?>