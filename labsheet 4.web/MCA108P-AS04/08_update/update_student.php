<?php
require __DIR__ . '/../config/db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $email = trim($_POST['email'] ?? '');

    if (!$id || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Enter a valid ID and email.";
    } else {
        try {
            $stmt = getConnection()->prepare("UPDATE students SET email = :email WHERE id = :id");
            $stmt->execute([':email' => $email, ':id' => $id]);
            $message = $stmt->rowCount() ? "Email updated." : "No change (ID not found or same email).";
        } catch (PDOException $e) {
            $message = "Error: " . htmlspecialchars($e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Update Email</title></head>
<body>
<h2>Update Student Email</h2>
<p><?= htmlspecialchars($message) ?></p>
<form method="post">
  Student ID: <input type="number" name="id" required><br><br>
  New Email: <input type="email" name="email" required><br><br>
  <button type="submit">Update</button>
</form>
</body></html>
