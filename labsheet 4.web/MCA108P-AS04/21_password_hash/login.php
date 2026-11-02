<?php
require __DIR__ . '/../config/db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = getConnection()->prepare("SELECT password FROM users WHERE username = :u");
    $stmt->execute([':u' => trim($_POST['username'] ?? '')]);
    $hash = $stmt->fetchColumn();

    if ($hash && password_verify($_POST['password'] ?? '', $hash)) {
        if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
            // rehash and update here if the algorithm/cost changes
        }
        $message = "Authentication successful.";
    } else {
        $message = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Login</title></head>
<body>
<h2>Login</h2>
<p><?= htmlspecialchars($message) ?></p>
<form method="post">
  Username: <input type="text" name="username" required><br><br>
  Password: <input type="password" name="password" required><br><br>
  <button type="submit">Login</button>
</form>
<p><a href="register.php">Register</a></p>
</body></html>
