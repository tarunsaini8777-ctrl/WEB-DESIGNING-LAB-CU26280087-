<?php
require __DIR__ . '/../config/db.php';

$stmt = getConnection()->query("SELECT id, name, email, enrollment_date FROM students ORDER BY id");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="students_' . date('Ymd_His') . '.csv"');

$out = fopen('php://output', 'w');
fputcsv($out, ['ID', 'Name', 'Email', 'Enrollment Date']);
while ($row = $stmt->fetch()) {
    fputcsv($out, $row);
}
fclose($out);
