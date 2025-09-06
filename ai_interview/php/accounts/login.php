<?php include '../includes/header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = $conn->prepare('SELECT id, password, role FROM users WHERE username = ?');
    $stmt->bind_param('s', $username); $stmt->execute(); $res = $stmt->get_result()->fetch_assoc();
    if ($res && password_verify($password, $res['password'])) {
        $_SESSION['user_id'] = $res['id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $res['role'];
        header('Location: /php/index.php'); exit;
    } else {
        echo '<div class="alert alert-danger">Invalid credentials</div>';
    }
    $stmt->close();
}
?>
<h3>Login</h3>
<form method="post" class="mb-4">
  <div class="mb-2"><input class="form-control" name="username" placeholder="Username" required></div>
  <div class="mb-2"><input class="form-control" name="password" placeholder="Password" type="password" required></div>
  <button class="btn btn-success" type="submit">Login</button>
</form>
<?php include '../includes/footer.php'; ?>