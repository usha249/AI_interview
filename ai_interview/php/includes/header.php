<?php include_once __DIR__ . '/db.php'; ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>AI Interview Tool</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/php/index.php">AI Interview Tool</a>
    <div class="d-flex">
      <?php if (!empty($_SESSION['username'])): ?>
        <span class="navbar-text text-white me-2">Hello, <?= htmlspecialchars($_SESSION['username']) ?></span>
        <?php if ($_SESSION['role'] === 'candidate'): ?>
          <a class="btn btn-outline-light btn-sm me-2" href="/php/candidates/start_interview.php">Start Interview</a>
        <?php elseif ($_SESSION['role'] === 'recruiter'): ?>
          <a class="btn btn-outline-light btn-sm me-2" href="/php/recruiters/dashboard.php">Dashboard</a>
        <?php endif; ?>
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <a class="btn btn-outline-light btn-sm me-2" href="/php/admin/dashboard.php">Admin</a>
        <?php endif; ?>
        <a class="btn btn-outline-light btn-sm" href="/php/accounts/logout.php">Logout</a>
      <?php else: ?>
        <a class="btn btn-outline-light btn-sm me-2" href="/php/accounts/login.php">Login</a>
        <a class="btn btn-primary btn-sm" href="/php/accounts/register.php">Register</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<div class="container py-4">
