<?php
require_once __DIR__ . '/../config.php';
csrf_check();
$B = base();
$pageTitle = $pageTitle ?? 'Online Bookstore';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?> – Bookstore</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= $B ?>assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="<?= $B ?>index.php">📚 Bookstore</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="nav">
      <form class="d-flex mx-lg-3 flex-grow-1" action="<?= $B ?>index.php" method="get" role="search">
        <input class="form-control me-2" type="search" name="q" placeholder="Search title or author…" value="<?= e($_GET['q'] ?? '') ?>">
        <button class="btn btn-warning">Search</button>
      </form>
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <?php if (is_admin()): ?><li class="nav-item"><a class="nav-link" href="<?= $B ?>admin/index.php">Admin</a></li><?php endif; ?>
        <?php if (is_logged_in()): ?>
          <li class="nav-item"><a class="nav-link" href="<?= $B ?>wishlist.php">♥ Wishlist</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $B ?>orders.php">My Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $B ?>logout.php">Logout (<?= e($_SESSION['user']['name']) ?>)</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="<?= $B ?>login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $B ?>register.php">Register</a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="btn btn-outline-light btn-sm ms-lg-2" href="<?= $B ?>cart.php">🛒 Cart <span class="badge bg-warning text-dark"><?= cart_count() ?></span></a></li>
      </ul>
    </div>
  </div>
</nav>
<main class="container py-4">
<?php foreach (($_SESSION['flash'] ?? []) as [$t, $m]): ?>
  <div class="alert alert-<?= e($t) ?> alert-dismissible fade show"><?= e($m) ?><button class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endforeach; unset($_SESSION['flash']); ?>
