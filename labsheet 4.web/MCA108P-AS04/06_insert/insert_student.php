<?php
require __DIR__ . '/../config/db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $date  = $_POST['enrollment_date'] ?? '';

    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $date === '') {
        $message = "Please provide valid details.";
    } else {
        try {
            $pdo = getConnection();
            $stmt = $pdo->prepare(
                "INSERT INTO students (name, email, enrollment_date) VALUES (:name, :email, :date)"
            );
            $stmt->execute([':name' => $name, ':email' => $email, ':date' => $date]);
            $message = "Student added with ID " . $pdo->lastInsertId();
        } catch (PDOException $e) {
            $message = "Error: " . htmlspecialchars($e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Add Student</title></head>
<body>
<h2>Add Student</h2>
<p><?= htmlspecialchars($message) ?></p>
<form method="post">
  Name: <input type="text" name="name" required><br><br>
  Email: <input type="email" name="email" required><br><br>
  Enrollment Date: <input type="date" name="enrollment_date" required><br><br>
  <button type="submit">Add</button>
</form>
</body></html>
