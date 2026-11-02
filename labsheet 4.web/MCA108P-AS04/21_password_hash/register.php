<?php
require __DIR__ . '/../config/db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (strlen($username) < 3 || strlen($password) < 8) {
        $message = "Username min 3 chars, password min 8 chars.";
    } else {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = getConnection()->prepare("INSERT INTO users (username, password) VALUES (:u, :p)");
            $stmt->execute([':u' => $username, ':p' => $hash]);
            $message = "User registered. You can now log in.";
        } catch (PDOException $e) {
            $message = ($e->getCode() == 23000) ? "Username already exists." : "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Register</title></head>
<body>
<h2>Register</h2>
<p><?= htmlspecialchars($message) ?></p>
<form method="post">
  Username: <input type="text" name="username" required><br><br>
  Password: <input type="password" name="password" required><br><br>
  <button type="submit">Register</button>
</form>
<p><a href="login.php">Go to login</a></p>
</body></html>
