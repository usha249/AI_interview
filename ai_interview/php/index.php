<?php include 'includes/header.php'; ?>
<div class="p-5 mb-4 bg-white rounded shadow-sm">
  <h1>AI Interview Tool</h1>
  <p class="lead">Practice interviews with AI evaluation. Register as Candidate or Recruiter.</p>
  <?php if (empty($_SESSION['username'])): ?>
    <a class="btn btn-primary" href="/php/accounts/register.php">Get Started</a>
  <?php else: ?>
    <a class="btn btn-primary" href="/php/accounts/logout.php">Logout</a>
  <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>