<?php
require __DIR__ . '/../config/db.php';
$students = getConnection()->query("SELECT * FROM students ORDER BY id")->fetchAll();
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Students</title>
<style>
  body { font-family: Arial, sans-serif; margin: 30px; }
  table { border-collapse: collapse; width: 100%; }
  th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
  th { background: #2c3e50; color: #fff; }
  tr:nth-child(even) { background: #f4f6f8; }
  tr:hover { background: #e8eef4; }
</style></head>
<body>
<h2>Student Records</h2>
<table>
  <tr><th>ID</th><th>Name</th><th>Email</th><th>Enrollment Date</th></tr>
  <?php foreach ($students as $s): ?>
  <tr>
    <td><?= $s['id'] ?></td>
    <td><?= htmlspecialchars($s['name']) ?></td>
    <td><?= htmlspecialchars($s['email']) ?></td>
    <td><?= $s['enrollment_date'] ?></td>
  </tr>
  <?php endforeach; ?>
  <?php if (!$students): ?><tr><td colspan="4">No records found.</td></tr><?php endif; ?>
</table>
</body></html>
