<?php
/**
 * Lab Sheet 4 - Question 12: Implement user authentication in PHP by verifying submitted username and password against stored MySQL database records.
 */
// SQL (run once):
// CREATE TABLE users (
//   id INT AUTO_INCREMENT PRIMARY KEY,
//   username VARCHAR(50) UNIQUE NOT NULL,
//   password VARCHAR(255) NOT NULL
// );
// INSERT INTO users (username,password) VALUES ('admin', '<hash from password_hash("admin123", PASSWORD_DEFAULT)>');
session_start();
$host = 'localhost';
$db   = 'college_db';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :u");
    $stmt->execute([':u' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $message = "<p style='color:green'>Login successful. Welcome, " . htmlspecialchars($user['username']) . "!</p>";
    } else {
        $message = "<p style='color:red'>Invalid username or password.</p>";
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Login</title>
<style>
 body{font-family:Arial;background:#eef1f5;display:flex;justify-content:center;padding-top:80px}
 form{background:#fff;padding:25px;border-radius:8px;box-shadow:0 2px 8px #0002;width:300px}
 input{width:100%;padding:8px;margin:8px 0;box-sizing:border-box}
 button{width:100%;padding:10px;background:#2c3e50;color:#fff;border:0;cursor:pointer}
</style></head>
<body>
<form method="post">
  <h2>Login</h2>
  <?= $message ?>
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>
</body></html>
