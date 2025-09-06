<?php include '../includes/header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = in_array($_POST['role'] ?? 'candidate', ['candidate','recruiter','admin']) ? $_POST['role'] : 'candidate';
    if ($username === '' || $password === '') {
        echo '<div class="alert alert-danger">Username and password required.</div>';
    } else {
        $stmt = $conn->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->bind_param('s', $username); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo '<div class="alert alert-warning">Username already exists.</div>';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $conn->prepare('INSERT INTO users (username,email,password,role) VALUES (?,?,?,?)');
            $ins->bind_param('ssss', $username, $email, $hash, $role);
            if ($ins->execute()) {
                echo '<div class="alert alert-success">Registered. <a href="login.php">Login now</a></div>';
            } else {
                echo '<div class="alert alert-danger">Error: '.htmlspecialchars($conn->error).'</div>';
            }
            $ins->close();
        }
        $stmt->close();
    }
}
?>
<h3>Register</h3>
<form method="post" class="mb-4">
  <div class="mb-2"><input class="form-control" name="username" placeholder="Username" required></div>
  <div class="mb-2"><input class="form-control" name="email" placeholder="Email (optional)" type="email"></div>
  <div class="mb-2"><input class="form-control" name="password" placeholder="Password" type="password" required></div>
  <div class="mb-2">
    <select name="role" class="form-control">
      <option value="candidate">Candidate</option>
      <option value="recruiter">Recruiter</option>
      <option value="recruiter">admin</option>
    </select>
  </div>
  <button class="btn btn-primary" type="submit">Register</button>
</form>
<?php include '../includes/footer.php'; ?>