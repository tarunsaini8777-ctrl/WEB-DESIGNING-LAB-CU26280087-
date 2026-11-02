<?php
/**
 * Lab Sheet 4 - Question 21: Write a PHP script utilizing password_hash() and password_verify() to securely store and authenticate hashed user passwords in MySQL.
 */
$host = 'localhost';
$db   = 'college_db';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

// users table:
// CREATE TABLE IF NOT EXISTS users (
//   id INT AUTO_INCREMENT PRIMARY KEY,
//   username VARCHAR(50) UNIQUE NOT NULL,
//   password VARCHAR(255) NOT NULL   -- 255 chars: hash length may grow
// );

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $action   = $_POST['action'] ?? '';

    if ($action === 'register') {
        $hash = password_hash($password, PASSWORD_DEFAULT);   // salted bcrypt/argon2
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hash]);
            $message = "Registered successfully.";
        } catch (PDOException $e) {
            $message = "Username already exists.";
        }
    } elseif ($action === 'login') {
        $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $row = $stmt->fetch();
        $message = ($row && password_verify($password, $row['password']))
            ? "Login successful!" : "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Password Hashing</title></head>
<body style="font-family:Arial;margin:30px">
<h2>Register / Login</h2>
<p><b><?= htmlspecialchars($message) ?></b></p>
<form method="post">
  <input name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button name="action" value="register">Register</button>
  <button name="action" value="login">Login</button>
</form>
</body></html>
