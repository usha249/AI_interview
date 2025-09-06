<?php include '../includes/header.php';
if (empty($_SESSION['user_id']) || $_SESSION['role'] !== 'candidates') {
    echo '<div class="alert alert-warning">Only candidates can start an interview. <a href="/php/accounts/login.php">Login</a></div>'; include '../includes/footer.php'; exit;
}
// create interview row
$uid = $_SESSION['user_id'];
$ins = $conn->prepare('INSERT INTO interviews (user_id) VALUES (?)');
$ins->bind_param('i', $uid); $ins->execute();
$interview_id = $ins->insert_id; $ins->close();
// pick 5 random questions
$qres = $conn->query('SELECT id FROM questions ORDER BY RAND() LIMIT 5');
$q_ids = [];
while ($r = $qres->fetch_assoc()) $q_ids[] = $r['id'];
// store in session
$_SESSION['interview'] = ['id'=>$interview_id, 'q_ids'=>$q_ids, 'pos'=>0];
header('Location: /php/./candidates/question.php');
exit; ?>