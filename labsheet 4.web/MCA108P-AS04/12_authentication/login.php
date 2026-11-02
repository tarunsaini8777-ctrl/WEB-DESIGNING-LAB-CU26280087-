<?php
// Users are created in Experiment 21 (register.php), which stores hashed passwords.
require __DIR__ . '/../config/db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = getConnection()->prepare("SELECT id, username, password FROM users WHERE username = :u");
    $stmt->execute([':u' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $message = "Login successful. Welcome, " . $user['username'] . "!";
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
</body></html>
