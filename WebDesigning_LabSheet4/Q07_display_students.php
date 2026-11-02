<?php
/**
 * Lab Sheet 4 - Question 7: Develop a PHP script to retrieve and display all records from the students table inside a styled HTML table.
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
$students = $pdo->query("SELECT id, name, email, enrollment_date FROM students ORDER BY id")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Students</title>
<style>
  body { font-family: Arial, sans-serif; margin: 30px; background: #f4f6f8; }
  table { border-collapse: collapse; width: 100%; background: #fff; }
  th, td { padding: 10px 14px; border: 1px solid #ddd; text-align: left; }
  th { background: #2c3e50; color: #fff; }
  tr:nth-child(even) { background: #f2f2f2; }
  tr:hover { background: #e8f0fe; }
</style>
</head>
<body>
<h2>Student Records</h2>
<table>
  <tr><th>ID</th><th>Name</th><th>Email</th><th>Enrollment Date</th></tr>
  <?php foreach ($students as $s): ?>
  <tr>
    <td><?= htmlspecialchars($s['id']) ?></td>
    <td><?= htmlspecialchars($s['name']) ?></td>
    <td><?= htmlspecialchars($s['email']) ?></td>
    <td><?= htmlspecialchars($s['enrollment_date']) ?></td>
  </tr>
  <?php endforeach; ?>
  <?php if (!$students): ?><tr><td colspan="4">No records found.</td></tr><?php endif; ?>
</table>
</body>
</html>
