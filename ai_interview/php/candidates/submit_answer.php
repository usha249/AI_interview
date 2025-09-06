<?php include '../includes/header.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['interview']) || $_SESSION['role']!=='candidate') { header('Location: /php/index.php'); exit; }
$iv = &$_SESSION['interview']; $interview_id = $iv['id']; $uid = $_SESSION['user_id'];
$question_id = intval($_POST['question_id']); $answer = trim($_POST['answer'] ?? '');
// basic keyword scoring: count matching tokens between question and answer
function score_answer($question_text, $answer_text) {
    $qtokens = preg_split('/\W+/', strtolower($question_text));
    $atokens = preg_split('/\W+/', strtolower($answer_text));
    $atokens = array_filter($atokens);
    $score = 0;
    foreach (array_unique($qtokens) as $t) {
        if ($t && in_array($t, $atokens)) $score++;
    }
    return intval($score);
}
$stmt = $conn->prepare('SELECT question_text FROM questions WHERE id = ?'); $stmt->bind_param('i',$question_id); $stmt->execute(); $qtext = $stmt->get_result()->fetch_assoc()['question_text']; $stmt->close();
$sc = score_answer($qtext, $answer);
// save answer
$ins = $conn->prepare('INSERT INTO answers (interview_id,user_id,question_id,answer_text,score) VALUES (?,?,?,?,?)');
$ins->bind_param('iiisi', $interview_id, $uid, $question_id, $answer, $sc); $ins->execute(); $ins->close();
// advance position
$iv['pos']++;
if ($iv['pos'] >= count($iv['q_ids'])) {
    // finalize interview: compute total score and set finished_at
    $res = $conn->prepare('SELECT SUM(score) as s FROM answers WHERE interview_id = ?'); $res->bind_param('i',$interview_id); $res->execute(); $total = $res->get_result()->fetch_assoc()['s']; $res->close();
    $upd = $conn->prepare('UPDATE interviews SET score = ?, finished_at = NOW() WHERE id = ?'); $upd->bind_param('ii', $total, $interview_id); $upd->execute(); $upd->close();
    header('Location: /php/candidates/results.php'); exit;
} else {
    header('Location: /php/candidates/question.php'); exit;
}
?>