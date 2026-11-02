<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Profile</title></head>
<body>
<h2>Profile</h2>
<p>User ID: <?= (int)$_SESSION['user_id'] ?></p>
<p>Username: <?= htmlspecialchars($_SESSION['username']) ?></p>
<p>Session ID: <?= session_id() ?></p>
<p><a href="dashboard.php">Back</a> | <a href="logout.php">Logout</a></p>
</body></html>
