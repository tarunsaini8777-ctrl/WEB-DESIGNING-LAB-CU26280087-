<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Dashboard</title></head>
<body>
<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></h2>
<p><a href="profile.php">Profile</a> | <a href="logout.php">Logout</a></p>
</body></html>
