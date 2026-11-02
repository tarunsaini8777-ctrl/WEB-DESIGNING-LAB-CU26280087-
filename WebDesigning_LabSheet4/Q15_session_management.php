<?php
/**
 * Lab Sheet 4 - Question 15: Write a PHP script demonstrating session management (session_start(), $_SESSION) to maintain user login state across multiple pages.
 */
// ============================================================
// Single-file demo using ?page=login | dashboard | logout
// (You can also split into login.php, dashboard.php, logout.php)
// ============================================================
session_start();
$page = $_GET['page'] ?? 'login';
$error = '';

if ($page === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // demo credentials; replace with DB check (see Q12)
    if (($_POST['username'] ?? '') === 'admin' && ($_POST['password'] ?? '') === 'admin123') {
        session_regenerate_id(true);
        $_SESSION['username']   = 'admin';
        $_SESSION['login_time'] = date('H:i:s');
        header('Location: ?page=dashboard');
        exit;
    }
    $error = 'Invalid credentials';
}

if ($page === 'logout') {
    $_SESSION = [];
    session_destroy();
    header('Location: ?page=login');
    exit;
}

if ($page === 'dashboard' && !isset($_SESSION['username'])) {
    header('Location: ?page=login');   // protect page
    exit;
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Session Demo</title></head>
<body style="font-family:Arial;margin:30px">
<?php if ($page === 'dashboard'): ?>
  <h2>Dashboard</h2>
  <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>! Logged in at <?= $_SESSION['login_time'] ?></p>
  <p><a href="?page=profile">Profile page</a> | <a href="?page=logout">Logout</a></p>
<?php elseif ($page === 'profile' && isset($_SESSION['username'])): ?>
  <h2>Profile</h2>
  <p>User: <?= htmlspecialchars($_SESSION['username']) ?> (session persists across pages)</p>
  <p><a href="?page=dashboard">Back</a></p>
<?php else: ?>
  <h2>Login</h2>
  <p style="color:red"><?= $error ?></p>
  <form method="post" action="?page=login">
    <input name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Login</button>
  </form>
<?php endif; ?>
</body></html>
